<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $data=['Matematik analiz','Amaliy matematika va kompyuter tahlili','Umumiy fizika',"Botanika va o‘simliklar fiziologiyasi",'Ekologiya','Organik kimyo','Xorijiy til va adabiyoti','Iqtisodiyot nazariyasi','Psixologiya','Jurnalistika','Jahon tarixi','Tabiiy geografiya','Geodinamika va tektonika','Gidrometeorologiya va atrof muhit monitoringi','Taekvondo va sport faoliyati'];
        return [
            'name' => $data[$this->faker->numberBetween(0, 9)],
            'faculty_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
