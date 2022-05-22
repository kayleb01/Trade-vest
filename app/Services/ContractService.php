<?php
namespace App\Services;

use App\Models\Contract;

class ContractService
{
    public function updateContract(array $contractData)
    {
        $contract = Contract::findOrFail($contractData['contract_id']);
        $update = $contract->update($contractData);

        abort_if(!$update, 500, 'an error occured, please try agin later');
        return $contract;
    }
}
