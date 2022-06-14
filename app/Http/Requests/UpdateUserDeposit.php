<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDeposit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role->name == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'total' => 'required|integer',
            'compounded' => 'required|integer',
            'initial' => 'required|integer',
            'top_up' => 'required|integer',
            'locked' => 'required|integer',
        ];
    }
}
