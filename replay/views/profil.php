<html>
	<head>
		<title>Profil</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/profil.css" type="text/css">
	</head>
	<div class="titre">
		<div class="titre">Profil de <?php echo $u->getLogin();?></div>
	</div>
	<div class="profil">

		
		<ul>
			 <li class=blue>Login</li>
			 <li><?php echo $u->getLogin();?></li>
			 
			 <li class=blue>Nom</li>
			 <li><?php echo $u->getNom();?></li>
			 
			 <li class=blue>Prénom</li>
			 <li><?php echo $u->getPrenom();?></li>
			  
			  <li class=blue>Mail</li>
			  <li><?php echo $u->getMail();?></li>
			  
			 <li class=blue>Date de naissance</li>
			 <li><?php echo $u->getDateN();?></li>
			 
			 <li class=blue>Pays</li>
			 <li><?php echo $u->getPays();?></li>
		</ul>
		<form method="post" action="index.php?ctrl=user&action=profil">
			<label for="pw">Changer le login</label>
			<input type="text" id="login" name="login">
			<label for="pw">Changer le mot de passe</label>
			<input type="password" id="pw" name="pw">
			<label for="pw2">Mot de passe actuel</label>
			<input type="password" id="pw2" name="pw2">
			<input type="submit">
		</form>
	</div>


</html>

