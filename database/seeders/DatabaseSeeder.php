<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
        CollegeStudentTypesSeeder::class,
        CollegeBranchesSeeder::class,
        CollegeYearLevelsSeeder::class,
        CollegeRegionsSeeder::class,
        CollegeCoursesSeeder::class,
        CollegeDocumentsSeeder::class,
        // Add others if needed later

        // SHS seeders
            ShsStudentTypesSeeder::class,
            ShsBranchesSeeder::class,
            ShsYearLevelSeeder::class,
            ShsCoursesSeeder::class,
            ShsDocumentSeeder::class,
            CollegeShsIndigenousSeeder::class,
            CollegeShsDisabilitySeeder::class,
    ]);
}
}
