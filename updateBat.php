<?php


include 'fonctions.php';



session_start();
$cnx = connexion();
/*quand lutilisateur appuie sur modifier, on recupere le nom du bateau puis on ouvre une session pour le recuperer */
if (isset($_GET["modifier"]) && !empty($_GET["id"])) {
	$_SESSION["idetb"] = $_GET["id"];
	header("location:updateBat.php");
	exit(); // Il est important de sortir du script après une redirection avec header()
}else{
	header("location: erreur.php?code=2");
}

//on recupere lid deja enregistré dans la session idetb
$id2 = $_SESSION["idetb"];
$requete2 = "SELECT * FROM p02_Bateau WHERE bateau_id = '$id2'";
$result2 = pg_query($cnx, $requete2);

if($result2){
	while($ligne2 = pg_fetch_array($result2)){
		// recuperer chaque ligne du tableau et les enregistrer dans des sessions
		$_SESSION["bateau_nom"] = $ligne2["bateau_nom"];
		$_SESSION["bateau_date"] = $ligne2["bateau_date"];
		$_SESSION["bateau_architecte"] = $ligne2["bateau_architecte"];
		$_SESSION["bateau_classe"] = $ligne2["bateau_classe"];
	}
}


/* si l'utilisateur appuie sur "supprimer " alors on supprime toutes les informations*/
if (isset($_GET["supprimer"])) {
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$bat_id2 = $_GET["id"];
		deleteBateau($cnx, $bat_id2);
		header("location: Bateaux.php");
		exit();
	}
}


/* si l'utilisateur appuie sur "AJOUTER" on le redirige vers la page addBateau */
if(isset($_GET["AJOUTER"])){
	header("location:addBateau.php");
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

<nav>
	<a href="#" class="logo"> Projet PHP </a>
	<div class="nav-links">
		<ul>
			<li><a href="accueil.php"> Accueil</a></li>
			<li><a href="bateaux.php"> Bateaux</a></li>
			<li><a href="skippers.php"> Skippers</a></li>
			<li><a href="#"> A propos </a></li>
		</ul>
	</div>



</nav>

<div style="margin-left:15%;padding:1px 16px;height:100px;">

	<form method="get" action="updateBat.php"  >
		<table>
			<tr><td><H1> Modifier les Bateaux </H1></td></tr>



			<?php
			echo "<tr><td> Nom du bateau * :</td></tr><tr><td><input type='text' required='required' name='bateau_nom' value='".$_SESSION["bateau_nom"]."'></td></tr>";
			echo"	<tr><td> Date du bateau * :</td></tr><tr><td><input type=number required='required' name=bateau_date value=".$_SESSION["bateau_date"]."  ></td></tr>";
			echo"	<tr><td> Architecte * :</td></tr><tr><td><input type='text' required='required' name='bateau_architecte' value='". $_SESSION["bateau_architecte"]."' ></td></tr>";
/*
			echo "<tr><td> Classe *:</td></tr><tr><td><select name='bateau_classe' required='required'><option value='Class 40' ".
				($_SESSION["bateau_classe"]=='Class 40'?'selected':'').">Class 40</option><option value='Imoca' ".
				($_SESSION["bateau_classe"]=='Imoca'?'selected':'').">Imoca</option><option value='Multi 50' ".
				($_SESSION["bateau_classe"]=='Multi 50'?'selected':'').">Multi 50</option><option value='Ultim' ".
				($_SESSION["bateau_classe"]=='Ultim'?'selected':'').">Ultim</option></select></td></tr>";
*/
			echo"	<tr><td> Classe *:</td></tr><tr><td><input type='text'  required='required' name='bateau_classe' value='". $_SESSION["bateau_classe"]."' ></td></tr>";
			?>


		</table>

		<input type="submit" value="MODIFIER" name="MODIFIER">
	</form>


	<?php

	$i2=$_SESSION["idetb"];

	if(isset($_GET["MODIFIER"]) && isset($_SESSION["idetb"])){
		$bat_id2 = $_SESSION["idetb"];
		if ($bat_id2) { // Vérifier si un skipper a été sélectionné
			updateBateau($i2,$_GET["bateau_nom"],$_GET["bateau_date"],$_GET["bateau_architecte"],$_GET["bateau_classe"]);
		} else { // Afficher un message d'erreur si aucun skipper n'a été sélectionné
			echo "Veuillez sélectionner un skipper à modifier.";
		}
	}

	//if( isset($_GET["ANNULER"])) header("location:updateBat.php");
	?>

</div>

</body>
</html>