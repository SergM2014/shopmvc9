<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
          'name' => 'user',
          'email' => 'user@user.user',
          'password' => bcrypt('user'),
          'role' => 'user'
       ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@superadmin.superadmin',
            'password' => bcrypt('superadmin'),
            'role' => 'superadmin'
        ]);
    }
}
