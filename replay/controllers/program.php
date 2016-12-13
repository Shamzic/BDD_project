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
        if (isset($_SESSION['user']))
        {
            $p = Program::getPrograms();
            include 'views/program.php';
        }
        else
        {
            header('Location: index.php');
            exit();
        }
    }

}