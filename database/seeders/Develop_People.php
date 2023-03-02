<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Seeder;

class Develop_People extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        People::factory()->count(10)->create();
    }
}
