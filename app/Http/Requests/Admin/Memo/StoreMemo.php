<?php

namespace App\Http\Requests\Admin\Memo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMemo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.memo.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'odependency' => ['required'],
            'number_memo' => ['required', 'string'],
            'ref' => ['required', 'string'],
            'obs' => ['required', 'string'],
            'date_doc' => ['required', 'date'],
            'date_entry' => ['required', 'date'],
            'date_exit' => [''],
            'ddependency_id' => [''],
            'admin_user_id' => ['required', 'integer'],
            'state_id' => ['required', 'integer'],
            'type' => ['required'],

        ];
    }

    /**
    * Modify input data
    *
    * @return array
    */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }

    public function getTypeId()
    {
        return $this->get('type')['id'];
    }

    public function getOrigenId()
    {
        return $this->get('odependency')['id'];
    }
}
