<?php

namespace App\Http\Controllers;

use App\Models\adresse;
use App\Models\conge;
use App\Models\demande_emploi;
use App\Models\departement;
use App\Models\employe;
use App\Models\offre_emploi;
use App\Models\personne;
use App\Models\profession;
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
        $data = FacadesDB::table('personnes')
            ->join('employes', 'personnes.id_personne', '=', 'employes.id_personne')
            ->join('adresses', 'personnes.id_adresse', '=', 'adresses.id_adresse')
            ->join('departements', 'employes.id_depart', '=', 'departements.id_depart')
            ->join('professions', 'employes.id_prof', '=', 'professions.id_prof')
            ->get();
            $departs = FacadesDB::table('departements')->get();
            $profs = FacadesDB::table('professions')->get();
            $villes = FacadesDB::table('adresses')->get();
   
        return view('admin.employes',["data"=> $data,"departs"=>$departs,"profs"=>$profs,"villes"=>$villes]);
        
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
    public function destroy($id_personne)
{
    try {
    $personne = personne::findOrFail($id_personne);
    $personne->delete();
    session()->flash('success', 'Le record a été supprimé avec succès!');
    return redirect()->back();

    } catch (\Throwable $th) {
        session()->flash('error', 'Error !');
        return redirect()->back();
    }
    
}
public function update(Request $request)
{
     try {
        $personne = personne::find($request->input('idpersonne'));
        $employe = employe::find($request->input('idemploye'));
        $personne->nom = $request->input('firstName');
        $personne->cin = $request->input('cin');
        $personne->prenom = $request->input('lastName');
        $personne->email = $request->input('emailAddress');
        $personne->id_adresse = $request->input('ville_id');
        $employe->id_depart =  $request->input('depart_id');
        $employe->id_prof = $request->input('prof_id');
    
        $personne->save();
        $employe->save();
        return back()->with('success', 'Les modifactions a été enrgistrés !');
  } catch (\Throwable $th) {
        return back()->with('error', ' Error ! ');
  }
    
}
public function conge_details($idemploye){
    try{
        $conges = Conge::where('id_employe', $idemploye)
               ->whereNull('etat')
               ->get();
        $employe = FacadesDB::table('personnes')
        ->join('employes', 'personnes.id_personne', '=', 'employes.id_personne')->where('id_employe',$idemploye)->get();
        return view('admin.conges', ['conges' => $conges,'employe'=>$employe]);
    } catch (\Throwable $th) {
        return back()->with('error', 'Error!');
    }
}
public function conge_accept($id_conge){
    try{
        $conge = conge::find($id_conge);
        $conge->etat = '1';
        $conge->save();
        return back()->with('success', "Congé est accepté !");
    }catch (\Throwable $th) {
        return back()->with('error', 'Error!');
    }
}
public function conge_refuse(request $request){
    try{
        $conge = conge::find($request->input('idconge'));
        $conge->etat = '0';
        $conge->justif = $request->input('justif');
        $conge->save();
        return back()->with('success', "Congé est refusé !");
    }catch (\Throwable $th) {
        return back()->with('error', 'Error!');
    }
}
public function ajouter_employe(request $request){
 try {
    $personneId = FacadesDB::table('personnes')->insertGetId([
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'email' => $request->input('email'),
        'password' => md5($request->input('motdepasse')),
        'id_adresse' => $request->input('ville_id'),
        'cin'=>$request->input('cin'),
    ]);
    FacadesDB::table('employes')->insert([
        'id_personne' => $personneId,
        'id_prof' => $request->input('prof_id'),
        'id_depart' => $request->input('depart_id'),
        'num_bureau' => $request->input('bureau'),
    ]);
    return back()->with('success', "L'employé a été ajouté !");
 } catch (\Throwable $th) {
    return back()->with('error', 'Error!');
}
}
public function departement_add(Request $request){
    try{
        departement::create([
            'nom_depart' => $request->input('nomdepart'),
        ]);
        return back()->with('success', "Département ajouté !");
    }catch (\Throwable $th) {
        return back()->with('error', 'Error!');
    }
}
public function delete_prof($id_prof){
    try {
        $profession = profession::findOrFail($id_prof);
        $profession->delete();
        session()->flash('success', 'Le record a été supprimé avec succès!');
        return redirect()->back();
    
        } catch (\Throwable $th) {
            session()->flash('error', 'Error !');
            return redirect()->back();
        }
        
}
public function profession_add(Request $request){
    try{
        profession::create([
            'nom_prof' => $request->input('nomprofession'),
        ]);
        return back()->with('success', "Profession ajouté !");
    }catch (\Throwable $th) {
        return back()->with('error', 'Error!');
    }
}
public function update_prof(Request $request){
    try{
    $departement = departement::find($request->input('iddepart'));
    $profession = profession::find($request->input('idprof'));
    $departement->nom_depart = $request->input('nomdepart');
    $profession->nom_prof = $request->input('nomprof');
    $profession->save();
    $departement->save();
    return back()->with('success', "Les informations modifiés !");
}catch (\Throwable $th) {
    return back()->with('error', 'Error!');
}

}
public function postsPage(){
    $result = FacadesDB::table('professions')
    ->leftJoin('employes', 'professions.id_prof', '=', 'employes.id_prof')
    ->leftJoin('departements', 'employes.id_depart', '=', 'departements.id_depart')
    ->leftJoin('personnes', 'employes.id_personne', '=', 'personnes.id_personne')
    ->groupBy('departements.nom_depart','professions.nom_prof','departements.id_depart','professions.id_prof')
    ->select('departements.nom_depart', 'professions.nom_prof', 
      FacadesDB::raw('count(employes.id_depart) as num_employees'),'departements.id_depart','professions.id_prof')
      ->whereNotNull('departements.nom_depart')
      ->whereNotNull('professions.nom_prof')
    ->get();
   
    return view('admin.posts',["employes"=> $result]); 
    
} 
public function demandesPage(){
     $offres = FacadesDB::table('offre_emplois')
     ->join('professions','professions.id_prof','=','offre_emplois.id_prof')
     ->join('departements','departements.id_depart','=','offre_emplois.id_depart')
     ->get();
     $departs = FacadesDB::table('departements')->get();
     $profs = FacadesDB::table('professions')->get();
     $villes = adresse::all();
     return view('admin.demandes',["offres"=>$offres,"departs"=>$departs,"profs"=>$profs,"villes"=>$villes]);
}

public function add_offre(Request $request)
{
    try {
        $file = $request->file('chooseFile');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        offre_emploi::create([
            'id_prof' => $request->input('idprof'),
            'id_depart' => $request->input('iddepart'),
            'detail' => $filename,
        ]);
        return back()->with('success', "Offres ajouté !");
   } catch (\Throwable $th) {
        return back()->with('error', 'Error!');
    }
}

public function download_offre($file){
    return response()->download(public_path('uploads/'.$file));
}

public function delete_offre($id_offre){
    try {
        $offre = offre_emploi::findOrFail($id_offre);
        $offre->delete();
        session()->flash('success', 'Le record a été supprimé avec succès!');
        return redirect()->back();
    
        } catch (\Throwable $th) {
            session()->flash('error', 'Error !');
            return redirect()->back();
        }
        
}
public function offres_details($id_offre){ 
    $demandes = demande_emploi::where('demande_emplois.id_offre', $id_offre)
    ->join('offre_emplois', 'offre_emplois.id_offre', '=', 'demande_emplois.id_offre')
    ->join('departements', 'departements.id_depart', '=', 'offre_emplois.id_depart')
    ->join('professions', 'professions.id_prof', '=', 'offre_emplois.id_prof')
    ->join('candidats', 'candidats.id_candidat', '=', 'demande_emplois.id_candidat')
    ->join('personnes', 'personnes.id_personne', '=', 'candidats.id_personne')
    ->join('adresses', 'personnes.id_adresse', '=', 'adresses.id_adresse')
    ->whereNull('termine')
    ->whereNull('accepted')
    ->get();
    $offres = offre_emploi::where('id_offre', $id_offre)
    ->join('departements','departements.id_depart','=','offre_emplois.id_depart')
    ->join('professions','professions.id_prof','=','offre_emplois.id_prof')
    ->whereNull('termine')
    ->get();
    return view('admin.candidature',["offres"=>$offres,"demandes"=>$demandes]);
}
public function accepter_offre(request $request, $id_candidat){
   try {
  demande_emploi::where('id_candidat', $id_candidat)
    ->where('id_offre', $request->input('idoffre'))
    ->update(['accepted' => 1]);
   
        session()->flash('success', 'Le candidat a été accepté !');
        return redirect()->back();

    } catch (\Throwable $th) {
        session()->flash('error', 'Error !');
        return redirect()->back();
  }
}
public function refuse_offre(request $request, $id_candidat){
    try {
     demande_emploi::where('id_candidat', $id_candidat)
     ->where('id_offre', $request->input('idoffre'))
     ->update(['accepted' => 0]);
    
         session()->flash('success', 'Le candidat a été refusé !');
         return redirect()->back();
     } catch (\Throwable $th) {
         session()->flash('error', 'Error !');
         return redirect()->back();
   }
 }
 public function ajouter_candidat(request $request){
    try {
        $fileCV = $request->file('CV');
        $filenameCV = time() . '.' . $fileCV->getClientOriginalExtension();
        $fileCV->move(public_path('uploads'), $filenameCV);

        $fileLMV = $request->file('LMV');
        $filenameLMV = time() . '.' . $fileLMV->getClientOriginalExtension();
        $fileLMV->move(public_path('uploads'), $filenameLMV);
       $personneId = FacadesDB::table('personnes')->insertGetId([
           'nom' => $request->input('nom'),
           'prenom' => $request->input('prenom'),
           'email' => $request->input('email'),
           'password' => md5($request->input('motdepasse')),
           'id_adresse' => $request->input('ville_id'),
           'cin'=>$request->input('cin'),
       ]);
       FacadesDB::table('candidats')->insert([
           'id_personne' => $personneId,
           'cv' => $filenameLMV,
           'motivation' => $filenameCV,
       ]);
       return back()->with('success', "Le candidat a été ajouté !");
    } catch (\Throwable $th) {
       return back()->with('error', 'Error!');
   }
   }
   public function change_password($id) {
    $pers = personne::where('id_personne', $id)->first();
    return view('change_pass', ["pers" => $pers]);
}
}  
