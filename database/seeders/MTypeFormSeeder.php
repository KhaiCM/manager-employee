<?php

namespace Database\Seeders;

use DateTime;
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
            ['name' => 'Tardiness', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'Leave early', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ]);
    }
}
