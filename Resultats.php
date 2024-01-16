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
        <h2> RESULTATS </h2>
        <ul class="menu">
            <li><a href='Accueil.php'>Accueil</a></li>
            <li><a href='Skippers.php'>Skippers</a></li>
            <li><a href="Bateaux.php">Bateaux</a></li>
            <li><a  href="Resultats.php">Resultats</a></li>
        </ul>

    </div>

</div>
<div class ="image">
</div>

<div style="margin-left:15%;padding:1px 16px;height:100px;">
    <h2 class="head1">Liste des Resultats</h2>
    <form method="get" action="updateRes.php" >
        <input type="hidden" id="skipper_id" name="bateau_nom" value="bateau_nom">

        <?php
        $cnx = connexion();
        echo"<table border='1'><th > </th><th ></th>";
        $requete3 = "SELECT * from p02_resultat ORDER BY resultat_jours, resultat_temps";
        $ptrQuery3= pg_query($cnx,$requete3);
        if ($ptrQuery3) {
            echo "<tr><th>SELECT</th> <th>SKIPPER ID</th> <th>BATEAU ID</th> <th>RESULTAT POSITION</th> <th>RESULTAT JOURS</th> <th>RESULTAT TEMPS</tr></th> ";
            while($ligne = pg_fetch_assoc($ptrQuery3)) {
                $intg = $ligne['skipper_id'];
                echo "<tr><td> <input type=radio name=id value= $intg> </td><td>".$ligne['skipper_id']." </td><td> ".$ligne['bateau_id']."</td><td>".$ligne['resultat_pos']." </td><td> ".$ligne['resultat_jours']." </td><td> ".$ligne['resultat_temps']." </td><td> ";
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
