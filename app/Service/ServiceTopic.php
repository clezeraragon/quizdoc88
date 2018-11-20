<?php
/**
 * Created by PhpStorm.
 * User: toboymoney
 * Date: 15/11/2018
 * Time: 11:33
 */

namespace DockQuiz\Service;


use DockQuiz\Models\Topic;

class ServiceTopic
{
    private $topic;

  public function __construct(Topic $topic)
  {
      $this->topic = $topic;
  }

  public function lists($request)
  {
      $results = [];

      if ($request->has('q')) {

          $search = $request->q;
          $results = $this->topic
              ->select('id', 'title')
              ->where('title', 'like', '%' . $search . '%')
              ->get();
          return response()->json($results);
      }
      $results = $this->topic
          ->select('id', 'title')->limit(5)
          ->get();
      return response()->json($results);
  }
}