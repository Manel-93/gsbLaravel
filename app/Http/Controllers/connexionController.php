<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class connexionController extends Controller
{
    function connecter(){
        
        return view('connexion')->with('erreurs',null);
    } 
    
    function valider(Request $request){
        $login = $request['login'];
        $mdp = $request['mdp'];
        $visiteur = PdoGsb::getInfosVisiteur($login,$mdp);
        $comptable = PdoGsb::getInfosComptable($login,$mdp);

        
        if(is_array($comptable)){
            session(['comptable' => $comptable]);
            

            return view('NsommaireComptable')->with('comptable',session('comptable'));
        }
        else if (is_array($visiteur)){
            session(['visiteur' => $visiteur]);

            return view('sommaire')->with('visiteur',session('visiteur'));
        }
        else{
            $erreurs[] = "Login ou mot de passe incorrect(s)";
            return view('connexion')->with('erreurs',$erreurs);
        }
        
        
    } 
    function deconnecter(){
            session(['visiteur' => null]);
            session(['comptable' => null]);
            return redirect()->route('chemin_connexion');
    }
       
}
