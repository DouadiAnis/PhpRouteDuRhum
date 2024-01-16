<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Erreur</title>
</head>
<body>

<?php
// Affichage du message d'erreur correspondant au code transmis dans l'URL
if (isset($_GET["code"])) {
    switch ($_GET["code"]) {
        case 1:
            echo "<h1>Erreur : aucun skipper n'a été sélectionné <a href='Skippers.php'>retour</a> </h1>";
            break;
        case 2:
            echo "<h1>Erreur : aucun bateau n'a été sélectionné  <a href='Bateaux.php'>retour</a> </h1>";
            break;
        case 3 :
            echo "<h1>Erreur : aucun resultat n'a été sélectionné <a href='Resultats.php'>retour</a> </h1>";
            break;
        case 5 :
            echo "<h1>Erreur lors de l'execution de la requete  <a href='Skippers.php'>retour</a> </h1>";
            break;
        case 6 :
            echo "<h1>Erreur lors de la connexion à la base de donnee <a href='Accueil.php'>retour</a> </h1>";
            break;
            // Ajoutez d'autres codes d'erreur et leurs messages ici
        default:
            echo "<h1>Une erreur inconnue est survenue</h1>";
            break;
    }
}
?>

</body>
</html>