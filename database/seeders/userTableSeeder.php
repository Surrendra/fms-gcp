<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'email' => 'zuren.dra@baliprov.go.id'
        ],[
            'name' => 'Surendra Made',
            'email' => 'zuren.dra@baliprov.go.id',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('11235811'),
        ]);
        $token = $user->createToken('root')->plainTextToken;
    }
}
