<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEarnings extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'paid' => 'required|integer',
            'compounded' => 'required|integer',
            'referral' => 'required|integer',
        ];
    }
}
