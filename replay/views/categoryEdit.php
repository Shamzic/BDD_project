<html>
<head>
    <title>Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/profil.css" type="text/css">
</head>
<?php
foreach ($c as $category) {
    ?>
    <div class="titre">
        <div class="titre">Category Id: <?php echo $category->getId(); ?></div>
    </div>
    <div class="profil">
        <form method="post" action="index.php?ctrl=category&action=updateCategory&id_cat=<?php echo $category->getId() ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $category->getName() ?>">
            <input type="submit">
        </form>
    </div>
    <?php
}
?>
</html>

