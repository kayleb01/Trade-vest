<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProofUpload extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'proof' => 'required|image|mimes:png,jpg',
            'transaction_id' => 'required|exists:user_transactions,id'
        ];
    }
}
