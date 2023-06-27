<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipment::query()->insert([
            ['serial_number' => '00AAAAA0aa', 'desc' => 'abcdefg', 'equipment_type_id' => 1, 'created_at' => Carbon::now()],
            ['serial_number' => '000AA0-0aa', 'desc' => 'abcdefg1', 'equipment_type_id' => 2, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-000', 'desc' => 'abcdefg2', 'equipment_type_id' => 3, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-001', 'desc' => 'abcdefg3', 'equipment_type_id' => 4, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-04', 'desc' => 'abcdefg4', 'equipment_type_id' => 5, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-05', 'desc' => 'abcdefg5', 'equipment_type_id' => 6, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-06', 'desc' => 'abcdefg6', 'equipment_type_id' => 7, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-07', 'desc' => 'abcdefg7', 'equipment_type_id' => 8, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-08', 'desc' => 'abcdefg8', 'equipment_type_id' => 9, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-09', 'desc' => 'abcdefg9', 'equipment_type_id' => 10, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-010', 'desc' => 'abcdefg10', 'equipment_type_id' => 11, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-011', 'desc' => 'abcdefg11', 'equipment_type_id' => 12, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-012', 'desc' => 'abcdefg12', 'equipment_type_id' => 13, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-013', 'desc' => 'abcdefg13', 'equipment_type_id' => 14, 'created_at' => Carbon::now()],
            ['serial_number' => '0AAAA0-014', 'desc' => 'abcdefg14', 'equipment_type_id' => 15, 'created_at' => Carbon::now()],
        ]);
    }
}
