<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;

use Illuminate\Support\Facades\Route;



Route::get('/', [ClientController::class,'home'])->name('home');
Route::get('/shop', [ClientController::class,'shop'])->name('shop');
Route::get('/panier', [ClientController::class,'panier'])->name('panier');
Route::get('/login', [ClientController::class,'client_login'])->name('login');
Route::get('/signup', [ClientController::class,'signup'])->name('signup');
Route::get('/paiement', [ClientController::class,'paiement']);
Route::get('/select_par_cat/{name}', [ClientController::class,'select_par_cat']);
Route::get('/ajouter_au_panier/{id}', [ClientController::class,'ajouter_au_panier']);
Route::post('/modify_qty/{id}', [ClientController::class,'modifier_panier']);
Route::get('/retirer_produit/{id}', [ClientController::class,'retirer_produit']);
Route::post('/creer_compte', [ClientController::class,'creer_compte']);
Route::post('/acceder_compte', [ClientController::class,'acceder_compte']);
Route::get('/logout', [ClientController::class,'logout']);

Route::get('/admin',[AdminController::class,'dashboard']);
Route::get('/commandes',[AdminController::class,'commandes']);


Route::get('/ajoutercategorie',[CategoryController::class,'ajoutercategorie']);
Route::post('/sauvercategorie',[CategoryController::class,'sauvercategorie'])->name('sauver_categorie');
Route::get('/categories',[CategoryController::class,'categories']);
Route::get('/edit_categorie/{id}',[CategoryController::class,'edit_categorie']);
Route::post('/modifiercategorie',[CategoryController::class,'modifiercategorie'])->name('editCategorie');
Route::get('delete_categorie/{id}',[CategoryController::class,'delete_categorie']);


Route::get('/ajouterproduit',[ProductController::class,'ajouterproduit']);
Route::post('/sauverproduit',[ProductController::class,'sauverproduit'])->name('sauver_produit');
Route::get('/produits',[ProductController::class,'produits']);
Route::get('/edit_produit/{id}',[ProductController::class,'edit_produit']);
Route::post('/modifierproduit',[ProductController::class,'modifierproduit'])->name('editProduit');
Route::get('delete_produit/{id}',[ProductController::class,'delete_produit']);
Route::get('activer_produit/{id}',[ProductController::class,'activer_produit']);
Route::get('desactiver_produit/{id}',[ProductController::class,'desactiver_produit']);

Route::get('/ajouterslider',[SliderController::class,'ajouterslider']);
Route::post('/sauverslider',[SliderController::class,'sauverslider'])->name('sauver_slider');
Route::get('/sliders',[SliderController::class,'sliders']);
Route::get('/edit_slider/{id}',[SliderController::class,'edit_slider']);
Route::post('/modifierslider',[SliderController::class,'modifierslider'])->name('editSlider');
Route::get('delete_slider/{id}',[SliderController::class,'delete_slider']);
Route::get('activer_slider/{id}',[SliderController::class,'activer_slider']);
Route::get('desactiver_slider/{id}',[SliderController::class,'desactiver_slider']);


 
