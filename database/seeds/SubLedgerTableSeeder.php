<?php

use Illuminate\Database\Seeder;

class SubLedgerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sub_group_ledgers')->insert([
            'code' => 1,
            'name' => 'Asset',
            'description' => 'This is bkash',
            'group_ledger_id'=>1
        ]);
        DB::table('sub_group_ledgers')->insert([
            'code' => 2,
            'name' => 'Liability',
            'description' => 'This is rocket',
            'group_ledger_id'=>3
        ]);
        DB::table('sub_group_ledgers')->insert([
            'code' => 3,
            'name' => 'Income',
            'description' => ' This is nogod',
            'group_ledger_id'=>3
        ]);
        DB::table('sub_group_ledgers')->insert([
            'code' => 4,
            'name' => 'Expense',
            'description' => ' This is Ucash',
            'group_ledger_id'=>4
        ]);
    }
}
