<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Lucas Siqueira',
            'email' => 'lucas@lsiqueira.dev',
            'password' => static::$password ??= Hash::make('password'),
            'avatar_url' => "https://xsgames.co/randomusers/avatar.php?g=pixel",
            'provider_name' => 'email',
            'phone' => '(00) 9 0000-0000',
            'status' => 'active'
        ]);
        User::factory(4000)->create();
    }
}
