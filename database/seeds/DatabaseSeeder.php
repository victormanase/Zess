<?php


use Database\Seeders\LaratrustSeeder;
use Database\Seeders\PatientTypesTableSeeder;
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
        // $this->call(UsersTableSeeder::class);
        $this->call(PatientTypesTableSeeder::class);
        $this->call(LaratrustSeeder::class);
    }
}
