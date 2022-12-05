<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{

    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name,
            'description'=>$this->faker->paragraph,
            'price'=>$this->faker->randomElement([100,200,300,400,500]),
            'period_unit'=>$this->faker->name,
            'discount'=>$this->faker->randomElement(['10%','20%','30%','40%']),
            'discount_period'=>$this->faker->date,
            'area_id'=> Area::all()->random()->id,
            'sub_category_id'=> SubCategory::all()->random()->id,
            'service_provider_id'=> ServiceProvider::all()->random()->id,
            'disabled'=>$this->faker->boolean,

           
        ];
    }
}
