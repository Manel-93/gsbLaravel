@extends ('modeles/visiteur')
    @section('menu')
            <!-- Division pour le sommaire -->
        <div id="menuGauche">
            <div id="infosUtil">
                  
             </div>  
               <ul id="menuList">
                   <li >
                    <strong>Bonjour {{ $comptable['nom'] . ' ' . $comptable['prenom'] }}<br> 
                    Vous avez le rôle de Comptable </strong>
                      
<!-- 
                  </li>
                  <li class="smenu">
                     <a href="{{ route('chemin_gestionFrais')}}" title="Saisie fiche de frais ">Saisie fiche de frais</a>
                  </li>
                  <li class="smenu">
                    <a href="{{ route('chemin_selectionMois') }}" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
                  </li>
-->
                  <li class="smenu">
                <a href="{{ route('chemin_validerFrais') }}" title="Valider les fiche de frais">Valider fiche frais</a>
                  </li> 
               <li class="smenu">
                <a href="{{ route('chemin_deconnexion') }}" title="Se déconnecter">Déconnexion</a>
                  </li>

                </ul>
               
        </div>
    @endsection          



    