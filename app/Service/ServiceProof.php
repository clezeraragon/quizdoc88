<?php
/**
 * Created by PhpStorm.
 * User: toboymoney
 * Date: 15/11/2018
 * Time: 07:05
 */

namespace DockQuiz\Service;


use DockQuiz\Models\Proof;
use DockQuiz\Models\Test;
use DockQuiz\Models\TestAnswer;
use DockQuiz\Models\Topic;
use DockQuiz\Models\TopicsXProof;
use DockQuiz\Models\User;
use DockQuiz\Service\ServiceDashboard;

class ServiceProof
{
    private $proof;
    private $topicsXProof;
    private $test;
    private $testAnswer;


    public function __construct(
        Proof $proof,
        TopicsXProof $topicsXProof,
        Test $test,
        TestAnswer $testAnswer
    )
    {
        $this->proof = $proof;
        $this->test = $test;
        $this->testAnswer = $testAnswer;
        $this->topicsXProof = $topicsXProof;
    }

    public function getAll()
    {
        return $this->proof->all();
    }

    public function getAllProofs()
    {
        $data = [];

        foreach ($this->proof->all() as $key => $proof) {

            $data[$key] = collect([
                'title' => $proof->title,
                'id' => $proof->id,
                'name' => (isset($proof->users->name)) ? $proof->users->name : '',
                'total_topic' => $proof->topics->count()

            ]);
        }
        return $data;
    }

    public function getAllTopicForId($id)
    {
        $data = [];
        $results = $this->proof->find($id);

        if ($results->user_id == auth()->id() || auth()->user()->isAdmin()) {

            foreach ($results->topics as $key => $item) {

                $data[$key] = collect([
                    'topic_id' => $item->id,
                    'title' => $item->title,
                    'percent' => ServiceDashboard::totalPorcento(ServiceDashboard::getTotalAcertos($item->id), $item->questions->count()),
                    'total_questions' => $item->questions->count(),
                    'total_acertos' => ServiceDashboard::getTotalAcertos($item->id)

                ]);
            }
            return $data;
        }
        return [];
    }

    public function showProofUserId($id)
    {
        $data = [];

        $results = $this->proof->find($id);
        $user = User::find($results->user_id)->name;
        $email = User::find($results->user_id)->email;
        $test_id = $this->testAnswer
            ->where('user_id', $results->user_id)
            ->where('proof_id', $results->id)
            ->select('test_id')
            ->distinct()
            ->get()
            ->toArray();

        foreach ($results->topics as $key => $item) {


            if (isset($test_id[$key])) {

                $data[$key] = collect([
                    'test_id' => $test_id[$key]['test_id'],
                    'title' => $item->title,
                    'name' => $user,
                    'email' => $email,
                    'percent' => ServiceDashboard::totalPorcento(ServiceDashboard::getTotalAcertos($item->id), $item->questions->count()),
                    'total_questions' => $item->questions->count(),
                    'total_acertos' => ServiceDashboard::getTotalAcertos($item->id, $results->user_id)

                ]);
            }
        }
        return $data;
    }


    public function getProofForUser()
    {
        $data = [];
        $results = $this->proof->where('user_id', auth()->id())->get();
        foreach ($results as $key => $proof) {

            $data[$key] = collect([
                'title' => $proof->title,
                'id' => $proof->id,
                'name' => $proof->users->name,
                'total_topic' => $proof->topics->count()

            ]);
        }

        return $data;
    }

    public function store($request)
    {
        foreach ($request->users as $user) {
            $proof = $this->proof->create([
                'title' => $request->title,
                'user_id' => $user
            ]);

            foreach ($request->topics as $topic) {
                $this->topicsXProof->create([
                    'id_proof' => $proof->id,
                    'id_topic' => $topic
                ]);
            }
        }
        return redirect()->route('proof.index');
    }

    public function delete($id)
    {
        $data = [];

        $results = $this->proof->find($id);
        $data['id_user'] = $results->user_id;

        foreach ($results->topics as $key => $topic) {
            $data['id_topic'][$key] = $topic->id;
            $topic->pivot->forceDelete();
        }

        foreach ($data['id_topic'] as $topicId) {

            $testAnswers = $this->testAnswer
                ->where('user_id', $data['id_user'])
                ->where('topic_id', $topicId)
                ->get();


            foreach ($testAnswers as $key => $item) {
                $data['id_test'] = $item['test_id'];
                $item->forceDelete();

                $test = $this->test->find($data['id_test']);

                if ($test) {
                    $test->forceDelete();
                }
            }
        }
        $results->forceDelete();
        return redirect()->route('proof.index');

    }

}