<?php
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','ahmedzainsalem@gmail.com')->first();

        if(!$user){
            User::create([
                'first_name' => 'Ahmed',
                'last_name' => 'Salem',
                'mobile' => '0522911747',
                'gender' => 'Male',
                'birthday' =>'1984-09-01',
                'email' => 'ahmedzainsalem@gmail.com',
                'password' => app('hash')->make('password')
            ]);
        }
    }
}
