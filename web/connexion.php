<html>
<head>
		<meta charset="utf-8" />
	 	<link rel="stylesheet" href="connexion.css" type="text/css">
	 	<title>Videotubes</title>
	 	<!-- Lien d'une page css -->
</head>
<body>
	<?php include("menu.php"); ?>
		<h3>Liste des utilisateurs</h3>

	<?php
	$db_username = "shamery";
	$db_password = "totototo";
	$db = "oci:dbname=//osr-oracle.unistra.fr:1521/osr";
	try 
	{
		// Connexion a la base de donnees oracle
		$conn = new PDO($db,$db_username,$db_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$stmt = $conn->prepare("INSERT INTO test( A, B) VALUES ( 421, 241 ) ");
		//$stmt->execute();

		// Preparation de la requete SELECT
		$stmt = $conn->prepare("SELECT * FROM utilisateur");
		$stmt->execute();

		echo '<ul>';
		// Parcours des n-uplets resultats de la requete SELECT
		foreach($stmt as $row) 
		{
		  echo '<li>';
		  echo $row["PRENOM_USER"];
		  echo '</li>';
	 	}
	 	echo '</ul>';
	 	$stmt->closeCursor();

		$conn = NULL;
	} 
	catch(PDOException $e) 
	{
		echo "Echec connexion : ".$e->getMessage();
		exit;
	}
	?>
	<h3 class="text-center">
		Sign in
		<span class="subtitle">No account yet ? --> <a href="/~shamery/inscription.php">Sign up</a>
		</span>
	</h3>

	<form action="<?=BASEURL?>/~shamery/connexion.php" method="post">
		<div class="formline">
			<label for="login">Your login</label>
			<input type="text" id="login" placeholder="login" name="login">
		</div>
	
		<div class="formline">
			<label for="password">Your password</label>
			<input type="password" id="password" placeholder="*****" name="password">
		</div>
	
		<div class="formline">
			<label></label>
			<input type="submit" value="Sign in">
		</div>
	</form>





	
</body>
</html>
