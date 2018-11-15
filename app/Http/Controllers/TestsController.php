<?php

namespace DockQuiz\Http\Controllers;

use DB;
use Auth;
use DockQuiz\Models\Test;
use DockQuiz\Models\TestAnswer;
use DockQuiz\Models\Topic;
use DockQuiz\Models\Question;
use DockQuiz\Models\QuestionsOption;
use Illuminate\Http\Request;
use DockQuiz\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::inRandomOrder()->limit(10)->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        return view('tests.create', compact('questions'));
    }

    public function getTopicQuestsForId($id)
    {
        $questions = Topic::where('id', $id)->first();
        $hasResponse = $questions->test_answers()->where('user_id',auth()->id())->first();

        if ($hasResponse) {
            $hasResponse = 'disabled';
        } else {
            $hasResponse = '';
        }
        return view('tests.create_test', compact('questions', 'hasResponse'));
    }

    public function getAllTopic()
    {

        $topics = Topic::all();

        return view('tests.index', compact('topics'));
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \DockQuiz\Http\Requests\StoreResultsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $result = 0;

        $test = Test::create([
            'user_id' => Auth::id(),
            'result' => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.' . $question) != null
                && QuestionsOption::find($request->input('answers.' . $question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id' => Auth::id(),
                'test_id' => $test->id,
                'topic_id' => $request->topic_id,
                'question_id' => $question,
                'option_id' => $request->input('answers.' . $question),
                'correct' => $status,
            ]);
        }

        $test->update(['result' => $result]);

        return redirect()->route('results.show', [$test->id]);
    }
}
