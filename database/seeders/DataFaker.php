<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Testing\Fakes\Fake;

class DataFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      for ($i=0; $i <400 ; $i++) { 
        $faker = Faker::create();
        $student = new Students;
        $student->student_name = $faker->name;
        $student->roll_no = $faker->randomDigit();
        $student->student_email = $faker->email;
        $student->student_password = $faker->password;
        $student->student_address = $faker->address;
        $student->student_phone = $faker->numerify('##########');
        $student->student_standerd = $faker->randomDigit();
        $student->student_div = $faker->randomLetter();
        $student->save();
      }

    }
}
