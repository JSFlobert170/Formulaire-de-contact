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



/*if(isset($_POST['connexion'])){
    header('Location: formulaire.php');
}*/
?>
<form method="post" action="formulaire.php">
<br><br><br><br>

&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
Identifiant:&emsp;&emsp; <input type="text" placeholder="Identifiant" name="identifiant" style="background-color: white;"/><br><br><br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
Mot de passe:&emsp; <input type="password" placeholder="Mot de passe" name="mdp" style="background-color: white;"/><br><br>

&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<input type="submit" name="connexion" value="Connexion"/>
</form>

</div></div>
</body>
</html>