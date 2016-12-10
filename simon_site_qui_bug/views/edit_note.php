<fieldset style="width:35%;">
	<legend> Editer une note </legend>
	<form method="post" action="index.php?ctrl=video&action=editNote&id=<?php echo $note->getId();?>">
		<label for="titre">Titre</label><br>
		<input type="text" id="titre" name="titre" value="<?php echo $note->getTitre();?>"><br>
		<label for="txt">Texte</label><br>
		<textarea id="txt" name="txt" maxlength="500" cols="40" rows="20"><?php echo $note->getTexte();?></textarea><br>
		<input type="submit">
</form><br>
</fieldset><br>
		