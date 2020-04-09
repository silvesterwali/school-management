<?php
use App\Student;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name'              => $faker->username,
                'email'             => $faker->unique()->email,
                'email_verified_at' => now(),
                'password'          => Hash::make(12345678),
                'remember_token'    => Str::random(10),
                'menuroles'         => 'siswa',
            ]);
            $user->assignRole('siswa');
            Student::create([
                "user_id"            => $user->id,
                "nisn"               => $faker->ean8(),
                "nama"               => $faker->firstname . " " . $faker->lastname,
                "jk"                 => rand(0, 1),
                "tempatlahir"        => $faker->city(),
                "agama"              => 'Katolik',
                "tanggallahir"       => date('Y-m-d'),
                "namaayah"           => $faker->titlemale . $faker->firstnamemale,
                "namaibu"            => $faker->titlefemale . $faker->firstnamefemale,
                "namawali"           => $faker->firstnamefemale,
                "alamatorangtuawali" => $faker->address(),
                "tanggalmasuk"       => date('Y-m-d'),
                
                "grade"              => rand(1, 3),
                "creator"            => "robot",
            ]);

        }
    }
}
