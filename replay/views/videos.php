<h2> Videos </h2>
<?php
	foreach($n as $note)
	{
		$sharedUsers = Partage::getUsersByNote($note->getId());?>
		<div style="border:1px solid black;width:30%;">
			<p style="margin:0;margin-bottom:2px;padding:5px;font-size:1.2rem;font-weight:bold;"><?php echo $note->getTitre();?></p>
			<p style="border-top:1px solid black;border-bottom:1px solid black;margin:0;margin-top:2px;padding:5px;"><?php echo $note->getTexte();?></p>
			<p style="margin-top:5px;margin-bottom:0;padding-left:5px;"><a href="index.php?ctrl=note&action=editNote&id=<?php echo $note->getId();?>"><img src="images/editer.png"></a>
			<a href="index.php?ctrl=note&action=deleteNote&id=<?php echo $note->getId();?>"><img src="images/supprimer.png"></a></p>
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