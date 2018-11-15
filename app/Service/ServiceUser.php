<?php
/**
 * Created by PhpStorm.
 * User: toboymoney
 * Date: 15/11/2018
 * Time: 10:47
 */

namespace DockQuiz\Service;


use DockQuiz\Models\User;

class ServiceUser
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function lists($request)
    {
        $results = [];

        if ($request->has('q')) {

            $search = $request->q;
            $results = $this->user
                ->select('id', 'name')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->get();
        }
        return response()->json($results);
    }
}