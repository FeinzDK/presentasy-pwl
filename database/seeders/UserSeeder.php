<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Membuat pengguna pustakawan
        User::factory()->create([
            'name' => 'pustakawan',
            'email' => 'pustakawan@unsur.ac.id',
            'password' => Hash::make('password'),
        ])->assignRole('pustakawan')
          ->givePermissionTo(['edit_book', 'edit_user']);

        // Membuat pengguna mahasiswa
        for ($i = 1; $i <= 19; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Assign role dan permission
            $user->assignRole('mahasiswa')->givePermissionTo(['view_book']);
        }
    }
}
