<?php

namespace DockQuiz\Http\Controllers;

use DockQuiz\Models\Proof;
use DockQuiz\Service\ServiceProof;
use Illuminate\Http\Request;

class ProofController extends Controller
{
    private $serviceProof;

    public function __construct(ServiceProof $serviceProof)
    {
      $this->serviceProof = $serviceProof;
        $this->middleware('admin')->except('getProofForUser');
    }

    public function index()
    {
       $proofs = $this->serviceProof->getAll();
        return view()->make('proofs.index', compact('proofs'));
    }

    public function create()
    {
        return view()->make('proofs.create');
    }

    public function store(Request $request)
    {
      return $this->serviceProof->store($request);
    }
    public function getAllProofs()
    {
        $proofs = $this->serviceProof->getAllProofs();
        return view('proofs.proof', compact('proofs'));
    }
    public function getProofForUser()
    {
        $proofs = $this->serviceProof->getProofForUser();
        return view('proofs.proof', compact('proofs'));
    }
    public function getAllTopicForId($id)
    {
        $topics =  $this->serviceProof->getAllTopicForId($id);
        return view('proofs.topic', compact('topics'));
    }
}
