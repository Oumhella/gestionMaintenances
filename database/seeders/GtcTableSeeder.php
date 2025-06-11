<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GtcTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gtc_tasks')->delete();

        DB::table('gtc_tasks')->insert([
            ['name' => 'Vérification de l\'état de la sous-station (Extérieur / Intérieur)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la documentation', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la mise sous tension de la sous-station', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des états de l\'automate et modules', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la mise en tension de l\'automate et modules', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des états des points E/S (voyants des modules)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du câblage, goulottes et chemins de câble', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des étiquettes', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la mise à la terre', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du contact de porte', 'checkbox_options' => 'default'],
            ['name' => 'Nettoyage de la sous-station (extérieur)', 'checkbox_options' => 'custom'],
        ]);
    }
}
