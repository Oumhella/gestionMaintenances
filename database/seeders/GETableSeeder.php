<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GETableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ge_tasks')->delete();

        DB::table('ge_tasks')->insert([
            ['name' => 'Vérification état général des PCS boxes / Ecrans', 'checkbox_options' => 'default'],
            ['name' => 'Nettoyage des PC boxes / Ecrans', 'checkbox_options' => 'custom'],
            ['name' => 'Contrôle de la connectivité réseau des PC boxes', 'checkbox_options' => 'custom'],
            ['name' => 'Vérification des paramètres de configuration des PC boxes/ Ecrans.', 'checkbox_options' => 'default'],
            ['name' => 'Calibration des écrans', 'checkbox_options' => 'custom'],
        ]);
    }
}
