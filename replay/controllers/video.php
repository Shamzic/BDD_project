<?php

require_once 'models/video.php';
require_once 'models/user.php';
require_once 'models/favorite.php';
require_once 'models/recommended.php';

class Controller_Video
{

    /**
     * \brief show all the videos
     */

    public function showVideos()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['fav']);
            $idu = $_SESSION['uid'];
            $idfav = Favorite::get_by_id($idu);
            if (in_array($idv, $idfav)) {
                Favorite::deleteFavorite($idu, $idv);
            } else {
                Favorite::newFavorite($idu, $idv);
            }

        }
        if (isset($_SESSION['user'])) {
            $idu = $_SESSION['uid'];
            $v = Video::getVideos();
            $f = Favorite::getFavorites($idu);
            include 'views/videos.php';
        } else {
            header('Location: index.php');
            exit();
        }
    }

    /**
     * \brief show video by its id
     */

    public function showVideoById()
    {
        if (isset($_SESSION['user'])) {
            if (isset($_GET['id_video'])) {
                $id = (int)$_GET['id_video'];
                $v = Video::getById($id);
                include 'views/video.php';
            } else {
                $id = (int)$_GET['id_video'];
                $error_message = $id;
                include 'views/error.php';
            }
        } else {
            header('Location: index.php');
            exit();
        }
    }

    /**
     * \brief show videos by category
     */

    public function showVideosByCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['fav']);
            $idu = $_SESSION['uid'];
            $idfav = Favorite::get_by_id($idu);
            if (in_array($idv, $idfav)) {
                Favorite::deleteFavorite($idu, $idv);
            } else {
                Favorite::newFavorite($idu, $idv);
            }

        }
        if (isset($_SESSION['user'])) {
            if (isset($_GET['id_cat'])) {
                $id = (int)$_GET['id_cat'];
                $idf = $_SESSION['uid'];
                $f = Favorite::getFavorites($idf);
                $vc = Video::getByCategory($id);
                include 'views/video_by_category.php';
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

    public function showVideosByFavorite()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['fav']);
            $idu = $_SESSION['uid'];
            $idfav = Favorite::get_by_id($idu);
            if (in_array($idv, $idfav)) {
                Favorite::deleteFavorite($idu, $idv);
            } else {
                Favorite::newFavorite($idu, $idv);
            }

        }
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['uid'];
            $f = Video::getByFavorite($id);
            include 'views/favorite.php';
        } else {
            header('Location: index.php');
            exit();
        }
    }

    public function showVideoAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['del']);
            Video::deleteVideo($idv);
        }
        if (isset($_SESSION['user'])) {
            $v = Video::getVideos();
            include 'views/adminVideo.php';
        } else {
            header('Location: index.php');
            exit();
        }
    }

    public function showVideoAdminEdit()
    {
        if (isset($_SESSION['user'])) {
            if (isset($_GET['id_vid'])) {
                $id = (int)$_GET['id_vid'];
                $v = Video::getById($id);
                include 'views/videoEdit.php';
            } else {
                $id = (int)$_GET['id_vid'];
                $error_message = $id;
                include 'views/error.php';
            }
        } else {
            header('Location: index.php');
            exit();
        }
    }

    public function updateVideo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['url'])) {
                if ($_POST['name'] != '' && $_POST['url'] != '' && $_POST['desc'] != '') {
                    $id = (int)$_GET['id_vid'];
                    $name = htmlspecialchars($_POST['name']);
                    $desc = htmlspecialchars($_POST['desc']);
                    $url = htmlspecialchars($_POST['url']);
                    Video::updateVid($id, $name, $desc, $url);
                    $_SESSION['message'] = "Video edited";
                    $v = Video::getVideos();
                    include 'views/adminVideo.php';
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

    public function showVideosByRecommended()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['fav']);
            $idu = $_SESSION['uid'];
            $idfav = Favorite::get_by_id($idu);
            if (in_array($idv, $idfav)) {
                Favorite::deleteFavorite($idu, $idv);
            } else {
                Favorite::newFavorite($idu, $idv);
            }
        }

        if (isset($_SESSION['user'])) {
            $idu = $_SESSION['uid'];
            $f = Video::getByFavorite($idu);
            $id = $_SESSION['uid'];
            $rec = Video::getByRecommended($id);
            include 'views/recommended.php';
        } else {
            header('Location: index.php');
            exit();
        }
    }


    public function showVideosByProgram()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['fav']);
            $idu = $_SESSION['uid'];
            $idfav = Favorite::get_by_id($idu);
            if (in_array($idv, $idfav)) {
                Favorite::deleteFavorite($idu, $idv);
            } else {
                Favorite::newFavorite($idu, $idv);
            }

        }
        if (isset($_SESSION['user'])) {
            if (isset($_GET['id_prog'])) {
                $id = (int)$_GET['id_prog'];
                $idf = $_SESSION['uid'];
                $f = Favorite::getFavorites($idf);
                $vp = Video::getByProgram($id);
                include 'views/video_by_program.php';
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

    public function showVideosBySubscriptions()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idv = htmlspecialchars($_POST['fav']);
            $idu = $_SESSION['uid'];
            $idfav = Favorite::get_by_id($idu);
            if (in_array($idv, $idfav)) {
                Favorite::deleteFavorite($idu, $idv);
            } else {
                Favorite::newFavorite($idu, $idv);
            }

        }
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['uid'];
//            $idf = $_SESSION['uid'];
            $f = Favorite::getFavorites($id);
            $s = Video::getBySubscription($id);
            include 'views/subscription.php';
        } else {
            header('Location: index.php');
            exit();
        }
    }
}