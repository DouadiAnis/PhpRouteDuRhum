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
        <h2>BATEAUX</h2>
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
    <h2 class="head1"> Liste des Bateaux</h2>
    <form method="get" action="updateBat.php"  >
        <input type="hidden" id="bateau_id" name="bateau_id" value="bateau_id">

        <?php

        echo"<table border='1'><th > </th><th ></th>";
        $requete2 = "SELECT * from p02_bateau ORDER BY bateau_id";
        $cnx = connexion();
        $ptrQuery2 = pg_query($cnx,$requete2);
        if ($ptrQuery2) {
            echo "<tr><th>SELECT</th> <th>BATEAU ID</th> <th>BATEAU NOM</th> <th>BATEAU DATE</th> <th>BATEAU ARCHITECTE</th> <th>BATEAU CLASSE</tr></th> ";

            while($ligne2 = pg_fetch_assoc($ptrQuery2 )) {
                $intg2 = $ligne2['bateau_id'];
                echo "<tr><td> <input type=radio name=id value= $intg2> </td><td>".$ligne2['bateau_id']." </td><td> ".$ligne2['bateau_nom']." </td><td> ".$ligne2['bateau_date']."</td><td>".$ligne2['bateau_architecte']." </td><td> ".$ligne2['bateau_classe']." </td><td> ";
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
