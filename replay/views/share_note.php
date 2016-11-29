<fieldset style="width:35%;">
	<legend> Partager une note </legend>
	<form method="post" action="index.php?ctrl=note&action=shareNote&id=<?php echo $note->getId();?>">
		<label for="share">Partager avec : (logins séparés par des -)</label><br>
		<input type="text" id="share" name="share"><br>
		<input type="submit">
	</form>
	<p style="margin-bottom:0;">
	<?php
		for($i = 0; $i < count($u); $i++)
		{?>
			<a href="index.php?ctrl=note&action=deleteShare&nid=<?php echo $note->getId()?>&uid=<?php echo $u[$i]['id']; ?>"><img src="images/supprimer.png"></a>
			<?php
				echo '<span style="vertical-align:25%;">'.$u[$i]['login'].'</span>';
		}?>
	</p>
</fieldset><br>