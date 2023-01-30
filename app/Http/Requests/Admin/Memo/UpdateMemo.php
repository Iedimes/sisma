<?php

namespace App\Http\Requests\Admin\Memo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMemo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.memo.edit', $this->memo);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'odependency' => ['sometimes'],
            'number_memo' => ['sometimes'],
            'ref' => ['sometimes'],
            'obs' => ['sometimes'],
            'date_doc' => ['sometimes', 'date'],
            'date_entry' => ['sometimes', 'date'],
            'date_exit' => [''],
            'ddependency_id' => ['sometimes'],
            'admin_user_id' => ['sometimes', 'integer'],
            'state_id' => ['sometimes', 'integer'],
            'type_id' => ['sometimes'],

        ];
    }

    public function messages()
    {
        return [
            // 'odependency.required' => 'Debe cargar la dependencia de origen.',
            'number_memo.required' => 'Debe cargar el nro del documento.',
            'ref.required' => 'Debe cargar la referencia del documento.',
            'obs.required' => 'Debe cargar la observación.',
            'date_doc.required' => 'Debe cargar la fecha del documento.',
            // 'type.required' => 'Debe cargar el tipo de documento.',
            //'problem.required' => 'Debe cargar el incoveniente que esta presentando.',

            //'ruc' => 'Cargue RUC',
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


    // public function getTypeId()
    // {
    //     return $this->get('type')['id'];
    // }

    // public function getOrigenId()
    // {
    //     return $this->get('odependency')['id'];
    // }
}
