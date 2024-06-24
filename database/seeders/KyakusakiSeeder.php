<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KyakusakiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('kyakusaki')->insert([
            [
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'name' => 'A株式会社'
            ],
            [
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'name' => 'B株式会社'
            ],
            [
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'name' => 'C株式会社'
            ]
        ]);
    }
}
