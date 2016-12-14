<?php

require_once 'models/video.php';
require_once 'models/user.php';
require_once 'models/program.php';

class Controller_Program
{
    /**
     * \brief show all the categories
     */

    public function showPrograms()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idp = htmlspecialchars($_POST['prog']);
            $idu = $_SESSION['uid'];
            $idprog = Program::getSubscribtion_by_id($idu);
            if (in_array($idp, $idprog)) {
                Program::deleteSubscribeProg($idu, $idp);
            } else {
                Program::newSubscribeProg($idu, $idp);
            }
        }
        if (isset($_SESSION['user'])) {
            $idu = $_SESSION['uid'];
            $sp = Program::getSubscriptions($idu);
            $p = Program::getPrograms();
            include 'views/program.php';
        } else {
            header('Location: index.php');
            exit();
        }
    }

}