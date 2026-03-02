<?php

namespace Database\Seeders;

use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $baseSubjects = [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'English',
            'Bangla',
            'History',
            'Geography',
            'Civics',
            'Economics',
            'Accounting',
            'Finance',
            'Marketing',
            'Management',
            'Computer Science',
            'Programming Fundamentals',
            'Data Structures',
            'Algorithms',
            'Database Systems',
            'Operating Systems',
            'Software Engineering',
            'Web Development',
            'Artificial Intelligence',
            'Machine Learning',
            'Cyber Security',
            'Networking',
            'Statistics',
            'Probability',
            'Linear Algebra',
            'Discrete Mathematics',
            'Digital Logic Design',
            'Microprocessors',
            'Embedded Systems',
            'Cloud Computing',
            'Mobile App Development',
            'Human Resource Management',
            'Entrepreneurship',
            'Business Communication',
            'Project Management',
            'Environmental Science',
            'Ethics',
            'Sociology',
            'Psychology',
            'Philosophy',
            'Islamic Studies',
            'Research Methodology',
            'Compiler Design',
            'Computer Graphics',
            'Data Mining',
            'Information Systems'
        ];

        $subjects = [];

        // Generate additional subjects to make total 100
        for ($i = 51; $i <= 100; $i++) {
            $baseSubjects[] = "Elective Subject {$i}";
        }

        foreach ($baseSubjects as $index => $name) {

            // Get first 3 letters (remove spaces, uppercase)
            $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $name), 0, 3));

            // Ensure prefix has 3 characters
            $prefix = str_pad($prefix, 3, 'X');

            $number = str_pad($index + 1, 3, '0', STR_PAD_LEFT);

            $code = $prefix . '-' . $number;

            Subject::updateOrCreate(
                ['code' => $code],
                [
                    'name'        => $name,
                    'description' => $name . ' course description for academic curriculum.',
                    'is_active'   => rand(0, 1),
                    'is_deleted'  => 0,
                ]
            );
        }
    }
}
