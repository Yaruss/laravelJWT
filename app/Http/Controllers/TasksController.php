<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTasksRequest;
use App\Http\Requests\GetTaskByIdRequest;
use App\Http\Requests\PagesTasksRequest;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskWithCommentsResource;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Console\Input\complete;

class TasksController extends Controller
{
    /*
     * Method get ./api/data/task select all task user
     *
     * @return \Illuminate\Http\JsonResponse tasks
     */
    public function task(){
        $task = Tasks::GetAllTaskUserAuth();
        $result = TaskResource::collection($task);
        return response()->json($result);
    }

    /*
     * Method get ./api/data/task/id find for a task by ID
     * 'id' => 'required' id must belong to user
     *
     * @return \Illuminate\Http\JsonResponse task
     */
    public function taskId(GetTaskByIdRequest $request){
        return $this->taskById($request->id);
    }

    private function taskById($id){
        $task = Tasks::GetTaskFromId($id);
        $result = new TaskResource($task);
        return response()->json($result);
    }
    /*
     * Method get ./api/data/idwithcomments find for a task by ID
     * 'id' => 'required' id must belong to user
     *
     * @return \Illuminate\Http\JsonResponse task With Comments
     */
    public function taskIdWithComments(GetTaskByIdRequest $request){
        $task = Tasks::GetTaskFromId($request->id);
        $result = new TaskWithCommentsResource($task);
        return response()->json($result);
    }

    /*
     * Method get ./api/data/task/page if the values are given, return the first 2 tasks
     * fild limit set count item on page default 2
     * fild page set num page default 0
     * fild order name in tables default id
     * fild ascdesc sort default asc
     *
     * @return \Illuminate\Http\JsonResponse array [count, page, limit, tasks]
     */
    public function taskPage(PagesTasksRequest $request){
        $all = Tasks::UserAuth();

        $count = $all->count('id');

        $all
            ->orderBy($request->order, $request->ascdesc)
            ->skip($request->page * $request->limit)
            ->limit($request->limit);

        $page = [
            'count' => $count,
            'page' => $request->page,
            'limit' => $request->limit,
            'tasks' => TaskResource::collection($all->get())
        ];

        return response()->json($page);
    }

    /*
     * Method post ./api/data/task validation on StoreTasksRequest
     * 'title' => 'required', 'description' => 'required'
     *
     *
     * @return \Illuminate\Http\JsonResponse new task
     */
    public function store(StoreTasksRequest $request){
        $task = new Tasks;
        $task->title=$request->input('title');
        $task->description=$request->input('description');
        $task->user_id=Auth::user()->id;
        $task->save();
        return $this->taskById($task->id);
    }

    /*
     * Method put ./api/data/task validation on UpdateTasksRequest
     * 'id' => 'required' id must belong to user
     * update any fild title, completed, description
     * set new date in completed_data if set comleted true
     *
     * @return \Illuminate\Http\JsonResponse task
     */
    public function update(UpdateTasksRequest $request){
        $fild_update = Array();
        if($request->has('completed')){
            $fild_update['completed']=$request->completed;
            //$fild_update['completed_date']='NOW()';
            $fild_update['completed_date']=Carbon::now();
        }
        if($request->has('title')){
            $fild_update['title']=$request->title;
        }
        if($request->has('description')){
            $fild_update['description']=$request->description;
        }
        if(count($fild_update)>0) {
            Tasks::FindFromIdUpdate($request->id, $fild_update);
            return $this->taskById($request->id);
        }
        return response()->json(['error'=>'Not update'], 400);
    }

    /*
     * Method delete ./api/data/task validation on DestroyTasksRequest
     * 'id' => 'required',
     * id must belong to user
     * deleted task and comments
     *
     * @return \Illuminate\Http\JsonResponse true or false
     */
    public function destroy(DestroyTasksRequest $request){
        if(Tasks::DeleteFromIdTask($request->id)) {
            return response()->json(['delete'=>'true'], 200);
        }
        return  response()->json(['delete'=>'false'], 400);
    }
}
