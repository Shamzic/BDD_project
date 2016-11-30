<h2> Notes partagées avec moi </h2>
<?php
	foreach($sharedNotesWithMe as $note)
	{
		$sharedUsers = Partage::getUsersByNote($note['id']);?>
		<div style="border:1px solid black;width:30%;">
			<p style="margin:0;margin-bottom:2px;padding:5px;font-size:1.2rem;font-weight:bold;"><?php echo $note['titre'];?> (Auteur : <?php echo $note['auteur'];?>)</p>
			<p style="border-top:1px solid black;border-bottom:1px solid black;margin:0;margin-top:2px;padding:5px;"><?php echo $note['texte'];?></p>
			<p style="margin-top:5px;margin-bottom:0;padding-left:5px;"><a href="index.php?ctrl=video&action=editNote&id=<?php echo $note['id'];?>"><img src="images/editer.png"></a>
			<a href="index.php?ctrl=video&action=deleteNote&id=<?php echo $note['id'];?>"><img src="images/supprimer.png"></a></p>
			<p style="border-top:1px solid black;margin-top:5px;margin-bottom:0;padding-left:5px;">Partagée avec : <?php
				for($i=0; $i < count($sharedUsers); $i++)
				{
					echo $sharedUsers[$i]['login'];
					if ($i != count($sharedUsers)-1)
					{
						echo ' - ';
					}
				}?>
			</p>
		</div><br><?php
	}
?>