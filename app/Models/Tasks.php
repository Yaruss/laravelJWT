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
        'title',
        'description',
        'completed',
        'completed_date',
    ];

    use HasFactory;

    public function comments(): HasMany {
        return $this->hasMany(Comments::class, 'task_id', 'id')
            ;//->withPivot('comment');
    }
    public function scopeGetAllTaskUserAuth($query){
        return $query->where('user_id', Auth::user()->id)->get();
    }
    public function scopeGetIdUserFormIdTask($query, $id){
        return $query->select('user_id')->find($id)->user_id;
    }
    public function scopeDeleteFromIdTask($query, $id){
        $query->where('id', $id)->delete();
    }
    public function scopeFindFromIdUpdate($query, $id, $update_data){
        return $query->find($id)->update($update_data);
    }
    public function scopeGetTaskFromId($query, $id){
        return $query
            ->with('comments')
            ->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();
    }
}
