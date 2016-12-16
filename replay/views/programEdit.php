<html>
<head>
    <title>Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/profil.css" type="text/css">
</head>
<?php
foreach ($p as $program) {
    ?>
    <div class="titre">
        <div class="titre">Program Id: <?php echo $program->getId(); ?></div>
    </div>
    <div class="profil">
        <form method="post" action="index.php?ctrl=program&action=updateProgram&id_prog=<?php echo $program->getId() ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $program->getName() ?>">
            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" value="<?php echo $program->getDesc() ?>">
            <input type="submit">
        </form>
    </div>
    <?php
}
?>
</html>

