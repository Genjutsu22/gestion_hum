<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DB;
use App\Models\personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class PosController extends Controller
{
    public function index(){
        $data = Session::get('key');
        if(!empty($data)){
            $id = $data[0]; 
            $table = FacadesDB::table('admins')
             ->select(FacadesDB::raw("'admin' as table_name"))
             ->where('id_personne', $id)
             ->orWhere(function($query) use ($id) {
                 $query->select(FacadesDB::raw("'employe' as table_name"))
                     ->where('id_personne', $id)
                     ->from('employes');
         })
                     ->orWhere(function($query) use ($id) {
                 $query->select(FacadesDB::raw("'candidat' as table_name"))
                    ->where('id_personne', $id)
                    ->from('candidats');
         })
               ->value('table_name');
                   return view('admin.home',[ "data" => $data, "type"=>$table]);
        }
       return redirect('login');
    }
    public function employesPage(){
        $data = FacadesDB::table('employes')
            ->join('personnes', 'employes.id_personne', '=', 'personnes.id_personne')
            ->join('adresses', 'personnes.id_adresse', '=', 'adresses.id_adresse')
            ->join('departements', 'employes.id_depart', '=', 'departements.id_depart')
            ->join('professions', 'employes.id_prof', '=', 'professions.id_prof')
            ->select('personnes.id_personne','personnes.nom', 'personnes.prenom', 'personnes.email', 'adresses.ville', 'adresses.quartier', 'departements.nom_depart', 'professions.nom_prof')
            ->get();
        return view('admin.employes',["data"=> $data]);
    }
    public function postsPage(){
        return view('admin.posts');
    }
    public function demandesPage(){
        return view('admin.demandes');
    }
    public function login(Request $request)
    { 
        $p= personne::where('email',$request->input('email'))->get();
        if($p->isNotEmpty() && ($p[0]->password == md5($request->input('password')) )){
             $request->session()->put('key',[$p[0]->id_personne,$p[0]->nom,$p[0]->prenom,$p[0]->cin]);
             return redirect('/');
        }else{
            return redirect('/login')->with('error', 'The email or password you entered is incorrect.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
