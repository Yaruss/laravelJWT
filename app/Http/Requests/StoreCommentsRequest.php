<?php

namespace App\Http\Requests;

use App\Traits\TasksTraits;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentsRequest extends FormRequest
{
    use TasksTraits;

    /**
     * Determine if the user is authorized to make this request.
     * validate id if true then update data input any fild
     */
    public function authorize(): bool
    {
        return $this->isIdTaskEqualsIdUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required',
        ];
    }
}
