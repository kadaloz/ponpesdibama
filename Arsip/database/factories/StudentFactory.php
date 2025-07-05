<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['Asrama', 'Pulang-Pergi']);
        $gender = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        $year = $this->faker->numberBetween(2022, now()->year);

        return [
            'nis' => Student::generateUniqueNis($type, $gender, $year),
            'name' => $this->faker->name(),
            'gender' => $gender,
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->date(),
            'nisn' => $this->faker->numerify('##########'),
            'last_education' => $this->faker->randomElement(['MI', 'SD', 'SMP']),
            'school_origin' => $this->faker->company(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'parent_name' => $this->faker->name(),
            'parent_phone' => $this->faker->phoneNumber(),
            'parent_email' => $this->faker->safeEmail(),
            'parent_occupation' => $this->faker->jobTitle(),
            'admission_year' => $year,
            'status' => $this->faker->randomElement(['aktif', 'non-aktif', 'lulus']),
            'type' => $type,
            'halaqoh_period' => $type === 'Asrama' ? $this->faker->randomElement(['Sore', 'Malam']) : null,
        ];
    }
}
