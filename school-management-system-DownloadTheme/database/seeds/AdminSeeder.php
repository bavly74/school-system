<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $admin=[
          'name'=>  'bavly',
        'password'  => '12345678',
        'email'=>    'b@gmail.com'
        ];

            User::create([
                'name'=>$admin['name'],
                'password'=>$admin['password'],
                'email'=>$admin['email']
            ]);

    }
}
