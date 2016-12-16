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

    public function showProgramAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idp = htmlspecialchars($_POST['del']);
            Program::deleteProgram($idp);
        }
        if (isset($_SESSION['user']))
        {
            $p = Program::getPrograms();
            include 'views/adminProgram.php';
        }
        else
        {
            header('Location: index.php');
            exit();
        }
    }

    public function showProgramAdminEdit()
    {
        if (isset($_SESSION['user'])) {
            if (isset($_GET['id_prog'])) {
                $id = (int)$_GET['id_prog'];
                $p = Program::getById($id);
                include 'views/programEdit.php';
            } else {
                $id = (int)$_GET['id_prog'];
                $error_message = $id;
                include 'views/error.php';
            }
        } else {
            header('Location: index.php');
            exit();
        }
    }

    public function updateProgram()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && isset($_POST['desc'])) {
                if ($_POST['name'] != '' && $_POST['desc'] != '') {
                    $id = (int)$_GET['id_prog'];
                    $name = htmlspecialchars($_POST['name']);
                    $desc = htmlspecialchars($_POST['desc']);
                    Program::updateProg($id,$name, $desc);
                    $_SESSION['message'] = "Program edited";
                    $p = Program::getPrograms();
                    include 'views/adminProgram.php';
                } else {
                    $error_message = "Every fields need to be complete";
                    include 'views/error.php';
                }
            } else {
                $error_message = "Data post incomplete";
                include 'views/error.php';
            }
        }
    }


}