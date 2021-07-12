<?php

namespace Database\Seeders;

use App\Models\PatientType;
use Illuminate\Database\Seeder;

class PatientTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [["name" => "insurance"], ["name" => "card"]];
        foreach ($types as $key => $type) {
            PatientType::create($type);
        }
    }
}
