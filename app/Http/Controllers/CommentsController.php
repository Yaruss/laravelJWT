<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetComments;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Http\Resources\CommentsResource;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function comment(GetComments $request){
        $comment = Comments::GetCommentFromTaskId($request->id);
        $request = CommentsResource::collection($comment);
        return response()->json($request);
    }
    public function store(StoreCommentsRequest $request){
        $comment = new Comments();
        $comment->task_id = $request->id;
        $comment->comment = $request->comment;
        $comment->save();
        $result=new CommentsResource($comment);
        return response()->json($result);
    }
}
