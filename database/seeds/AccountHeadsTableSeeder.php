<?php

use Illuminate\Database\Seeder;

class AccountHeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_heads')->insert([
            'accountCode' => 1,
            'accountName' => 'Asset',
            'transactionType' => 'bkash',
        ]);
        DB::table('account_heads')->insert([
            'accountCode' => 2,
            'accountName' => 'Liability',
            'transactionType' => 'rocket',
        ]);
        DB::table('account_heads')->insert([
            'accountCode' => 3,
            'accountName' => 'Income',
            'transactionType' => 'nogod',
        ]);
        DB::table('account_heads')->insert([
            'accountCode' => 4,
            'accountName' => 'Expense',
            'transactionType' => 'Ucash',
        ]);
    }
}
