<?php

namespace Database\Seeders;

use App\Models\EquipmentType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquipmentType::query()->insert([
            ['name' => 'TP-Link TL-WR74', 'mask' => 'XXAAAAAXAA', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300', 'mask' => 'NXXAAXZXaa', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 E ', 'mask' => 'NAAAAXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 A ', 'mask' => 'AAAAAXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 B ', 'mask' => 'ZAAAXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 C ', 'mask' => 'aAAAXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 D ', 'mask' => 'aaAAXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 E ', 'mask' => 'aaaAXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 F ', 'mask' => 'aaaaXZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 G ', 'mask' => 'aaaaaZXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 H ', 'mask' => 'aaaaaaXXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 I ', 'mask' => 'aaaaaaaXX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 J ', 'mask' => 'aaaaaaaaX', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 K ', 'mask' => 'aaaaaaaaa', 'created_at' => Carbon::now()],
            ['name' => 'D-Link DIR-300 L ', 'mask' => 'Xaaaaaaaa', 'created_at' => Carbon::now()],
        ]);
    }
}
