<?php

include 'fonctions.php';
session_start();
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Projet PHP</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="wrapper">
    <div class="accueil">
        <h2> SKIPPER </h2>
        <ul class="menu">
            <li><a href='Accueil.php'>Accueil</a></li>
            <li><a href='Skippers.php'>Skippers</a></li>
            <li><a href="Bateaux.php">Bateaux</a></li>
            <li><a  href="Resultats.php">Resultats</a></li>
        </ul>
    </div>
    <div class ="image">
    </div>


</div>

<div style="margin-left:15%;padding:1px 16px;height:100px;">
    <h2 class="head1"> Liste des Skippers </h2></td><td>
        <form method="get" action="updateSkipper.php"  >
            <input type="hidden" id="skipper_id" name="skipper_id" value="skipper_id">

            <?php
            $cnx = connexion();
            echo"<table border='1'><th > </th><th ></th>";
            $requete = "SELECT * from p02_skipper ORDER BY skipper_id";
            $ptrQuery = pg_query($cnx,$requete);
            if ($ptrQuery) {
                echo "<tr><th>SELECT</th> <th>SKIPPER ID</th> <th>SKIPPER NOM</th> <th>SKIPPER PRENOM</th> <th>SKIPPER AGE</th> <th>SKIPPER SEXE</th>  <th>SKIPPER Nationalite</tr></th> ";

                while($ligne = pg_fetch_assoc($ptrQuery )) {
                    $intg = $ligne['skipper_id'];
                    echo "<tr><td> <input type=radio name=id value= $intg> </td><td>".$ligne['skipper_id']." </td><td> ".$ligne['skipper_nom']."</td><td>".$ligne['skipper_prenom']." </td><td> ".$ligne['skipper_age']." ans"." </td><td> ".$ligne['skipper_sexe']." </td><td> ".$ligne['skipper_nationnalite']."</td><td> ".$ligne['bateau_nom']." </td></tr>";
                }
                echo "</table><input  type =submit name=AJOUTER value= AJOUTER> ";
                echo "</table><input  type =submit name=modifier value= MODIFIER> ";
            }

            ?>
            <input name="supprimer" type="submit" value="SUPPRIMER" />
        </form>





</div>
</body>
</html>
