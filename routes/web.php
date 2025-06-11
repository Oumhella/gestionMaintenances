<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenancepreventiveController;
use App\Http\Controllers\PlanningAnnuelController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'verified');
Route::get('/dashboard/maintenance_preventive', [DashboardController::class, 'maintenance_preventive'])->name('dashboard.maintenance_preventive');
Route::get('/dashboard/maintenance_curative', [DashboardController::class, 'maintenance_curative'])->name('dashboard.maintenance_curative');
Route::get('/dashboard/gestion_des_tickets_clients', [DashboardController::class, 'gestion_des_tickets_clients'])->name('dashboard.gestion_des_tickets_clients');



Route::get('/dashboard/maintenance_preventive', [MaintenancepreventiveController::class, 'index'])->name('dashboard.maintenance_preventive')->middleware('auth', 'verified');


// In web.php
Route::get('/dashboard/maintenance_preventive/planning_annuel', [App\Http\Controllers\PlanningAnnuelController::class, 'index'])->name('planning.annuel');

Route::post('/store-common-data', [FormController::class, 'storeCommonData'])->name('storeCommonData');

//Route::get('/planning_annuel', [PlanningAnnuelController::class, 'index'])->name('planning_annuel')->middleware('auth', 'verified');

Route::get('/dashboard/maintenance_preventive/planning_annuel/events/fetch', [PlanningAnnuelController::class, 'fetch']);
Route::post('/dashboard/maintenance_preventive/planning_annuel/events/store', [PlanningAnnuelController::class, 'store']);

//Route::post('/planning-annuel/events/update', [PlanningAnnuelController::class, 'update']);
Route::get('/Coffrets_informatique', [TaskController::class, 'showCoffretsInformatique'])->name('coffrets_informatique');
//Route::post('/Coffrets_informatique', [TaskController::class, 'coffretstore'])->name('coffrets_informatique.store');
Route::post('/Coffrets_informatique', [TaskController::class, 'coffretstore'])->name('coffrets_informatique.store');
Route::get('/GTC', [TaskController::class, 'showgtc'])->name('gtc');
Route::post('/GTC', [TaskController::class, 'gtcstore'])->name('gtc.store');

Route::get('/GE', [TaskController::class, 'showge'])->name('ge');
Route::post('/GE', [TaskController::class, 'gestore'])->name('ge.store');
Route::get('/PCS', [TaskController::class, 'showpcs'])->name('pcs');
Route::post('/PCS', [TaskController::class, 'pcsstore'])->name('pcs.store');
Route::get('/comptage_eau', [TaskController::class, 'showeaucomptage'])->name('comptage_eau');
Route::post('/comptage_eau', [TaskController::class, 'eaustore'])->name('comptage_eau.store');
Route::get('/comptage_electrique', [TaskController::class, 'showelectriquecomptage'])->name('comptage_electrique');
Route::post('/comptage_electrique', [TaskController::class, 'electriquestore'])->name('comptage_electrique.store');
//Route::get('/Show', [TaskController::class, 'show'])->name('show');
//Route::get('/show_gtc', [TaskController::class, 'show_gtc'])->name('show_gtc');
//Route::get('/show_eau', [TaskController::class, 'show_eau'])->name('show_eau');
//Route::get('/show_ge', [TaskController::class, 'show_ge'])->name('show_ge');
//Route::get('/show_pcs', [TaskController::class, 'show_pcs'])->name('show_pcs');

Route::get('/coffrets-informatique/export-pdf', [TaskController::class, 'exportPdf'])->name('coffrets_informatique.export_pdf');









Route::get('/show_images', [TaskController::class, 'showImages'])->name('showImages');



Route::get('/intervention_selection', [TaskController::class, 'selection'])->name('intervention_selection');

Route::post('/intervention_selection', [TaskController::class, 'storeCommonData'])->name('storeCommonData');

Route::get('/intervention_overview', [TaskController::class, 'overview'])->name('intervention.overview');
//Route::get('/filter_interventions', [TaskController::class, 'filterInterventions'])->name('filterInterventions');
Route::get('/intervention_filter', [TaskController::class, 'filterInterventions'])->name('filterInterventions');
Route::get('/interventions/{id}', [TaskController::class, 'showIntervention'])->name('interventions.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//Route::get('/dashboard/maintenance_preventive/intervention_sur_site', [App\Http\Controllers\intervention_sur_siteController::class, 'index'])->name('intervention_sur_site');
