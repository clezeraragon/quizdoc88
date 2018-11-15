<?php

namespace DockQuiz\Http\Controllers;

use DockQuiz\Models\UserAction;
use Illuminate\Http\Request;
use DockQuiz\Http\Requests\StoreUserActionsRequest;
use DockQuiz\Http\Requests\UpdateUserActionsRequest;

class UserActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of UserAction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_actions = UserAction::all();

        return view('user_actions.index', compact('user_actions'));
    }
}
