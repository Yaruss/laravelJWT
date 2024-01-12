<?php

namespace App\Http\Requests;

use App\Models\User;
use http\Client\Response;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|min:4',
            'password' => 'required|min:4'
        ];
    }

    /**
     * if enter name find email an replace
     *
     * @return array
     */
    protected function passedValidation(): void
    {
        $user = User::FinFromEmailOrName($this->input('email'), $this->input('password'));
        if ($user->exists()) {
            $this->merge([
                'email' => $user->email
            ]);
        }

    }
}
