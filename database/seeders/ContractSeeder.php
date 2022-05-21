<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::create([
            'name' => 'bronze',
            'min_amount' => 500,
            'max_amount' => 4999,
            'weekly_returns' => 1 ,
            'bonus' => null,
            'category' => 'daily contract'
        ]);

        Contract::create([
            'name' => 'silver',
            'min_amount' => 5000,
            'max_amount' => 19999,
            'weekly_returns' => 1.5 ,
            'bonus' => null,
            'category' => 'daily contract'
        ]);

        Contract::create([
            'name' => 'gold',
            'min_amount' => 20000,
            'max_amount' => 49999,
            'weekly_returns' => 2 ,
            'bonus' => null,
            'category' => 'daily contract'
        ]);

        Contract::create([
            'name' => 'diamond',
            'min_amount' => 50000,
            'max_amount' => 500000,
            'weekly_returns' => 2 ,
            'bonus' => null,
            'category' => 'daily contract'
        ]);

        //weekly contracts

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 1000,
            'max_amount' => 4999,
            'weekly_returns' => 10 ,
            'bonus' => 5,
            'category' => 'week contract'
        ]);

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 5000,
            'max_amount' => 19999,
            'weekly_returns' => 15 ,
            'bonus' => 7,
            'category' => 'week contract'
        ]);

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 20000,
            'max_amount' => 49999,
            'weekly_returns' => 20 ,
            'bonus' => 10,
            'category' => 'week contract'
        ]);

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 50000,
            'max_amount' => 500000,
            'weekly_returns' => 25 ,
            'bonus' => 15,
            'category' => 'week contract'
        ]);


        //compound contracts
        Contract::create([
            'name' => 'bronze',
            'min_amount' => 1000,
            'max_amount' => 4999,
            'weekly_returns' => 11 ,
            'bonus' => null,
            'category' => 'compound contract'
        ]);

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 5000,
            'max_amount' => 19999,
            'weekly_returns' => 13 ,
            'bonus' => null,
            'category' => 'compound contract'
        ]);

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 20000,
            'max_amount' => 49999,
            'weekly_returns' => 16 ,
            'bonus' => null,
            'category' => 'compound contract'
        ]);

        Contract::create([
            'name' => 'bronze',
            'min_amount' => 50000,
            'max_amount' => 500000,
            'weekly_returns' => 15 ,
            'bonus' => null,
            'category' => 'compound contract'
        ]);

        //contract nfp trade
        Contract::create([
            'name' => 'contract plan for NFP trade',
            'min_amount' => 3000,
            'max_amount' => 1000000,
            'weekly_returns' => 50 ,
            'bonus' => 20,
            'category' => 'contract nfp trade'
        ]);
    }
}
