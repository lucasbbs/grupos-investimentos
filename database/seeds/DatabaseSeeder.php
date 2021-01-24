<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::create([
			'cpf' 			=> '03711281109', 
			'name' 			=> 'Lucas', 
			'phone' 		=> '61983499994', 
			'birth' 		=> '1990-11-07', 
			'gender' 		=> 'M', 
			'email' 		=> 'lucasbbs@live.fr', 
			'password' 		=>  env('PASSWORD_HASH') ? bcrypt('123456') : '123456', 
		]);

    }
}
