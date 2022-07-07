<?php

namespace Database\Seeders;

use App\Models\Unversity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unversity::create(['name'=>'National University of Uzbekistan']);
    }
}
