<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('coffrets_informatique_tasks')->delete();

        DB::table('coffrets_informatique_tasks')->insert([
            ['name' => 'Vérification de l\'état du coffret (Intérieur / Extérieur)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification de la documentation', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des états des équipements (Switch…)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du fonctionnement des Switchs (Voyant)', 'checkbox_options' => 'default'],
            ['name' => 'Vérification du câblage, cordons, goulottes et chemins de câble', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des étiquettes et repérage', 'checkbox_options' => 'default'],
            ['name' => 'Nettoyage du coffret informatique (extérieur)', 'checkbox_options' => 'custom'],
            ['name' => 'Nettoyage des équipements informatiques (de l\'extérieur et sans produits)', 'checkbox_options' => 'custom'],
        ]);
    }
}
