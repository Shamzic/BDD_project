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


    public function showCategoriesAdmin()
    {
        if (isset($_SESSION['user']))
        {
            $c = Category::getCategories();
            include 'views/adminCategory.php';
        }
        else
        {
            header('Location: index.php');
            exit();
        }
    }

    public function modification()
    {
        if (isset($_SESSION['user']))
        {
          /*  if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $u = User::get_by_login($_SESSION['user']);
                include 'views/profil.php';
            }*/
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $c = Category::getId($_POST['id']);
                $newname = htmlspecialchars($_POST['name']);
                if(is_null($c))
                {
                    $error_message = "New category name should not be empty !";
                    include 'views/error.php';
                }
                else
                {

                        $c->save($newname);
                        echo 'Category name edited !';
                }
            }
        }
        else
        {
            header('Location: index.php');
            exit();
        }
    }


}