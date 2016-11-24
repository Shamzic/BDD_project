<html>

	<head>
		<meta charset="utf-8" />
	 	<link rel="stylesheet" href="connexion.css" type="text/css">
	 	<title>Videotubes</title>
	 	<!-- Lien d'une page css -->
	</head>

	<?php include("menu.php"); ?>

<form action="<?=BASEURL?>/~shamery/inscription.php" method="post">
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

</html>
