<form method="post" action="index.php?ctrl=user&action=profil">
	<label for="login">Login</label>
	<input type="text" id="login" name="login" value="<?php echo $u->getLogin();?>">
	<label for="pw">Changer le mot de passe</label>
	<input type="password" id="pw" name="pw">
	<label for="pw2">Mot de passe actuel</label>
	<input type="password" id="pw2" name="pw2">
	<input type="submit">
</form>