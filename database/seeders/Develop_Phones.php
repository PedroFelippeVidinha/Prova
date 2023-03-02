<?php

namespace Database\Seeders;

use App\Models\Phones;
use Illuminate\Database\Seeder;

class Develop_Phones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phones::factory()->count(10)->create();
    }
}
