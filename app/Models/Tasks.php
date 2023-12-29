<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    public function scopeGetIdUserFormIdTask($query, $id){
        return $query->select('user_id')->find($id)->user_id;
    }
    public function scopeDeleteFromIdTask($query, $id){
        //dd($id);
        $query->where('id', $id)->delete();
    }
}
