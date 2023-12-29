<?php

namespace App\Traits;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

trait TasksTraits {
    public function isIdTaskEqualsIdUser(){
        if($this->id>0)
            return Auth::user()->id == Tasks::GetIdUserFormIdTask($this->id);
        return false;
    }
}
