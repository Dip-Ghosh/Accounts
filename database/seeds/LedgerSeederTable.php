<?php

use Illuminate\Database\Seeder;

class LedgerSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groupledgers')->insert([
            'code' => 1,
            'name' => 'Asset',
            'description' => 'This is bkash',
        ]);
        DB::table('groupledgers')->insert([
            'code' => 2,
            'name' => 'Liability',
            'description' => 'This is rocket',
        ]);
        DB::table('groupledgers')->insert([
            'code' => 3,
            'name' => 'Income',
            'description' => ' This is nogod',
        ]);
        DB::table('groupledgers')->insert([
            'code' => 4,
            'name' => 'Expense',
            'description' => ' This is Ucash',
        ]);
    }
}
