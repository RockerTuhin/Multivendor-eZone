<?php

//namespace Database\Seeds;

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 3,
                'name' => 'Tuhin',
                'email' => 'rockertuhin96@gmail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$UlJNpb/xTBP57oeuiyr5Ue5gFnZzLWPXB6X.ZkXlmav28YfiInFYa',
                'remember_token' => 'a5wlKkww2CGlUDT1Taz4az4ulJ2LbvLJ2pDO7oM4teEOQ7o2NphJjJkHb6Cv',
                'settings' => NULL,
                'created_at' => '2020-10-05 18:52:59',
                'updated_at' => '2020-10-05 18:52:59',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$iwnWjGssBxZamQ1TAneDX.sbAFA5hsTYNaZzEyvw2rZWBpAXQDO0i',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-10-20 19:13:08',
                'updated_at' => '2020-10-20 19:13:08',
            ),
            0 => 
            array (
                'id' => 3,
                'role_id' => 2,
                'name' => 'Rokib',
                'email' => 'rokib@gmail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$UlJNpb/xTBP57oeuiyr5Ue5gFnZzLWPXB6X.ZkXlmav28YfiInFYa',
                'remember_token' => 'a5wlKkww2CGlUDT1Taz4az4ulJ2LbvLJ2pDO7oM4teEOQ7o2NphJjJkHb6Cv',
                'settings' => NULL,
                'created_at' => '2020-10-05 18:52:59',
                'updated_at' => '2020-10-05 18:52:59',
            ),
            1 => 
            array (
                'id' => 4,
                'role_id' => 3,
                'name' => 'Ripon',
                'email' => 'ripon@gmail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$iwnWjGssBxZamQ1TAneDX.sbAFA5hsTYNaZzEyvw2rZWBpAXQDO0i',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-10-20 19:13:08',
                'updated_at' => '2020-10-20 19:13:08',
            ),
        ));
        
        
    }
}