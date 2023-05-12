<?php


use App\Http\Controllers\PosController;
use Illuminate\Auth\Events\Login;
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
Route::group(['middleware'=>"web"],function(){
    Route::get('/', [PosController::class, 'index']);
    Route::view('login','login_page');
    Route::get('/demandes', [PosController::class, 'demandesPage']);
    Route::get('/posts', [PosController::class, 'postsPage']);
    Route::get('/employes', [PosController::class, 'employesPage']);
    Route::post('login', [PosController::class, 'login'])->name('login');
    Route::post('logout', [PosController::class, 'logout'])->name('logout');
    Route::delete('/delete_personne/{id}', [PosController::class, 'destroy'])->name('destroy');
    Route::post('/personne/update', [PosController::class, 'update'])->name('personne.update');
    Route::get('/conge_details/{id}', [PosController::class, 'conge_details'])->name('conge_details');
    Route::post('/conge_accept/{id}', [PosController::class, 'conge_accept'])->name('conge_accept');
    Route::post('/conge_refuse', [PosController::class, 'conge_refuse'])->name('conge_refuse');
    Route::post('/ajouter_employe', [PosController::class, 'ajouter_employe'])->name('ajouter_employe');
    Route::post('/profession_add', [PosController::class, 'profession_add'])->name('profession_add');
    Route::post('/departement_add', [PosController::class, 'departement_add'])->name('departement_add');
    Route::post('/update_prof', [PosController::class, 'update_prof'])->name('update_prof');
    Route::delete('/delete_prof/{id}', [PosController::class, 'delete_prof'])->name('delete_prof');
    Route::post('/add_offre', [PosController::class, 'add_offre'])->name('upload.file');
    Route::delete('/delete_offre/{id}', [PosController::class, 'delete_offre'])->name('delete_offre');
    Route::get('/download_offre/{offre}', [PosController::class, 'download_offre'])->name('download_offre');
    Route::get('/offres_details/{id}', [PosController::class, 'offres_details'])->name('offres_details');
    Route::post('/accepter_offre/{id}', [PosController::class, 'accepter_offre'])->name('accepter_offre');
    Route::post('/refuse_offre/{id}', [PosController::class, 'refuse_offre'])->name('refuse_offre');
    Route::post('/ajouter_candidat', [PosController::class, 'ajouter_candidat'])->name('ajouter_candidat');
    Route::get('/change_password/{id}', [PosController::class, 'change_password'])->name('change_password');
    Route::post('/passchange', [PosController::class, 'passchange'])->name('passchange');
    Route::get('/mes_demandes', [PosController::class, 'mes_demandes'])->name('mes_demandes');
    Route::get('/demande_page', [PosController::class, 'demande_page'])->name('demande_page');
    Route::post('/demande_conge', [PosController::class, 'demande_conge'])->name('demande_conge');
    Route::get('/info_candidat', [PosController::class, 'info_candidat'])->name('info_candidat');
    Route::post('/edit_candidat', [PosController::class, 'edit_candidat'])->name('edit_candidat');
    Route::post('/offres_inactive/{id}', [PosController::class, 'offres_inactive'])->name('offres_inactive');
    Route::get('/offres_candid', [PosController::class, 'offres_candid'])->name('offres_candid');
    Route::post('/demande_emploi/{id}', [PosController::class, 'demande_emploi'])->name('demande_emploi');
    Route::get('/mes_demandes_candid', [PosController::class, 'mes_demandes_candid'])->name('mes_demandes_candid');
    
    
});
Route::fallback(function () {
    return view('errors.error404');
});

