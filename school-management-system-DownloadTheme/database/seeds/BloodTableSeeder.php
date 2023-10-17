<?php

use App\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloods')->delete();
        $types=['O-','O+','A+','A-','B+','B-','AB'];

foreach($types as $type){
    Blood::create([
        'name'=>$type
    ]);
}

    }
}
