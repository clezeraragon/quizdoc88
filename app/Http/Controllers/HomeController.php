<?php

namespace DockQuiz\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = 0;
        $users = 0;
        $quizzes = 0;
        $average = 0;

        return view('home')->with([
            'questions' => $questions,
            'users' => $users,
            'quizzes' => $quizzes,
            'average' => $average,
        ]);
    }
}
