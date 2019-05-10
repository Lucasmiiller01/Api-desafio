<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // criando um usuário qualquer para utilizar Passaport Api
        $user = new User();
        $user->email = "dev@mail.com";
        $user->password = bcrypt("secret");
        $user->save();
    }
}
