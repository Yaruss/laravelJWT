<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetComments;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Http\Resources\CommentsResource;
use App\Models\Comments;

class CommentsController extends Controller
{
    /*
     * Method get ./api/data/comment find for a task by ID
     * 'id' => 'required' id must belong to user
     *
     * @return \Illuminate\Http\JsonResponse comments
     */
    public function comment(GetComments $request){
        $comment = Comments::GetCommentFromTaskId($request->id);
        $request = CommentsResource::collection($comment);
        return response()->json($request);
    }

    /*
     * Method post ./api/data/comment validation on StoreTasksRequest
     * 'title' => 'required', 'description' => 'required'
     *
     *
     * @return \Illuminate\Http\JsonResponse new task
     */
    public function store(StoreCommentsRequest $request){
        $comment = new Comments();
        $comment->task_id = $request->id;
        $comment->comment = $request->comment;
        $comment->save();
        $result=new CommentsResource($comment);
        return response()->json($result);
    }
}
