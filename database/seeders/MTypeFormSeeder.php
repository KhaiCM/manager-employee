<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MTypeFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_type_forms')->insert([
            ['name' => 'Tardiness', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Leave early', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Unpaid leave', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
