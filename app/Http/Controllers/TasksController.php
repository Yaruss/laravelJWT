<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Http\Resources\TaskResource;
use App\Models\Tasks;

class TasksController extends Controller
{
    /*
     * Method get ./api/data/task select all task
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function task(){
        $task = Tasks::all();
        $result = TaskResource::collection($task);
        return response()->json($result);
    }

    /*
     * Method get ./api/data/task{id} select 20 task on num page id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function taskPage(){
        $task = Tasks::all();
        $result = TaskResource::collection($task);
        return response()->json($result);
    }

    /*
     * Method put ./api/data/task validation on StoreTasksRequest
     * 'id' => 'required', 'title' => 'required', 'description' => 'required'
     * id must belong to user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTasksRequest $request){
        dd($request);

        $task = Tasks::all();
        $result = TaskResource::collection($task);
        return response()->json($result);
    }

    /*
     * Method post ./api/data/task validation on UpdateTasksRequest
     * 'id' => 'required', 'title' => 'required', 'description' => 'required'
     * id must belong to user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTasksRequest $request){
        dd($request);

        $task = Tasks::all();
        $result = TaskResource::collection($task);
        return response()->json($result);
    }
}
