<?php


use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_roles')->delete();
        \DB::table('user_roles')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'role_id' => NULL,
            ),
            1 => 
            array (
                'user_id' => 2,
                'role_id' => 1,
            ),
        ));
        
        
    }
}