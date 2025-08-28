<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShsYearLevel;

class ShsYearLevelSeeder extends Seeder
{
    public function run()
    {
        // I-delete ang lahat ng records (instead of truncate)
        ShsYearLevel::query()->delete();

        $levels = [
            ['level_id' => 11, 'level_name' => 'Grade 11'],
            ['level_id' => 12, 'level_name' => 'Grade 12'],
        ];

        foreach ($levels as $level) {
            ShsYearLevel::create($level);
        }
    }
}