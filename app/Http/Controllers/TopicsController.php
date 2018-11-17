<?php

namespace DockQuiz\Http\Controllers;

use DockQuiz\Models\Topic;
use DockQuiz\Service\ServiceTopic;
use Illuminate\Http\Request;
use DockQuiz\Http\Requests\StoreTopicsRequest;
use DockQuiz\Http\Requests\UpdateTopicsRequest;

class TopicsController extends Controller
{

    private $serviceTopic;

    public function __construct(ServiceTopic $serviceTopic)
    {
        $this->middleware('admin');
        $this->serviceTopic = $serviceTopic;
    }

    /**
     * Display a listing of Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();

        return view('topics.index', compact('topics'));
    }
    public function lists(Request $request)
    {
        return $this->serviceTopic->lists($request);
    }

    /**
     * Show the form for creating new Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created Topic in storage.
     *
     * @param  \DockQuiz\Http\Requests\StoreTopicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicsRequest $request)
    {
        Topic::create($request->all());

        return redirect()->route('topics.index');
    }


    /**
     * Show the form for editing Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::findOrFail($id);

        return view('topics.edit', compact('topic'));
    }

    /**
     * Update Topic in storage.
     *
     * @param  \DockQuiz\Http\Requests\UpdateTopicsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicsRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());

        return redirect()->route('topics.index');
    }


    /**
     * Display Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);

        return view('topics.show', compact('topic'));
    }


    /**
     * Remove Topic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('topics.index');
    }

    /**
     * Delete all selected Topic at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Topic::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
