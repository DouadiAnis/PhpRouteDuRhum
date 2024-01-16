<?php

include 'fonctions.php';

session_start();
$cnx = connexion();

/* quand l'utilisateur appuie sur modifier, on récupère l'id du skipper puis on ouvre une session pour le récupérer */
if (isset($_GET["modifier"]) && !empty($_GET["id"])) {
    $_SESSION["idets"] = $_GET["id"];
    header("location:updateSkipper.php");
    exit(); // Il est important de sortir du script après une redirection avec header()
}else{
    header("location: erreur.php?code=2");
}

// on récupère l'id déjà enregistré dans la session idets
$id = $_SESSION["idets"];
//$idd  = $_SESSION["idets"];
$requete = "SELECT * FROM p02_skipper WHERE skipper_id = '$id'";
$result = pg_query($cnx, $requete);

if ($result) {
    while ($ligne = pg_fetch_array($result)) {
        // récupérer chaque ligne du tableau et les enregistrer dans des sessions
        $_SESSION["skipper_nom"] = $ligne["skipper_nom"];
        $_SESSION["skipper_prenom"] = $ligne["skipper_prenom"];
        $_SESSION["skipper_age"] = $ligne["skipper_age"];
        $_SESSION["skipper_sexe"] = $ligne["skipper_sexe"];
        $_SESSION["skipper_nationnalite"] = $ligne["skipper_nationnalite"];
    }
}



/* si l'utilisateur appuie sur "supprimer " alors on supprime toutes les informations*/


if (isset($_GET["supprimer"])) {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $skip_id = $_GET["id"];
        deleteSkipper( $skip_id);
        header("location: Skippers.php");
        exit();
    } else {
        header("location: erreur.php?code=1");
    }
}


/* si l'utilisateur appuie sur "AJOUTER" on le redirige vers la page addSkipper */
if (isset($_GET["AJOUTER"])) {
    header("location:addSkipper.php");
    exit();
}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Projet PHP</title>
    <link rel="stylesheet" href="style2.css">

</head>
<body style="background:#C1CFC0" >

<div style="margin-left:15%;padding:1px 16px;height:100px;">

    <form method="post" action="updateSkipper.php">
        <table>
            <tr><td><H1> Modifier les Skippers </H1></td></tr>
            <?php

            echo "<tr><td> Nom  * :</td></tr><tr><td><input type='text' required='required' name='skipper_nom' value='" . $_SESSION["skipper_nom"] . "'  ></td></tr>";
            echo "<tr><td> Prenom  * :</td></tr><tr><td><input type='text' required='required' name='skipper_prenom' value='" . $_SESSION["skipper_prenom"] . "'  ></td></tr>";
            echo "<tr><td> La nationnalité *:</td></tr><tr><td><input type='text' required='required' name='skipper_nationnalite' value='" . $_SESSION["skipper_nationnalite"] . "' ></td></tr>";
            echo "<tr><td> Age* :</td></tr><tr><td><input type=number required='required' name=skipper_age min=2 max=100 value=".$_SESSION["skipper_age"]."  ></td></tr>";

            echo "<tr><td> Sexe* :</td></tr><tr><td> Homme <input type=radio name=skipper_sexe value=Homme " . ($_SESSION["skipper_sexe"] == "Homme" ? "checked" : "") . " /></td><td> Femme <input type=radio name=skipper_sexe value=Femme " . ($_SESSION["skipper_sexe"] == "Femme" ? "checked" : "") . " /></td></tr>";

            ?>

        </table>
        <input type="submit" value="MODIFIER" name="MODIFIER">

    </form>
    <?php

    $i=$_SESSION["idets"];

    if(isset($_POST["MODIFIER"]) && isset($_SESSION["idets"])){
        $skip_id = $_SESSION["idets"];
        if ($skip_id) { // Vérifier si un skipper a été sélectionné
            updateSkipper($i,$_POST["skipper_nom"],$_POST["skipper_prenom"],$_POST["skipper_age"],$_POST["skipper_sexe"], $_POST["skipper_nationnalite"]);
        } else { // Afficher un message d'erreur si aucun skipper n'a été sélectionné
            echo "Veuillez sélectionner un skipper à modifier.";
        }
    }







    ?>
</div>

</body>
</html>
