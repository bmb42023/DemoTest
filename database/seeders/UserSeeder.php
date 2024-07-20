<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
//use DB;
use Illuminate\Support\Facades\DB as FacadesDB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
       DB::table('users')->insert([

             //Admin
             [
                'name' =>'Admin',
                'username' =>'admin',
                'email' =>'admin@gmail.com',
                'password' =>Hash::make('111'),
                'role' =>'admin',
                'status' =>'1',
            ],
           //Instructor
           [
            'name' =>'Instructor',
            'username' =>'instructor',
            'email' =>'instructor@gmail.com',
            'password' =>Hash::make('111'),
            'role' =>'instructor',
            'status' =>'1',
           ],
           //User
           [
            'name' =>'User',
            'username' =>'user',
            'email' =>'user@gmail.com',
            'password' =>Hash::make('111'),
            'role' =>'user',
            'status' =>'1',
           ],



        ]);
    } 
}
