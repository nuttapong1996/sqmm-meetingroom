<?php

namespace Database\Seeders;

use App\Models\RoomStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statues = [
           ['name' => 'จอง'],
           ['name' => 'ยกเลิก'],
        ];

        foreach($statues as $status){
            RoomStatus::firstOrCreate($status);
        }
    }
}
