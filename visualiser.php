<html height="100%" lang="fr">
	<head>
    <link href="flo.css" rel="stylesheet" type="text/css"/>
    <meta charset="utf-8" />
    <title>Contacts</title>
  </head>

<body class="background">
<h1 class="banniere">Contacts</h1>

<div class="cadre" position="fixed">
<div style="margin-left:350px; padding-right:-150px; font-size:120%">

<form method="GET">
<br>
   <input type="search" name="recherche" placeholder="Recherche..." />
   <input type="submit" value="Valider" />
</form>
</div>
<a style="margin-left:825px; font-size:120%" href="formulaire.php">Retour</a>

<div style="margin-left:15px; margin-right:-150px; font-size:120%">
<?php 

try
{//////////////////////////////////////////////////////////////////////////////////Connection////////////////////////////////////
  $bdd = new PDO('mysql:host=localhost;dbname=contact', 'root', '');

}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if (isset($_POST['supprimer']) ){///////////////////////////////////////////////////////Suppression//////////////////////////////////////////////////////////////////////////
  $sql = "DELETE FROM personne WHERE id='" .$_POST['id']. "'";
  $sth = $bdd->prepare($sql);
  $sth->execute();
  $count = $sth->rowCount();
  print('Suppression de ' .$count. ' entrée(s).');
} 
 
if (isset($_POST['modifier'])){//////////////////////////////////////////////////////////Modification///////////////////////////////////////////////////////////////////////
  $reponse = $bdd->query("SELECT * FROM personne where id='" .$_POST['id']. "'");
  $donnees = $reponse->fetch(); 
  ?>
  <br><br>
  <div style="margin-left:150px;margin-right:-150px">

  <form action="" method="post">
  <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
  Nom : <input type="text" name="nom" value="<?php echo $donnees['Nom']; ?>"/>
  Prenom : <input type="text" name="prenom" value="<?php echo $donnees['Prenom']; ?>"/> <br><br><br>
  Numéro de tel : <input type="text" name="numero" value="<?php echo $donnees['Numero']; ?>"/> <br><br><br>
  Email : <input type="text" name="email" value="<?php echo $donnees['Email']; ?>"/> <br><br><br>
  Adresse : <input type="text" name="adresse" value="<?php echo $donnees['Adresse']; ?>"/><br><br><br>
  Commune : <input type="text" name="commune" value="<?php echo $donnees['Commune']; ?>"/>
  Pays : <input type="text" name="pays" value="<?php echo $donnees['Pays']; ?>"/><br><br>
  <td><input type="submit" name="valider" value="Valider"></td>
  </form>

  </div>
  <?php
} 

if(isset($_POST['valider'])){  /////////////////////////////////////////////////////////////Valider///////////////////////
  $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sth = $bdd->prepare("UPDATE personne SET Nom='" .$_POST['nom']. "', Prenom='" .$_POST['prenom']. "', Numero='" .$_POST['numero']. "', Email='" .$_POST['email']. "', Adresse='" .$_POST['adresse']. "', Commune='" .$_POST['commune']. "', Pays='" .$_POST['pays']. "' WHERE id='" .$_POST['id']. "'");
  $sth->execute();
  $count = $sth->rowCount();
  
print('Modification de ' .$count. ' entrée(s).');
}

$articles = $bdd->query('SELECT Nom FROM personne ORDER BY id DESC');
if(isset($_GET['recherche']) AND !empty($_GET['recherche'])) {///////////////////////////Barre de recherche///////////////////////////////////

  $recherche = htmlspecialchars($_GET['recherche']);
  $articles = $bdd->query('SELECT * FROM personne WHERE CONCAT(Nom, Prenom) LIKE "%'.$recherche.'%" ORDER BY id DESC');

  if($articles->rowCount() == 0) {
    $articles = $bdd->query('SELECT * FROM personne WHERE CONCAT(Commune, Pays) LIKE "%'.$recherche.'%" ORDER BY id DESC');
  }

?>
<?php if($articles->rowCount() > 0) { ?>

   <ul>
   <?php while($donnees = $articles->fetch()) { ?>
    <li> <img style="width: 30px; height:25px" src="data/contact_4.png" alt="" />
      <?=$donnees['Sexe']; ?> 
      <?=  $donnees['Nom']; ?> </li><br />

      <form action="" method="post">
        Nom : <?php echo $donnees['Nom']; ?> <br />
        Prenom : <?php echo $donnees['Prenom'];?> <br />
        Numero : <?php echo $donnees['Numero'];?> <br />
        Email : <?php echo $donnees['Email'];?> <br />
        Adresse : <?php echo $donnees['Adresse'];?> <br />
        Commune : <?php echo $donnees['Commune']; ?> <br />
        Pays : <?php echo $donnees['Pays']; ?> <br /><br />

        <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
        <input type="submit" name="supprimer" class="delete" value="Supprimer">
        <input type="submit" name="modifier" value="Modifier"><br /><br />
      </form>
   <?php } ?>
   </ul>

<?php } else { ?>
Aucun résultat pour: <?= $recherche ?>...
<?php } }?>

<table>
  <p>
  <tr>
    <th>&emsp;</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Numero</th>
    <th>Email</th>
    <th>Adresse</th>
    <th>Commune</th>
    <th>Pays</th>
  </tr>

<?php
$reponse = $bdd->query('SELECT * FROM personne');
$iii=0;
while ($donnees = $reponse->fetch())
{///////////////////////////////////////////////////////////////////////Tableau affichage///////////////////////////////////////////
$iii++;
?>
<div>

  <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
    <tr>
      <td><?php $iii; echo $donnees['Sexe']; ?></td>
      <td><?php echo $donnees['Nom']; ?></td>
      <td><?php echo $donnees['Prenom'];?></td>
      <td><?php echo $donnees['Numero'];?></td>
      <td><?php echo $donnees['Email'];?></td>
      <td><?php echo $donnees['Adresse'];?></td>
      <td><?php echo $donnees['Commune']; ?></td>
      <td><?php echo $donnees['Pays']; ?></td>
      <td><input type="submit" name="supprimer" class="delete" value="Supprimer">
      <br><br><input type="submit" name="modifier" value="Modifier"></td>
    </tr>
  </form>
  </p>
</div>
<?php
}
?>
</table>
<br>
<a style="margin-left:825px" href="formulaire.php">Retour</a>
</div></div>
</body>
</html>