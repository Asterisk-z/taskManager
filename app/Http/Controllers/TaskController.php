<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::query();

        if (request('is_completed')) {
            $tasks = $tasks->where('is_completed', request('is_completed'));
        }

        $tasks = $tasks->orderBy('created_at', 'DESC')->get();

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Task/Create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function batch()
    {
        return Inertia::render('Task/Batch');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
        return Inertia::render('Task/Generate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::create($data);
        return Redirect::to('/');
        // return response()->json(['success' => true, 'data' => $task], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function groupStore(BatchTaskRequest $request)
    {
        $data = $request->validated();

        $titles = $data['title'];

        foreach ($titles as $title) {
            $task = Task::create(['title' => $title]);
        }

        return Redirect::to('/');
        // return response()->json(['success' => true, 'data' => $task], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateTask(Request $request)
    {
        $request->validate([
            'min' => 'integer|required',
            'max' => 'integer|required',
        ]);
        $taskCount = random_int(request('min'), request('max'));

        for ($i = 0; $i < $taskCount; $i++) {

            $title = 'Task ' . Str::random(15);
            $task = Task::create(['title' => $title]);
        }

        return Redirect::to('/');
        // return response()->json(['success' => true, 'data' => $task], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $data = $request->validated();

        if (!$task = Task::where('id', $id)->first()) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        if ($task->is_completed) {
            return response()->json(['success' => false, 'message' => 'Task has been completed'], 404);
        }

        $task->update($data);

        $message = $data['is_completed'] ? 'Task Completed Successfully' : 'Task Time Taken Updated Successfully';

        return response()->json(['success' => true, 'message' => $message], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
