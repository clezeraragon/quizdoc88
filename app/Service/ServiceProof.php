<?php
/**
 * Created by PhpStorm.
 * User: toboymoney
 * Date: 15/11/2018
 * Time: 07:05
 */

namespace DockQuiz\Service;


use DockQuiz\Models\Proof;
use DockQuiz\Models\Topic;
use DockQuiz\Models\TopicsXProof;
use DockQuiz\Service\ServiceDashboard;

class ServiceProof
{
    private $proof;
    private $topicsXProof;


    public function __construct(Proof $proof, TopicsXProof $topicsXProof)
    {
        $this->proof = $proof;
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
                'name' => $proof->users->name,
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
        dd($id);
    }

}