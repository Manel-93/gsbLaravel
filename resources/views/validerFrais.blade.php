@extends ('NsommaireComptable')
    @section('contenu1')
      <div id="contenu">
        <h2>valider fiche frais </h2>
        <h3>selectionner utilisateur: </h3>
      <form action="{{ route('chemin_validerfiche') }}" method="post">
        {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm"><p>
          <label for="lstUsers" >Utilisateur : </label>
          
          <select id="lstUsers" name="lstUsers">
                @foreach($lstUsers as $users)
                    @if($users['id'] == $leUsers)
                    <option selected value="{{ $users['id'] }}">
                        {{ $users['nom'] }} {{ $users['prenom']}}
                    </option>
                    @else
                    <option value="{{ $users['id'] }}">
                        {{ $users['nom'] }} {{ $users['prenom']}}
                    </option>
                    @endif
                @endforeach
          </select>
          <select name="lstmois" id="lstmois">
          @foreach($lstMois as $mois)
                    @if($mois['mois'] == $leMois)
                    <option selected value="{{ $mois['numAnnee'].$mois['numMois']  }}">
                        {{ $mois['numMois'] }} {{ $mois['numAnnee'] }}
                    </option>
                    @else
                    <option value="{{ $mois['numAnnee'].$mois['numMois'] }}">
                        {{ $mois['numMois'] }} {{ $mois['numAnnee']}}
                    </option>
                    @endif
                @endforeach          </select>
        </p>
        </div>
        <div class="piedForm">
        <p>
          <input id="ok" type="submit" value="selectionner" size="20" />
          
        </p> 
        </div>
          
        </form>
  @endsection 
 