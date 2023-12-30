<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    public function scopeDeleteFromIdTask($query, $id){
        $query->where('task_id', $id)->delete();
    }
}
