<?php

namespace App\Http\Controllers;
use PdoGsb;
use MyDate;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class validerFraisController extends Controller{
    function validerF(){
        if( session('comptable')!= null){
            $comptable = session('comptable');

            //recuperer les utilisateur
            $lstUsers = PdoGsb::getLesUsers();
             $lescles = array_keys( $lstUsers);
            $usersSelectionner =  $lescles[0];
            

            //recuperer les mois 
            $lestMois = PdoGsb::getTousLesmois();
            $lesclesM = array_keys( $lestMois);
            $moisSelectionner =  $lesclesM[0];
           


            //dd($lstUsers);
           
           

        return view('validerFrais')
                                    ->with('comptable',$comptable)
                                    ->with('leUsers',$usersSelectionner)
                                    ->with('lstUsers',$lstUsers)

                                    ->with('leMois',$moisSelectionner)
                                    ->with('lstMois',$lestMois);

        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function afficherFiche(Request $request){
        if(session('comptable')!= null){
            
            //dd($request);
            $comptable = session('comptable');
            $leMois = $request['lstmois'];
            $leUsers = $request['lstUsers'];
            
            
            $lstMois = PdoGsb::getTousLesmois();
            $lstUsers = PdoGsb::getLesUsers();
            // $lescles = array_keys( $lstUsers);
            //$usersSelectionner =  $lescles[0];
            
           
            $numAnnee = MyDate::extraireAnnee( $leMois);
		    $numMois = MyDate::extraireMois( $leMois);

            $lesLibFrais = $request['lesLibFrais'];
            
            //recuperer la fiche du visiteur 
            $idVisiteur = $request['lstUsers'];
            //$visiteur = $lstUsers['nom'];
            
            $lesFraisForfait = PdoGsb::getLesFraisForfait($idVisiteur, $leMois);
        
        // etat et date de modif
        $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($idVisiteur, $leMois);
        
        // Vérifiez si $lesInfosFicheFrais est un tableau
        if (is_array($lesInfosFicheFrais)) {
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
        } else {
            // Gérer le cas où la récupération des infos échoue
            $libEtat = null;
            $dateModif = null;
            $montantValide = null;
            
        }

           $vue = view('ficheAvalider')
                                        ->with('leMois', $leMois)
                                        ->with('numAnnee',$numAnnee)
                                        ->with('leUsers', $leUsers)
                                        
                                        ->with('numMois', $numMois)
                                        ->with('lstUsers', $lstUsers)
                                        ->with('lstMois',$lstMois)
                                        ->with('comptable',$comptable)
                                        ->with('libEtat', $libEtat)
                                        ->with('dateModif', $dateModif)
                                        ->with('montantValide', $montantValide)
                                        ->with('lesFraisForfait', $lesFraisForfait)
                                        ->with('erreurs',null)
                                        ->with('message',"")
                                        ->with('lesLibFrais', $lesLibFrais)
                                        ->with ('method',$request->method());
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
                                    
        }

        
    }

    function validerLafiche(Request $request){
        if (session('comptable') != null){

           $comptable = session('comptable');
           $lesLibFrais = $request['lesLibFrais'];
           $lesFrais = $request['lesFrais'];
           $idVisiteur = $request['idVisiteur'];
           $leUsers = $request['idVisiteur'];
           $etat = "VA";
           $mois = $request['mois'];

           $lstMois = PdoGsb::getTousLesmois();
            $lstUsers = PdoGsb::getLesUsers();

            $numAnnee = MyDate::extraireAnnee( $mois);
		    $numMois = MyDate::extraireMois( $mois);

             // etat et date de modif
        $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($idVisiteur, $mois);

        $lesFraisForfait = PdoGsb::getLesFraisForfait($idVisiteur, $mois);
        
        // Vérifiez si $lesInfosFicheFrais est un tableau
        if (is_array($lesInfosFicheFrais)) {
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
        } else {
            // Gérer le cas où la récupération des infos échoue
            $libEtat = null;
            $dateModif = null;
            $montantValide = null;
            
        }

         


            $nbNumeric = 0;

            if(is_array($lesFrais)){
                foreach($lesFrais as $unFrais){
                    if(is_numeric($unFrais))
                        $nbNumeric++;
                }}
            


                    $vue =  view('ficheAvalider')->with('comptable', $comptable)
                                                ->with('leMois', $mois)
                                                ->with('numAnnee',$numAnnee)
                                                ->with('leUsers', $leUsers)
                                                
                                                ->with('numMois', $numMois)
                                                ->with('lstUsers', $lstUsers)
                                                ->with('lstMois',$lstMois)
                                                ->with('libEtat', $libEtat)
                                                ->with('dateModif', $dateModif)
                                                ->with('montantValide', $montantValide)
                                                ->with('lesFraisForfait', $lesFraisForfait)
                                                ->with('lesLibFrais', $lesLibFrais)
                                                ->with ('method',$request->method());


                if($nbNumeric == 4){
                    $message = "la fiche a été validée et mise à jour";
                    $erreurs = null;
                    
                    PdoGsb::majFraisForfait($idVisiteur,$mois,$lesFrais);
                    PdoGsb::majEtatFicheFrais($idVisiteur,$mois,$etat);
                }
            else{
                    $erreurs[] ="la fiche ne peut pas etres validée";
                    $message = '';
                }

            

           

            return $vue->with('erreurs',$erreurs)
                        ->with('message',$message);
            
        }
        else{
            return view('connexion')->with('erreurs',null);
                                    
        }

    }
    public function genererPdfFichesValidees() {
        // Vérifier si l'utilisateur est connecté en tant que comptable
        if (session('comptable') == null) {
            return redirect()->back()->with('error', 'Accès non autorisé');
        }
    
        // Récupérer la date du jour
        $today = date('Y-m-d');
    
        // Récupérer les fiches de frais validées aujourd'hui
        $fichesValidees = PdoGsb::getFichesValideesDuJour($today);
    
        // Générer un contenu texte
        $content = "Fiches de Frais Validées le $today\n\n";
        $content .= str_pad("ID Visiteur", 15) . 
                    str_pad("Nom", 20) . 
                    str_pad("Prénom", 20) . 
                    str_pad("Mois", 10) . 
                    str_pad("Montant Validé", 20) . 
                    "Date Validation\n";
        $content .= str_repeat("-", 100) . "\n";
    
        foreach ($fichesValidees as $fiche) {
            $content .= str_pad($fiche->idVisiteur, 15) . 
                        str_pad($fiche->nom, 20) . 
                        str_pad($fiche->prenom, 20) . 
                        str_pad($fiche->mois, 10) . 
                        str_pad($fiche->montantValide . ' €', 20) . 
                        $fiche->dateModif . "\n";
        }
    
        // Retourner un fichier texte comme un PDF
        return response($content)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="fiches_validees_' . $today . '.txt"');
    }
    
}
