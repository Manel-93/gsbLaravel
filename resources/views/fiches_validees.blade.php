<!DOCTYPE html>
<html>
<head>
    <title>Fiches de Frais Validées - {{ $today }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Fiches de Frais Validées le {{ $today }}</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID Visiteur</th>
                <th>Visiteur</th>
                <th>Mois</th>
                <th>Montant Validé</th>
                <th>Date Validation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fichesValidees as $fiche)
            <tr>
                <td>{{ $fiche->idVisiteur }}</td>
                <td>{{ $fiche->nom }} {{ $fiche->prenom }}</td>
                <td>{{ $fiche->mois }}</td>
                <td>{{ $fiche->montantValide }} €</td>
                <td>{{ $fiche->dateModif }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>