<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{

    protected $model = SubCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name'=>$this->faker->randomElement(['computers','boots','java','phones']),
            'image'=>$this->faker->randomElement(['jbg','fbeg','jbeg']),
            'description'=>$this->faker->paragraph,
            'category_id'=> Category::all()->random()->id,
            
            
        ];
    }
}
