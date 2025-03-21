@extends ('validerFrais')
@section('contenu2')

<h3>Fiche de frais du mois {{ $numMois }}-{{ $numAnnee }} : 
    </h3>

    <form method="post"  action="{{ route('chemin_valider') }}">
                    {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm">
            <fieldset>
                <legend>Eléments forfaitisés</legend>

                @includeWhen($erreurs != null, 'msgerreurs', ['erreurs' => $erreurs]) 
                @includeWhen($message != "", 'message', ['message' => $message])


                <input type = "hidden" name  = "idVisiteur" value = "{{ $leUsers}}">
                <input type="hidden" name = "mois" value = "{{$leMois}}">
                
                @foreach ($lesFraisForfait as $key => $frais)
                
                    <p>
                        <input type = "hidden" name = "lesLibFrais[]"
                               
                                @if($method  == 'POST')
                                    value = "{{$frais['libelle']}}"
                                @else
                                    value ="{{$lesLibFrais[$loop->index]}}"
                                @endif>
                        
                        <label name = "libelle" for="idFrais">
                                    @if($method  == 'POST')
                                        {{$frais['libelle']}}
                                    @else
                                        {{$lesLibFrais[$loop->index]}}
                                    @endif
                        </label>
                        <input type="text" required
                                    @if($method  == 'POST')
                                        name = "lesFrais[{{$frais['idfrais']}}]"
                                        value = "{{$frais['quantite']}}"
                                    @else
                                        name = "lesFrais[{{$key}}]"
                                        value = "{{$frais}}"
                                    @endif>

                              
                    </p>
                @endforeach
            </fieldset>
        </div>
        <p>
                Etat : <strong>{{ $libEtat }} depuis le {{ $dateModif }} </strong>
         <br> Montant validé : <strong>{{ $montantValide }} </strong>
     </p>
        <div class="piedForm">
            <p>
            <input id="ok" type="submit" value="Valider" size="20" />
            

                    {{-- Nouveau bouton pour générer le PDF --}}
                <a href="{{ route('pdf.fiches_validees') }}" class="btn btn-primary">
                    Générer PDF des Fiches Validées
                </a>
            </p> 
        </div>

     
    </form>
    <!--
    <div class="encadre">
    <p>
    Etat : <strong>{{ $libEtat }} depuis le {{ $dateModif }} </strong>
         <br> Montant validé : <strong>{{ $montantValide }} </strong>
     </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
            @foreach($lesFraisForfait as $unFraisForfait)
			    <th> {{$unFraisForfait['libelle']}} </th>
            @endforeach
		</tr>
        <tr>
            @foreach($lesFraisForfait as $unFraisForfait)
                <td class="qteForfait">{{ $unFraisForfait['quantite'] }} 
                </td>
            @endforeach
		</tr>
    </table>
    
  	</div> -->
@endsection