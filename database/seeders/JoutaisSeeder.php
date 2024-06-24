<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JoutaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('joutais')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => '納期調整中'
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => '出荷済'
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => 'キャンセル'
            ],
        ]);
    }
}
