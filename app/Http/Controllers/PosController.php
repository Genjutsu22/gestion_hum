<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\adresse;
use App\Models\candidat;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
class PosController extends Controller
{
    public function check_user($id){  
        $adminTable = FacadesDB::table('admins')
            ->select(FacadesDB::raw("'admin' as table_name"))
            ->where('id_personne', $id)
            ->value('table_name');
        
        $employeTable = FacadesDB::table('employes')
            ->select(FacadesDB::raw("'employe' as table_name"))
            ->where('id_personne', $id)
            ->value('table_name');
        
        $candidatTable = FacadesDB::table('candidats')
            ->select(FacadesDB::raw("'candidat' as table_name"))
            ->where('id_personne', $id)
            ->value('table_name');
        
        if ($adminTable) {
            return $adminTable;
        } elseif ($employeTable) {
            return $employeTable;
        } elseif ($candidatTable) {
           return $candidatTable;
        }
        return null;
    }
    public function index(){
        
        $data = Session::get('key');
        if(!empty($data)){
            $id = $data[0];
            $employeId = FacadesDB::table('employes')
             ->where('id_personne', $id)
             ->value('id_employe');
             $candidatID = FacadesDB::table('candidats')
             ->where('id_personne', $id)
             ->value('id_candidat');
             if($employeId){
                Session::put('id',$employeId);
             }elseif($candidatID){
                Session::put('id',$candidatID);
             }
           
           $table = $this->check_user($id);
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
         if(!empty($request->input('email'))){
            $p= personne::where('email',$request->input('email'))->get();
            if($p->isNotEmpty() && ($p[0]->password == md5($request->input('password')) )){
                 $request->session()->put('key',[$p[0]->id_personne,$p[0]->nom,$p[0]->prenom,$p[0]->cin]);
                 return redirect('/');
            }else{
                return redirect('/login')->with('error', 'The email or password you entered is incorrect.');
            }
         }
         if (!empty($request->input('semail'))) {
           try {
            $email = $request->input('semail');

            // Check if the email exists in the personnes table
            $personne = FacadesDB::table('personnes')->where('email', $email)->first();
            
            if ($personne) {
                // Generate a 5-digit OTP
                $otp = mt_rand(10000, 99999);
            
                // Set the expiration date 1 minute from now
                $expiryDate = now()->addMinute();
            
                // Save the OTP and expiration date in the personnes table
                FacadesDB::table('personnes')->where('email', $email)->update(['otp' => $otp, 'otp_expiry' => $expiryDate]);
            
                // Send the OTP to the user's email
                Mail::to($email)->send(new ForgotPasswordMail($otp));
            
                // Store the email in the session
                session(['email' => $email]);
            
                return view('forgetpass');
            } else {
                return redirect('/login')->with('error', "Email introuvable !");// Return a message indicating the email was not found
            }
         } catch (\Throwable $th) {
                return redirect('/login')->with('error', "Erreur !");
            }
        }elseif($request->input('nvpass') && $request->input('conpass')){
            $email = Session::get('email');
           if($request->input('nvpass')==$request->input('conpass')){
            FacadesDB::table('personnes')
            ->where('email', $email)
            ->update(['password'=>md5($request->input('nvpass'))]);
            return back()->with("success","mot de passe est modifiés !");
           }
            else{
                return view('changepass');
            }
        }
         else{
            $email = Session::get('email');
            $personne = Personne::where('email', $email)->first();
            $storedOtp = $personne->OTP;
            $generatedDate = $personne->OTP_expiry;
            $otp = $request->input('digit1') . $request->input('digit2') . $request->input('digit3') . $request->input('digit4') . $request->input('digit5');
            if ($otp == $storedOtp && $generatedDate && $generatedDate->gt(now()->subMinute())) {
                return view('changepass');
            } else {
                return view('forgetpass')->with('error', "Erreur !");
            }
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
        $conge->date_accept= now();
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
     ->where('termine','=','0')
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
            'type_emploi' => $request->input('typemploi'),
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
    ->where('termine','=','0')
    ->whereNull('accepted')
    ->get();
    $offres = offre_emploi::where('id_offre', $id_offre)
    ->join('departements','departements.id_depart','=','offre_emplois.id_depart')
    ->join('professions','professions.id_prof','=','offre_emplois.id_prof')
    ->where('termine','=','0')
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
    $table = $this->check_user($id);
    return view('change_pass', ["pers" => $pers,"type"=>$table]);
   }
   public function passchange(Request $request) {
    $p = personne::where('id_personne', $request->input('idemploye'))->get();
    if ($request->input('nvpass') == $request->input('conpass')) {
        if ($p->count() > 0 && ($p->first()->password == md5($request->input('oldpass')))) {
            $p->first()->password = md5($request->input('nvpass'));
            $p->first()->save();
            return back()->with('success', 'Mot de passe changé avec succès !');
        } else {
            return back()->with('error', 'Ancien mot de passe incorrect !');
        }
    }
    return back()->with('error', 'La confirmation du mot de passe est incorrecte !');
}
  public function mes_demandes(){
    $id = Session::get('id');
    $conges = conge::where('id_employe',$id)->get();
    return view('employes.mes_demandes',["conges"=>$conges,"id"=>$id]);
  }
  public function demande_page(){
    $id = Session::get('id');
    return view('employes.demande_conge',["id"=>$id]);
  }
  public function demande_conge(Request $request){
   try {
        $fileCM = $request->file('CM');
        $filenameCM = time() . '.' . $fileCM->getClientOriginalExtension();
        $fileCM->move(public_path('uploads'), $filenameCM);
 
          FacadesDB::table('conges')->insert([
            'id_employe' => $request->input('id_employe'),
           'date_debut' => $request->input('datedebut'),
           'date_fin' => $request->input('datefin'),
           'certificat_medical' =>  $filenameCM,
           'type_conge' => $request->input('type'),
       ]);
       return back()->with('success', "Le demande a été enregistré !");
   } catch (\Throwable $th) {
       return back()->with('error', 'Error!');
  }
  }
  public function info_candidat(){
    $id = Session::get('id');

    $candidat = candidat::where('id_candidat', $id)
        ->join('personnes', 'personnes.id_personne', '=', 'candidats.id_personne')
        ->join('adresses', 'adresses.id_adresse', '=', 'personnes.id_adresse')
        ->get();
        $candidat = $candidat->first();
        $ville = adresse::all();
    return view('candidat.info_page', [
        "candidat" => $candidat,
        "id" => $id,
        "villes"=>$ville
    ]);
  }
  public function edit_candidat(Request $request){
   try {
    $fileCV = $request->file('CV');
    $fileLMV = $request->file('LMV');
    if(!empty($fileCV) ){
        $filenameCV = time() . '.' . $fileCV->getClientOriginalExtension();
        $fileCV->move(public_path('uploads'), $filenameCV);
        $candidat = candidat::find($request->input('idcandidat'));   
        $candidat->cv = $filenameCV;
        $candidat->save();
      }
      if( !empty($fileLMV)){
     
        $filenameLMV = time() . '.' . $fileLMV->getClientOriginalExtension();
        $fileLMV->move(public_path('uploads'), $filenameLMV);
        $candidat = candidat::find($request->input('idcandidat'));   
        $candidat->motivation = $filenameLMV;
        $candidat->save();
      }
       
       $personne = Personne::find($request->input('idpersonne'));
       $personne->nom = $request->input('nom');
       $personne->prenom = $request->input('prenom');
       $personne->email = $request->input('email');
       $personne->id_adresse = $request->input('ville_id');
       $personne->cin=$request->input('cin');
       $personne->save();
       return back()->with('success', "Les donnés sont modifiées !");
   } catch (\Throwable $th) {
       return back()->with('error', 'Error!');
  }
} 
public function offres_inactive($id){
    try {
        $offre = offre_emploi::find($id);
        $offre->termine = '1';
        $offre->save();
       return back()->with('success', "L'offre a été désactivé !");
   } catch (\Throwable $th) {
       return back()->with('error', 'Error!');
  }
}
public function offres_candid(){
 $id = Session::get('id');
 $offres = FacadesDB::table('offre_emplois')
 ->join('departements', 'departements.id_depart', '=', 'offre_emplois.id_depart')
 ->join('professions', 'professions.id_prof', '=', 'offre_emplois.id_prof')
 ->where('termine', '=', '0')
 ->whereNotExists(function ($query) use ($id) {
     $query->select(FacadesDB::raw(1))
         ->from('demande_emplois')
         ->whereRaw('demande_emplois.id_offre = offre_emplois.id_offre')
         ->where('demande_emplois.id_candidat', '=', $id);
 })
 ->get();
 return view('candidat.offres',["offres"=>$offres,"id"=>$id]);

}
public function demande_emploi(Request $request,$id){
    try {
       FacadesDB::table('demande_emplois')->insert([
           'id_candidat' => $request->input('id_candidat'),
           'id_offre' => $id,
       ]);
       return back()->with('success', "La demande a été enregistré !");
   } catch (\Throwable $th) {
       return back()->with('error', 'Error!');
   } 
}
public function mes_demandes_candid(){
    $id = Session::get('id');
$offres = FacadesDB::table('candidats')
    ->where('candidats.id_candidat', '=', $id)
    ->join('demande_emplois', 'demande_emplois.id_candidat', '=', 'candidats.id_candidat')
    ->join('offre_emplois', 'offre_emplois.id_offre', '=', 'demande_emplois.id_offre')
    ->join('departements', 'departements.id_depart', '=', 'offre_emplois.id_depart')
    ->join('professions', 'professions.id_prof', '=', 'offre_emplois.id_prof')
    ->get();
return view('candidat.demandes', ["offres" => $offres]);  
}
public function apropos(){
    
    return view('apropos');
}


} 
