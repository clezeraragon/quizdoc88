<?php

namespace DockQuiz\Http\Controllers;

use DockQuiz\Models\User;
use DockQuiz\Service\ServiceUser;
use Illuminate\Http\Request;
use DockQuiz\Http\Requests\StoreUsersRequest;
use DockQuiz\Http\Requests\UpdateUsersRequest;

class UsersController extends Controller
{
    private $serviceUser;

    public function __construct(ServiceUser $serviceUser)
    {
        $this->middleware('admin');
        $this->serviceUser = $serviceUser;
    }

    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function lists(Request $request)
    {
        return $this->serviceUser->lists($request);
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'roles' => \DockQuiz\Models\Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        return view('users.create', $relations);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \DockQuiz\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        User::create($request->all());

        return redirect()->route('users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'roles' => \DockQuiz\Models\Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $user = User::findOrFail($id);

        return view('users.edit', compact('user') + $relations);
    }

    /**
     * Update User in storage.
     *
     * @param  \DockQuiz\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'roles' => \DockQuiz\Models\Role::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $user = User::findOrFail($id);

        return view('users.show', compact('user') + $relations);
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $user = User::find($id);
        $user->users_actios()->forceDelete();
        $user->tests_answers()->forceDelete();
        $user->tests()->forceDelete();

        foreach ($user->proofs as $proof) {

            foreach ($proof->topics as $topic){
              $topic->pivot->forceDelete();
            }
            $proof->forceDelete();
        }
        $user->forceDelete();

        return redirect()->route('users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
