<?php



namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ElectriqueTableSeeder extends Seeder
{

    public function run(): void
    {
    DB::table('electrique_tasks')->delete();

    DB::table('electrique_tasks')->insert([
    ['name' => 'Etat général', 'checkbox_options' => 'default'],
    ['name' => 'Etat câbles d\'alimentation', 'checkbox_options' => 'default'],
    ['name' => 'Fixation au support', 'checkbox_options' => 'default'],
    ['name' => 'Mise à la terre', 'checkbox_options' => 'default'],
    ['name' => 'Propreté', 'checkbox_options' => 'default'],
        ['name' => 'Affichage /lisibilité', 'checkbox_options' => 'default'],
        ['name' => 'Etat voyants lumineux', 'checkbox_options' => 'default'],
    ]);
    }
    }
