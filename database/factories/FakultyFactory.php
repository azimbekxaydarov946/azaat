<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fakulty>
 */
class FakultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $data=['Matematika','Amaily matematika va intellektual texnologiyalar','Fizika','Biologiya','Ekologiya','Kimyo','Xorijiy filologiya','Iqtisodiyot','Ijtimoiy fanlar','Jurnalistika','Tarix','Geografiya va tabiiy resurslar','Geologiya va geoinformatsion tizimlar','Gidrometeorologiya','Taekvondo va sport faoliyati'];
        return [
            'name' => $data[$this->faker->unique()->numberBetween(0, count($data)-1)],
            'university_id' => 1,
        ];
    }
}
