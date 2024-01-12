<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comments extends Model
{
    use HasFactory;

    /**
     * Delete comments from task_id
     *
     * @param Builder $query
     * @param int $id
     *
     * @return  mixed
     */
    public function scopeDeleteFromIdTask(Builder $query, int $id): mixed
    {
        return $query->where('task_id', $id)->delete();
    }

    /**
     * Return a Collection all task for user
     *
     * @param Builder $query
     *
     * @return  Collection|Builder[]
     */
    public function scopeGetCommentFromTaskId(Builder $query, int $id): Collection
    {
        return $query
            ->select('comments.comment as comment')
            ->join('tasks', 'comments.task_id', '=', 'tasks.id')
            ->where('tasks.user_id', Auth::user()->id)
            ->where('tasks.id', $id)
            ->get();
    }
}
