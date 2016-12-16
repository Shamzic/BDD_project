<html>
<head>
    <title>Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/profil.css" type="text/css">
</head>
<?php
foreach ($u as $user) {
    ?>
    <div class="titre">
        <div class="titre">User Id: <?php echo $user->getId(); ?></div>
    </div>
    <div class="profil">
        <form method="post" action="index.php?ctrl=user&action=updateUser&id_usr=<?php echo $user->getId() ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $user->getNom() ?>">
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" value="<?php echo $user->getPrenom() ?>">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" value="<?php echo $user->getLogin() ?>">
            <label for="password">Password</label>
            <input type="text" id="password" name="password" value="<?php echo $user->getMdp() ?>">
            <label for="mail">E-mail</label>
            <input type="text" id="mail" name="mail" value="<?php echo $user->getMail() ?>">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" value="<?php echo $user->getPays() ?>">
            <input type="submit">
        </form>
    </div>
    <?php
}
?>
<div class="row">
    <a href="index.php?ctrl=user&action=showUserFavAdmin&id_usr=<?php echo $user->getId() ?>" class="button button--admin">Favorites</a>
    <a href="index.php?ctrl=user&action=showUserSbsAdmin&id_usr=<?php echo $user->getId() ?>" class="button button--admin">Subscriptions</a>
</div>
</html>

