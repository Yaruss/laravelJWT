<?php

namespace App\Http\Requests;

use App\Models\Tasks;
use Illuminate\Foundation\Http\FormRequest;

class PagesTasksRequest extends FormRequest
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
            //
        ];
    }

    /**
     * Get the validated data with default values.
     *
     * @return array
     */
    public function validateResolved(): void
    {
        $this->merge([
            'order' => $this->isOrder(),
            'ascdesc' => strtolower($this->input('ascdesc', 'asc')) == 'asc' ? 'ASC' : 'DESC',

            'page' => $this->input('page', 0),
            'limit' => max(min($this->input('limit', 2), 100), 1)
        ]);
    }

    private function isOrder(): string
    {
        $name = $this->input('order');
        $task = new Tasks();
        $columns = $task->getTableColumns();
        if (in_array($name, $columns)) {
            return $name;
        }
        return 'id';
    }
}
