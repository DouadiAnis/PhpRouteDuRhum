<?php

include 'fonctions.php';

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Projet PHP</title>
    <link rel="stylesheet" href="style2.css">

</head>
<body style="background:#C1CFC0" >

<nav>
    <a href="#" class="logo"> Projet PHP </a>
    <div class="nav-links">
        <ul>
            <li><a href="Accueil.php"> Accueil</a></li>
            <li><a href="Bateaux.php"> Bateaux</a></li>
            <li><a href="Skippers.php"> Skippers</a></li>
            <li><a href="Resultats.php">Resultats</a></li>
        </ul>
    </div>



</nav>

<div style="margin-left:15%;padding:1px 16px;height:100px;">

    <form method="get"  action="addRes.php">
        <table>
            <tr><td> <h1> Ajouter un Resultat </h1></td></tr>


            <tr>
                <td> Skipper id * :</td>
                <td>
                    <select name="skipper_id">
                        <?php
                        $cnx = connexion();
                      //  $sql = "SELECT s.skipper_id, b.bateau_id FROM P02_skipper s LEFT JOIN P02_resultat r ON s.skipper_id = r.skipper_id LEFT JOIN P02_bateau b ON b.bateau_id = r.bateau_id WHERE r.resultat_pos IS NULL AND r.resultat_jours IS NULL AND r.resultat_temps IS NULL;";
                       $sql = "SELECT skipper_id FROM p02_skipper WHERE skipper_id NOT IN (SELECT skipper_id FROM p02_resultat)";
                        $result = pg_query($cnx, $sql);
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<option value='" . $row['skipper_id'] . "'>" . $row['skipper_id'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td> bateau id * :</td>
                <td>
                    <select name="bateau_id">
                        <?php
                        $cnx = connexion();
                        $sql = "SELECT bateau_id FROM p02_bateau WHERE bateau_id NOT IN (SELECT bateau_id FROM p02_resultat)";
                        $result = pg_query($cnx, $sql);
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<option value='" . $row['bateau_id'] . "'>" . $row['bateau_id'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr><td> Position * :</td><td><input type=number required="required"  name=position   ></td></tr> <br>
            <tr><td> Jours  * :</td><td><input type="number" required="required" name=jours min="1" max="200" ></td></tr> <br>
            <tr><td> Temps  * :</td><td> H:M:S <input type="time" required="required"  name=temps   ></td></tr> <br>
        </table>
        <input type="submit" value="AJOUTER" name="AJOUTER">


        <?php
        if (isset($_GET["AJOUTER"])){
            //changer addSkipper dans le fichier skipper
            addResultat($_GET["skipper_id"],$_GET["bateau_id"],$_GET["position"],$_GET["jours"],$_GET["temps"]);
        }
        ?>
