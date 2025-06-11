<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EauTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('eau_tasks')->delete();

        DB::table('eau_tasks')->insert([
            ['name' => 'Vérification de l\'état générale', 'checkbox_options' => 'default'],
            ['name' => 'Vérification des raccordements et serrage', 'checkbox_options' => 'custom'],
            ['name' => 'Nettoyage', 'checkbox_options' => 'custom'],
        ]);
    }
}
