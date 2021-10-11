<?php

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Resident::class, 20)->create();
        factory(User::class)->create(['username' => 'admin']);
        // $this->call(UserSeeder::class);
    }
}
