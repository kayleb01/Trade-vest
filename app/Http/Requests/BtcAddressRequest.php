<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BtcAddressRequest extends FormRequest
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
            'btc_address' => 'required|string',
            'eth_address' => 'nullable|string',
            'usdt_address' => 'nullable|string'
        ];
    }
}
