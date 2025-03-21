<?php

use Illuminate\Support\Facades\Route;
// Chemin des contrôleurs
use App\Http\Controllers\connexionController;
use App\Http\Controllers\etatFraisController;
use App\Http\Controllers\gererFraisController;
use App\Http\Controllers\validerFraisController;

// Création des groupes de routes
Route::controller(connexionController::class)->group(function () {
    Route::get('/', 'connecter')->name('chemin_connexion');
    Route::post('/', 'valider')->name('chemin_valider');
    Route::get('/deconnexion', 'deconnecter')->name('chemin_deconnexion');
});

Route::controller(etatFraisController::class)->group(function () {
    Route::get('/selectionMois', 'selectionnerMois')->name('chemin_selectionMois');
    Route::post('/listeFrais', 'voirFrais')->name('chemin_listeFrais');
});

Route::controller(gererFraisController::class)->group(function () {
    Route::get('/gererFrais', 'saisirFrais')->name('chemin_gestionFrais');
    Route::post('/sauvegarderFrais', 'sauvegarderFrais')->name('chemin_sauvegardeFrais');
});

Route::controller(validerFraisController::class)->group(function () {
    route::get('/validerFrais', 'validerF')->name('chemin_validerFrais');
    route::post('/afficherFiche', 'afficherFiche')->name('chemin_validerfiche');
    route::post('/ficheValider', 'validerLafiche')->name('chemin_valider');
    Route::get('/validerFrais/pdf', 'genererPdfFichesValidees')->name('pdf.fiches_validees');
    
});

