<?php
require_once 'config.php';
require_once 'models/base.php';

$db = new PDO(BDD_DSN, BDD_USER, BDD_PW);
Model_Base::set_db($db);

session_start();

// enregistrement de la sortie dans un buffer
// (permet d'appeler des méthodes qui ajoutent des headers à la
//  réponse HTTP avant d'avoir commencé à envoyer du contenu)
ob_start();

// on cherche à interpréter des URL du type : index.php?ctrl=user&action=connexion

$found = false;

if (isset($_GET['ctrl']) && isset($_GET['action'])) {
    $ctrl_file = 'controllers/' . $_GET['ctrl'] . '.php';
    if (file_exists($ctrl_file)) {
        require_once $ctrl_file;
        $ctrl_class = 'Controller_' . ucfirst($_GET['ctrl']);
        if (class_exists($ctrl_class)) {
            $c = new $ctrl_class();
            $method = $_GET['action'];
            if (method_exists($c, $method)) {
                $c->$method();
                $found = true;
            }
        }
    }
} else {
    $found = true;
    include 'views/home.html';
}

if (!$found) {
    header('Location: index.php');
    exit();
}

// récupération du contenu du buffer de sortie
$content = ob_get_clean();
?>

<!DOCTYPE html>

<html>
<head>
    <title>Videosef</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/connexion.css" type="text/css">
    <link rel="stylesheet" href="css/foundation.css" type="text/css">
    <link rel="stylesheet" href="css/app.css" type="text/css">
</head>
<body>
<!--<header>-->
<!--    <div class="row">-->
<!--        <div class="large-12 columns">-->
<!--            <h1>Welcome to iReplay --><?php //echo isset($_SESSION['user']) ? $_SESSION['user'] : '' ?><!--</h1>-->
<!--        </div>-->
<!--    </div>-->
<!--    <h1> Videosef --><?php //echo isset($_SESSION['user']) ? $_SESSION['user'] : '' ?><!--</h1>-->
<!--</header>-->

<?php
if (isset($_SESSION['user'])) {
    ?>

    <ul class="menu topBar-ul expanded">
        <li class="topBar-li"><a href="index.php?ctrl=note&action=mesNotes">Videos</a></li>
        <li class="topBar-li"><a href="index.php?ctrl=note&action=mesNotes">Programs</a></li>
        <li class="topBar-li"><a href="index.php?ctrl=note&action=mesNotes">Categories</a></li>
        <li class="topBar-li"><a href="index.php?ctrl=note&action=mesNotes">Favorites</a></li>
        <li class="topBar-li"><a href="index.php?ctrl=note&action=mesNotes">Subscriptions</a></li>
        <li class="topBar-li"><a href="index.php?ctrl=note&action=mesNotes">Recommended</a></li>
        <li class="topBar-li"><a href="index.php?ctrl=user&action=profil"> Profil </a></li>
        <li class="topBar-li"><a href="index.php?ctrl=user&action=deconnexion"> Déconnexion </a></li>
<!--        <li class="topBar-li"><a href="index.php?ctrl=note&action=createNote"> Ajouter une note </a></li>-->
<!--        <li class="topBar-li"><a href="index.php?ctrl=note&action=showSharedNotes"> Notes partagées avec moi </a></li>-->
    </ul>

    <?php
} else {
    ?>


    <?php
}
?>
<div id="central" style="height: 100%">
<!--    <nav>-->
<!--        <ul>-->
<!--            <li><a href="index.php?ctrl=user&action=inscription"> Inscription </a><br></li>-->
<!--            <li><a href="index.php?ctrl=user&action=connexion"> Connexion </a><br></li>-->
<!--        </ul>-->
<!--    </nav>-->
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    echo $content;
    ?>
</div>

<footer id="footer">
    <p>Projet de base de données web </p>
    <p>L3 informatique</p>
</footer>

<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
</body>
</html>