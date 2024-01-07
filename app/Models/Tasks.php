<?php

namespace App\Models;

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

    public function comments(): HasMany {
        return $this->hasMany(Comments::class, 'task_id', 'id');
            //->withPivot('comment');
    }
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    public function scopeGetAllTaskUserAuth($query){
        return $query
            ->UserAuth()
            ->get();
    }
    public function scopeGetIdUserFormIdTask($query, $id){
        $result = $query
            ->UserAuth()
            ->select('user_id')
            ->find($id);
        if($result !== null){
            return $result->user_id;
        }
        return 0;
    }
    public function scopeDeleteFromIdTask($query, $id){
        return $query
            ->UserAuth()
            ->where('id', $id)
            ->delete();
    }
    public function scopeFindFromIdUpdate($query, $id, $update_data){
        return $query
            ->UserAuth()
            ->find($id)
            ->update($update_data);
    }
    public function scopeGetTaskFromId($query, $id){
        return $query
            ->UserAuth()
            ->where('id', $id)
            ->with('comments')
            ->first();
    }
    public function scopeUserAuth($query){
        return $query->where('user_id', Auth::user()->id);
    }
}
