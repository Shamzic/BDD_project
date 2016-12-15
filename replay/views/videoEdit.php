<html>
<head>
    <title>Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/profil.css" type="text/css">
</head>
<?php
foreach ($v as $video) {
    ?>
    <div class="titre">
        <div class="titre">Video Id: <?php echo $video->getId(); ?></div>
    </div>
    <div class="profil">
        <form method="post" action="index.php?ctrl=video&action=updateVideo&id_vid=<?php echo $video->getId() ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $video->getTitre() ?>">
            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" value="<?php echo $video->getDesc() ?>">
            <label for="url">URL</label>
            <input type="text" id="url" name="url" value="<?php echo $video->getLink() ?>">
            <input type="submit">
        </form>
    </div>
    <?php
}
?>
</html>

