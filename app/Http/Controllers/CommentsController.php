<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetComments;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function comment(GetComments $request){
        echo $request->id;
    }
    public function store(){

    }
}
