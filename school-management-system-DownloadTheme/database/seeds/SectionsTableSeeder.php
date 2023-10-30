<?php

use App\Classroom;
use App\Grade;
use App\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $Sections = [
            ['en' => 'a', 'ar' => 'ا'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];

        foreach ($Sections as $section) {
            Section::create([
                'name' => $section,
                
                'grade_id' => Grade::all()->unique()->random()->id,
                'classroom_id' => Classroom::all()->unique()->random()->id
            ]);
        }
    }
}