<html>
</head>
<body>
		<h1>Liste des utilisateurs</h1>

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

	<form action="<?=BASEURL?>/index.php/user/signup" method="post">
	<div class="formline">
		<label>Pseudo</label>
		<input type="text" placeholder="login" name="login">
	</div>
	
	<div class="formline">
		<label>Mot de passe</label>
		<input type="password" placeholder="*****" name="password">
	</div>
	
	<div class="formline">
		<label>Confirmez le mot de passe</label>
		<input type="password" placeholder="*****" name="password_check">
	</div>
	
	<div class="formline">
		<label></label>
		<input type="submit" value="Sign up">	
	</div>
	
	</form>

</body>
</html>
