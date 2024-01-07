<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comments extends Model
{
    use HasFactory;
    public function scopeDeleteFromIdTask($query, $id){
        return $query->where('task_id', $id)->delete();
    }
    public function scopeGetCommentFromTaskId($query, $id){
        return $query
            ->select('comments.comment as comment')
            ->join('tasks','comments.task_id','=','tasks.id')
            ->where('tasks.user_id',Auth::user()->id)
            ->where('tasks.id',$id)
            ->get();
    }
}
