<?php

namespace App\Http\Requests\Admin\DetailMemo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreDetailMemo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.detail-memo.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'memo_id' => ['required', 'integer'],
            'odependency_id' => ['required', 'integer'],
            'ddependency' => [''],
            'date_entry' => [''],
            'date_exit' => [''],
            'obs' => [''],
            'state_id' => [''],
            'admin_user_id' => [''],

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

    public function getDestinoId()
    {
        return $this->get('ddependency')['id'];
    }
}
