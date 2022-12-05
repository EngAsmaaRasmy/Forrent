<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::factory()->count(4)->create();
    }
}
