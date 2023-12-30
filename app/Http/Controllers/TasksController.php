<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTasksRequest;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskWithCommentsResource;
use App\Models\Comments;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Console\Input\complete;

class TasksController extends Controller
{
    /*
     * Method get ./api/data/task select all task
     *
     * @return \Illuminate\Http\JsonResponse tasks
     */
    public function task(){
        $task = Tasks::GetAllTaskUserAuth();
        $result = TaskResource::collection($task);
        return response()->json($result);
    }

    /*
     * Method get ./api/data/task{id} find for a task by ID
     *
     * @return \Illuminate\Http\JsonResponse task
     */
    public function taskById($id){
        $task = Tasks::GetTaskFromId($id);
        //if($task->user_id==Auth::user()->id)
        $result = new TaskWithCommentsResource($task);
        return response()->json($result);
    }

    /*
     * Method get ./api/data/task{id} select 20 task on num page id
     *
     * @return \Illuminate\Http\JsonResponse tasks
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
     * @return \Illuminate\Http\JsonResponse tasks
     */
    public function store(StoreTasksRequest $request){
        return $this->task();
    }

    /*
     * Method post ./api/data/task validation on UpdateTasksRequest
     * 'id' => 'required' id must belong to user
     * update any fild title, completed, description
     * set new date in completed_data if set comleted true
     *
     * @return \Illuminate\Http\JsonResponse tasks
     */
    public function update(UpdateTasksRequest $request){
        $fild_update = Array();
        if(isset($request->completed)){
            $fild_update['completed']=$request->completed;
            //$fild_update['completed_date']='NOW()';
            $fild_update['completed_date']=Carbon::now();
        }
        if(isset($request->title)){
            $fild_update['title']=$request->title;
        }
        if(isset($request->description)){
            $fild_update['description']=$request->description;
        }
        if(count($fild_update)>0) {
            Tasks::FindFromIdUpdate($request->id, $fild_update);
            return $this->taskById($request->id);
        }
        return response()->json(['error'=>'Not info update'], 400);
    }

    /*
     * Method post ./api/data/task validation on DestroyTasksRequest
     * 'id' => 'required',
     * id must belong to user
     * deleted task and comments
     *
     * @return \Illuminate\Http\JsonResponse tasks
     */
    public function destroy(DestroyTasksRequest $request){
        //Comments::DeleteFromIdTask($request->id);
        Tasks::DeleteFromIdTask($request->id);
        return $this->task();
    }
}
