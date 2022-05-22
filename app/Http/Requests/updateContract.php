<?php

namespace App\Http\Requests;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class updateContract extends FormRequest
{
    use FailedValidation;
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
            'contract_id' => 'required|exists:contracts,id',
            'name' => 'nullable|string',
            'min_amount' => 'nullable|integer',
            'max_amount' => 'nullable|integer',
            'weekly_returns' => 'nullable|integer',
            'bonus' => 'nullable|integer',
            'category' => 'nullable|string'
        ];
    }
}
