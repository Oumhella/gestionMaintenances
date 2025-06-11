<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PcsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pcs_tasks')->delete();

        DB::table('pcs_tasks')->insert([
            ['name' => 'Vérification de l\'état de la baie informatique', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la documentation', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des états des matériels informatiques (Postes, serveurs…)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du fonctionnement des matériels informatiques (Postes, serveurs…)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des états des équipements de réseau (Switchs…)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du fonctionnement des équipements de réseau (Switchs…)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de l\'état du mobilier', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du câblage, goulottes et chemins de câble', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des étiquettes', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des systèmes de supervision', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la communication réseau', 'checkbox_options' => 'default'],
            ['name' => 'Vérification la hypervision', 'checkbox_options' => 'default'],
            ['name' => 'Nettoyage de la baie/coffret informatique (extérieur)', 'checkbox_options' => 'custom'],
            ['name' => 'Nettoyage des équipements informatiques', 'checkbox_options' => 'custom'],
        ]);
    }
}
