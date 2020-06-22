<?php

use Illuminate\Database\Seeder;
use App\AdminUser;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        AdminUser::create([
        		'name'=>'Michael',
        		'email'=>'mic@example.com',
        		'password'=>'$2y$10$7L1jAEiXq.fpQhMFOCeTz.oVo9ASjD4kM3xCoMYV..j6dJDtiFqRS',
        		'status'=>'0',

        	]);
    }
}
