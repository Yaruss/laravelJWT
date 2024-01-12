<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Tasks extends Model
{

    protected $casts = [
        'completed_date' => 'datetime'
    ];

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'completed',
        'completed_date',
    ];

    use HasFactory;

    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class, 'task_id', 'id');
        //->withPivot('comment');
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * Return a Collection all task for user
     *
     * @param Builder $query
     *
     * @return  Collection|Builder[]
     */
    public function scopeGetAllTaskUserAuth(Builder $query): Collection
    {
        return $query
            ->UserAuth()
            ->get();
    }

    /**
     * Return a user_id or 0 in not find task_id
     *
     * @param Builder $query
     * @param int $id task_id
     *
     * @return  Collection|Builder[]
     */
    public function scopeGetIdUserFormIdTask(Builder $query, int $id): int
    {
        $result = $query
            ->UserAuth()
            ->select('user_id')
            ->find($id);
        if ($result !== null) {
            return $result->user_id;
        }
        return 0;
    }

    /**
     * Delete task on task_id
     *
     * @param Builder $query
     * @param int $id task_id
     *
     * @return  mixed
     */
    public function scopeDeleteFromIdTask(Builder $query, int $id): mixed
    {
        return $query
            ->UserAuth()
            ->where('id', $id)
            ->delete();
    }

    /**
     * Update task on task_id and user_id = auth user id
     *
     * @param Builder $query
     * @param int $id task_id
     * @param DatETime $update_data
     *
     * @return  int
     */
    public function scopeFindFromIdUpdate(Builder $query, int $id, DatETime $update_data): int
    {
        return $query
            ->UserAuth()
            ->find($id)
            ->update($update_data);
    }

    /**
     * Return a model User is find on task_id
     *
     * @param Builder $query
     * @param int $id task_id
     *
     * @return  BuildsQueries|Illuminate\Database\Eloquent\Model|null|object
     */
    public function scopeGetTaskFromId(Builder $query, int $id): mixed
    {
        return $query
            ->UserAuth()
            ->where('id', $id)
            ->with('comments')
            ->first();
    }

    /**
     * Return a Builder set user_id = Auth user id
     *
     * @param Builder $query
     *
     * @return  Builder
     */
    public function scopeUserAuth(Builder $query): Builder
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
