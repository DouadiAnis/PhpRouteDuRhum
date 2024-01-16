<?php
include 'connexion.php';
function connexion(){
    $strConnex = "host = ".$_ENV['dbHost']. "dbname=".$_ENV['dbName']. "user=" .$_ENV['dbUser']. "password=" .$_ENV['dbPassword'];
    $cnx = pg_connect($strConnex);
    if (!$cnx){
        header("location: erreur.php?code=6");
    }
}
function addSkipper($nom,$prenom,$age,$sexe,$natio){
    $cnx = connexion();
    $sql1 = "INSERT INTO p02_skipper(skipper_nom, skipper_prenom, skipper_age, skipper_sexe,skipper_nationnalite) VALUES('$nom','$prenom','$age','$sexe','$natio')";
    $exec=pg_query($cnx,$sql1);
    if ($exec) {
        header("location:Skippers.php");
    }else{
        header("location: erreur.php?code=5");
    }
}

function updateSkipper( $idAModifier, $nom ,$prenom , $age, $sexe, $natio){
    $cnx = connexion();
    $requete = "SELECT * FROM p02_skipper WHERE skipper_id = '$idAModifier'";
    $result = pg_query($cnx, $requete);
    if($result){
        $requeteModifiee = "UPDATE p02_skipper SET skipper_nom = '$nom',skipper_prenom = '$prenom' ,skipper_age = '$age', skipper_sexe = '$sexe', skipper_nationnalite='$natio' WHERE skipper_id='$idAModifier'";
        $resultat = pg_query($cnx, $requeteModifiee);
        if ($resultat){
            header("location:Skippers.php");
        }

    }else{
        echo"Requete impossible";
    }
}

function deleteSkipper($skip_id){
    $cnx = connexion();
    // Supprimer les résultats associés au skipper
    $sql = "DELETE FROM p02_resultat WHERE skipper_id='$skip_id'";
    $result = pg_query($cnx, $sql);
    // Supprimer le skipper
    $sql1 = "DELETE FROM p02_skipper WHERE skipper_id='$skip_id'";
    $exec = pg_query($cnx, $sql1);
    header("Location: Skippers.php");
    exit();
}


function addBateau($nom, $date,  $archi, $classe){
    $cnx = connexion();
    $compar=0;
    $sql = "SELECT * FROM p02_Bateau";
    $result = pg_query($cnx,$sql);
    if ($result) {
        while($row = pg_fetch_assoc($result) ) {
            if(strcasecmp($row['bateau_nom'], $nom ) == 0 && strcasecmp($row['bateau_date'],$date)==0 && strcasecmp($row['bateau_architecte'], $archi ) == 0  && strcasecmp($row['bateau_classe'],$classe)==0) {
                $compar=1;
                break;
                /* On vérifie si les informations inserés existe déjà dans notre table bateau */
            }
        }
        if($compar!=-1){

            /* on ajoute les informations insérer dans la table bateau de notre base de données */

            $sql1 = "INSERT INTO p02_bateau(bateau_id, bateau_nom , bateau_date, bateau_architecte, bateau_classe) VALUES(DEFAULT,'$nom','$date', '$archi','$classe')";
            $exec=pg_query($cnx,$sql1);
            header("location:Bateaux.php");


        }
        else{
            echo "<script>alert(\"Ce Bateau existe deja\")</script>";
        }
    }

}

function updateBateau($idAModifier2, $nom, $date, $archi, $classe) {
    $cnx = connexion();
    $requete2 = "SELECT * FROM p02_bateau WHERE bateau_id = '$idAModifier2'";
    $result2 = pg_query($cnx, $requete2);
    if($result2){
        $requeteModifiee2 = "UPDATE p02_bateau SET bateau_nom = '" . pg_escape_string($nom) . "',bateau_date = '$date', bateau_architecte = '$archi', bateau_classe = '$classe' WHERE bateau_id='$idAModifier2'";
        $resultat2 = pg_query($cnx, $requeteModifiee2);
        if ($resultat2) {
            header("location:Bateaux.php");
        } else {
            echo "Requete impossible";
        }
    } else {
        echo "Requete impossible";
    }
}


function deleteBateau($bat_id2){
    $cnx = connexion();
    // Supprimer les résultats associés au skipper
    $sql2 = "DELETE FROM p02_resultat WHERE bateau_id='$bat_id2'";
    $result2 = pg_query($cnx, $sql2);
    // Supprimer le skipper
    $sql2 = "DELETE FROM p02_bateau WHERE bateau_id='$bat_id2'";
    $exec = pg_query($cnx, $sql2);
    header("Location: Bateaux.php");
    exit();
}




function addResultat($skipper_id, $bateau_id, $position, $jours, $temps){
    $cnx = connexion();
    $sql1 = "INSERT INTO p02_resultat(skipper_id, bateau_id, resultat_pos, resultat_jours, resultat_temps) VALUES('$skipper_id', '$bateau_id', '$position','$jours','$temps')";
    $exec = pg_query($cnx, $sql1);
    header("location:Resultats.php");
    exit();
}

function updateRes($idmod,$position, $jours, $temps){
    $cnx = connexion();
    $requete = "SELECT * FROM p02_resultat WHERE skipper_id = '$idmod'";
    $result = pg_query($cnx, $requete);
    if($requete){
        $requeteModifiee = "UPDATE p02_resultat SET  resultat_pos = '$position',resultat_jours = '$jours' ,resultat_temps = '$temps' WHERE skipper_id = '$idmod'";
        $resultat = pg_query($cnx, $requeteModifiee);
        if ($resultat){
            header("location:Resultats.php");
            exit();
        }
    }
}

function deleteResultat($skip_id,$bat_id){
    $cnx = connexion();
    // Supprimer les résultats associés au skipper et au bateau
    $sql = "DELETE FROM p02_resultat WHERE skipper_id='$skip_id' AND bateau_id = '$bat_id'";
    // a demander
    //$sql = "UPDATE p02_resultat SET resultat_pos = NULL, resultat_jours = NULL, resultat_temps = NULL WHERE skipper_id = '$skip_id'";
    $result = pg_query($cnx, $sql);
    if ($result){
        header("Location: Resultats.php");
        exit();
    }
}