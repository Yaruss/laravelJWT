<?php

namespace App\Traits;

use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

trait TasksTraits
{
    /*
     * If the task belongs to the user then return true
     */
    public function isIdTaskEqualsIdUser(): bool
    {
        if ($this->input('id', 0) > 0)
            return Auth::user()->id == Tasks::GetIdUserFormIdTask($this->id);
        return false;
    }
}
