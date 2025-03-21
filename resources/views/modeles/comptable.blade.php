<!DOCTYPE html>
<html>
<head>
    <title>Comptable Dashboard</title>
    <!-- Add your CSS and other head elements -->
</head>
<body>
    <div id="menuGauche">
        <div id="infosUtil">
            <strong>Bonjour {{ $comptable['nom'] . ' ' . $comptable['prenom'] }}</strong>
        </div>
        <ul id="menuList">
            <li class="smenu">
                <a href="{{ route('chemin_validerFrais') }}" title="Valider les fiche de frais">Valider fiche frais</a>
            </li>
            <li class="smenu">
                <a href="{{ route('chemin_deconnexion') }}" title="Se déconnecter">Déconnexion</a>
            </li>
        </ul>
    </div>

    @yield('contenu1')
</body>
</html>