<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicLevel;

class AcademicLevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = ['Pre O Level', 'O Level', 'A Level'];

        foreach ($levels as $name) {
            AcademicLevel::firstOrCreate(['name' => $name]);
        }
    }
}
