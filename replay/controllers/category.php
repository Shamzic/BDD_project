<?php

require_once 'models/video.php';
require_once 'models/user.php';
require_once 'models/category.php';

class Controller_Category
{
    /**
     * \brief show all the categories
     */

    public function showCategories()
    {
        if (isset($_SESSION['user']))
        {
            $c = Category::getCategories();
            include 'views/category.php';
        }
        else
        {
            header('Location: index.php');
            exit();
        }
    }

}