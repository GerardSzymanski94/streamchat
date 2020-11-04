<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

        User::create([
            'name' => 'Gerard',
            'email' => 'gerard@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

        User::create([
            'name' => 'Norbert',
            'email' => 'norbert@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

        User::create([
            'name' => 'Gość 1',
            'email' => 'gosc1@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

        User::create([
            'name' => 'Gość 2',
            'email' => 'gosc2@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

        User::create([
            'name' => 'Gość 3',
            'email' => 'gosc3@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

    }
}
