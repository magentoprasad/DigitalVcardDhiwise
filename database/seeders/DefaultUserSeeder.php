<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DefaultUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return  void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $inputUser = [
            'username' => $faker->word,
            'name' => $faker->word,
            'is_active' => $faker->boolean(true),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'email' => 'xrath@yahoo.com',
            'password' => Hash::make('tgczchuz'),
            'email_verified_at' => Carbon::now(),
            'user_type' => User::TYPE_USER
        ];

        $userUser  = User::create($inputUser);
        $roleUser  = Role::whereName('User')->first();
        $userUser->assignRole($roleUser);

        $inputAdmin = [
            'username' => $faker->word,
            'name' => $faker->word,
            'is_active' => $faker->boolean(true),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'email' => 'alba04@yahoo.com',
            'password' => Hash::make('84dsujpg'),
            'email_verified_at' => Carbon::now(),
            'user_type' => User::TYPE_ADMIN
        ];

        $userAdmin  = User::create($inputAdmin);
        $roleAdmin  = Role::whereName('Admin')->first();
        $userAdmin->assignRole($roleAdmin);

        $roleSystemUser  = Role::whereName(User::DEFAULT_ROLE)->first();
        $inputSystemUser = [
            'name' => $faker->word,
            'is_active' => $faker->boolean(true),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'username' => 'nolan.casimir',
            'email' => 'addison07@simonis.net',
            'password' => Hash::make(';?m!^M9X|'),
            'email_verified_at' => Carbon::now(),
            'user_type' => User::TYPE_ADMIN
        ];

        $systemUser = User::create($inputSystemUser);
        $systemUser->assignRole($roleSystemUser);

        $permissions = Permission::all();
        $roleSystemUser->givePermissionTo($permissions);
    }
}
