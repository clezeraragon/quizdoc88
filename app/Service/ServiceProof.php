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

        foreach ($this->proof->all() as $proof) {

            $data['data']['title'] = $proof->title;
            $data['data']['id'] = $proof->id;
            $data['data']['total_topic'] = $proof->topics->count();
        }
        return $data;
    }

    public function getAllTopicForId($id)
    {
      $data = [];
      $results = $this->proof->find($id);

        foreach ($results as $item) {
            $data[''] = null;
     }
    }

    public function getProofForUser()
    {
        $data = [];
        $results = $this->proof->where('user_id', auth()->id())->get();
        foreach ($results as $proof) {

            $data['data']['title'] = $proof->title;
            $data['data']['id'] = $proof->id;
            $data['data']['name'] = $proof->users->name;
            $data['data']['total_topic'] = $proof->topics->count();
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

}