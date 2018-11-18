<?php

namespace DockQuiz\Http\Controllers;

use Auth;
use DockQuiz\Models\Test;
use DockQuiz\Models\TestAnswer;
use DockQuiz\Models\Topic;
use Illuminate\Http\Request;
use DockQuiz\Http\Requests\StoreResultsRequest;
use DockQuiz\Http\Requests\UpdateResultsRequest;

class ResultsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Test::all()->load('user','getTopicForQuestion');

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }

        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id)->load('user','getTopicForQuestion');

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->with('question')
                ->with('question.options')
                ->get()
            ;
        }

        return view('results.show', compact('test', 'results'));
    }
    public function showForTopic($id)
    {

        $topic = Topic::find($id);

            $test_answer = $topic->test_answers()->where('user_id', auth()->id())->first();

        if (isset($test_answer->test_id)) {
            $test = Test::find($test_answer->test_id)->load('user', 'getTopicForQuestion');
            $results = TestAnswer::where('test_id', $test_answer->test_id)
                ->with('question')
                ->with('question.options')
                ->get()
            ;
            return view('results.show', compact('test', 'results'));
        }

    }

}
