<html height="100%" lang="fr">
	<head>
	<link href="flo.css" rel="stylesheet" type="text/css"/>
	<meta charset="utf-8" />
	<title>Formulaire de contact</title>
</head>
<body class="background">
<h1 class="banniere">Formulaire de Contact</h1>

<div class="cadre" position="fixed">
<div style="margin-left:150px;margin-right:-150px; font-size:120%">

<?php
if($_POST){
  $identifiant = $_POST['identifiant'];
  $mdp = $_POST['mdp'];
  //$mdp=sha1($mdp);
  //echo hash("sha256",sha1($mdp));
}

try {
  $bdd = new PDO('mysql:host=localhost;dbname=contact', 'root', '');
} catch(Exception $e){
  die('Erreur : '.$e->getMessage());
}

if(!empty($_POST['identifiant']) && !empty($_POST['mdp']) && isset($_POST['connexion'])){
  $articles1 = $bdd->query('SELECT * FROM connexion');

  while($aa = $articles1->fetch()) { 
    if($identifiant==$aa['Identifiant'] && hash("sha256",sha1($mdp)) == $aa['Mot de passe']){
      // header('Location: formulaire.php');
?>

<form method="post">
<br><br>
  <input type="radio"  name="drone" value="Monsieur">
  <label for="monsieur">M.</label>
  <input type="radio"  name="drone" value="Madame">
  <label for="madame">Mme.</label><br><br>    

Nom<span style="color:red">*</span>: <input type="text" name="nom" required/>
Prenom<span style="color:red">*</span>: <input type="text" name="prenom" required/> <br><br><br>
Numéro de tel<span style="color:red">*</span>: <input type="text" name="numero"/> <br><br><br>
Email: <input type="text" name="email"/> <br><br><br>
Adresse<span style="color:red">*</span>: <input type="text" name="adresse" required/><br><br><br>
Commune<span style="color:red">*</span>: <input type="text" name="commune" required/>
Pays<span style="color:red">*</span>: <input type="text" name="pays" required/><br>
<br><br><br><input type="submit" name="enrgistrer" value="Enregistrer"/>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

<a href="visualiser.php">Contacts</a>
</form>

<?php

    } else {
      echo "Erreur: Veuillez vous connecter!";
    }
  }
} else {
  echo "Erreur: Veuillez vous connecter!";
}

/*
if($_POST){
$sexe = $_POST['drone'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$numero = $_POST['numero'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$commune = $_POST['commune'];
$pays = $_POST['pays'];

try
{
$bdd = new PDO('mysql:host=localhost;dbname=contact', 'root', '');

}

catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

$result=0;
$articles = $bdd->query('SELECT * FROM personne');
?>
<?php while($a = $articles->fetch()) { ?>
<?php if($nom==$a['Nom'] && $prenom==$a['Prenom'] && $numero==$a['Numero']){
    $result= 1;
    echo"1";
 }}
if($result!=1){
if(!empty($_POST['numero']) || !empty($_POST['email']) || !empty($_POST['adresse'])){
$bdd->exec("INSERT INTO personne(Sexe, Nom, Prenom, Numero, Email, Adresse, Commune, Pays) VALUES('$sexe','$nom','$prenom','$numero','$email','$adresse','$commune','$pays')");
echo"Les coordonnées de $sexe $nom ont bien été Enregistrés";
}
} else{
echo"Les coordonnées existe déjà";
}


if(empty($_POST['drone'])){
echo'<br>';
echo"*Vous avez oublié de saisir";
}
if(empty($_POST['nom'])){
echo'<br>';
echo"*Vous avez oublié de saisir le nom";
}
if(empty($_POST['prenom'])){
echo'<br>';
echo"*Vous avez oublié de saisir le prenom";
}
if(empty($_POST['numero'])){
echo'<br>';
echo"*Vous avez oublié de saisir le numero";
}
if(empty($_POST['email'])){
echo'<br>';
echo"*Vous avez oublié de saisir l'email";
}
if(empty($_POST['adresse'])){
echo'<br>';
echo"*Vous avez oublié de saisir l'adresse";
}
if(empty($_POST['commune'])){
echo'<br>';
echo"*Vous avez oublié de saisir la commune";
}
if(empty($_POST['pays'])){
echo'<br>';
echo"*Vous avez oublié de saisir le pays";
}
}
*/

?>

</div></div>

</body>
</html>