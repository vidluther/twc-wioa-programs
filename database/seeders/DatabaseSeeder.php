<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\Program;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $name = "vid luther";
        $email = 'v@l.com';
        $password = Hash::make('Testing321');

        \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => '',
            'remember_token' => null,
        ]);

        $this->command->line('Calling Program Seeder');
        $this->call(ProgramSeeder::class);
        $this->command->line('Imported from CSV!');
    }
}

