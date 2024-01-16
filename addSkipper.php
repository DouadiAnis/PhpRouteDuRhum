<?php

include 'fonctions.php';

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Projet PHP</title>
    <link rel="stylesheet" href="style.css">

</head>
<body style="background:#C1CFC0" >

<nav>
			<a href="#" class="logo"> Projet PHP </a>
			<div class="nav-links">
				<ul>
					<li><a href="Accueil.php"> Accueil</a></li>
					<li><a href="Bateaux.php"> Bateaux</a></li>
					<li><a href="Skippers.php"> Skippers</a></li>
					<li><a href="Resultats.php"> A propos </a></li>
				</ul>
  			</div>



		</nav>

<div style="margin-left:15%;padding:1px 16px;height:100px;">

<form method="get"  action="addSkipper.php">
<table>
<tr><td> <h1> Ajouter un Skipper </h1></td></tr>
<tr><td> Nom  * :</td><td><input type=text required="required"  name=nom   ></td></tr> <br>
<tr><td> Prénom * :</td><td><input type=text required="required"  name=prenom   ></td></tr> <br>
<tr><td> Age  * :</td><td><input type="number" required="required" name=age min="2" max="100" ></td></tr> <br>
<tr><td> Sexe  * :</td><td>Homme <input type="radio" name=sexe value="Homme"/></td><td>Femme <input type="radio" name=sexe value="Femme"/></td></tr> <br>
<tr><td> Nationalité  * :</td><td><input type=text required="required"  name=natio   ></td></tr> <br>

</table>
 <input type="submit" value="AJOUTER" name="AJOUTER">
<?php
if (isset($_GET["AJOUTER"])){
  //changer addSkipper dans le fichier skipper
      addSkipper($_GET["nom"],$_GET["prenom"],$_GET["age"],$_GET["sexe"],$_GET["natio"]);
 }
?>
