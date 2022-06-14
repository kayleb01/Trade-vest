<?php

namespace App\Http\Requests;

use App\Models\Contract;
use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{
    use FailedValidation;

    protected $contract;

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
            'amount' => 'required|integer',
            'contract_id' => 'required|integer|exists:contracts,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'contract_id.exists' => 'Contract ID provided does\'nt exists in our records',
        ];
    }

    /**
     * configure the validator's instance
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->isAmountValid($validator);
        });
    }

    public function contract()
    {
        return $this->contract ?: tap(Contract::findOrFail($this->contract_id), function ($contract) {
            $this->contract = $contract;
        });
    }

    protected function isAmountValid($validator)
    {
        if ($this->amount < $this->contract()->min_amount || $this->amount > $this->contract()->max_amount) {
            $validator->errors()->add('amount', 'Amount for this contract must be between $' . $this->contract()->min_amount . ' and $' . $this->contract()->max_amount);
        }
    }
}
