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


    public function showCategoryAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['del']);
            Category::deleteCategory($idv);
        }
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

    public function showCategoryAdminEdit()
    {
        if (isset($_SESSION['user'])) {
            if (isset($_GET['id_cat'])) {
                $id = (int)$_GET['id_cat'];
                $c = Category::getById($id);
                include 'views/categoryEdit.php';
            } else {
                $id = (int)$_GET['id_cat'];
                $error_message = $id;
                include 'views/error.php';
            }
        } else {
            header('Location: index.php');
            exit();
        }
    }

    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name'])) {
                if ($_POST['name'] != '') {
                    $id = (int)$_GET['id_cat'];
                    $name = htmlspecialchars($_POST['name']);
                    Category::updateCat($id,$name);
                    $_SESSION['message'] = "Category edited";
                    $c = Category::getCategories();
                    include 'views/adminCategory.php';
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