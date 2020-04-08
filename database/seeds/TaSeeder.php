<?php

use App\SchoolYear;
use Illuminate\Database\Seeder;

class TaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = 2010;
        for ($i = 0; $i < 12; $i++) {
            $a = $tahun + 1;
            SchoolYear::create([
                'kdtahunajaran' => $tahun . "/" . $a,
                'tahunajaran'   => $tahun . "/" . $a,
            ]);
            $tahun++;
        }
    }
}
