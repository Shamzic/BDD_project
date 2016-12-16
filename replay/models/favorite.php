<?php

require_once 'base.php';

class Favorite extends Model_Base
{
    private $_iduser;
    private $_idvideo;

    public function __construct ($userid,$videoid)
    {
        $this->setIdUser($userid);
        $this->setIdVideo($videoid);
    }

    public function getIdUser()
    {
        return $this->_iduser;
    }

    public function setIdUser($id)
    {
        $this->_iduser = (int) $id;
    }

    public function getIdVideo()
    {
        return $this->_idvideo;
    }

    public function setIdVideo($idVideo)
    {
        $this->_idvideo = (int) $idVideo;
    }

    public static function get_by_id($idu) {
        $s = self::$_db->prepare('SELECT id_vid FROM favoris WHERE id_user = :idu');
        $s->bindValue(':idu', $idu, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = ($data['id_vid']);
        }
        return $res;
    }

    public static function newFavorite($idu, $idv)
    {
        $q = self::$_db->prepare('INSERT INTO favoris (id_vid, id_user) VALUES (:idv,:idu)');
        $z = self::$_db->prepare('INSERT INTO interesse (id_categorie, id_user) VALUES ((SELECT id_categ from video where id_vid = :idv),:idu)'); // (SELECT id_categorie from video where id_vid = :idv)
        $q->bindValue(':idu',$idu, PDO::PARAM_STR);
        $q->bindValue(':idv',$idv, PDO::PARAM_STR);
        $z->bindValue(':idu',$idu, PDO::PARAM_STR);
        $z->bindValue(':idv',$idv, PDO::PARAM_STR);
        $q->execute();
        $z->execute();
    }

    public static function deleteFavorite($idu, $idv)
    {
        $s = self::$_db->prepare('DELETE FROM favoris WHERE id_vid = :idv AND id_user = :idu');
        //$z = self::$_db->prepare('DELETE FROM interesse (id_categorie, id_user) VALUES ((SELECT id_categ from video where id_vid = :idv),:idu)');
        $z = self::$_db->prepare('DELETE FROM interesse WHERE id_categorie IN (SELECT id_categ from video where id_vid = :idv) AND id_user = :idu');
        $s->bindValue(':idv', $idv, PDO::PARAM_INT);
        $s->bindValue(':idu', $idu, PDO::PARAM_INT);
        $z->bindValue(':idu',$idu, PDO::PARAM_STR);
        $z->bindValue(':idv',$idv, PDO::PARAM_STR);
        $s->execute();
        $z->execute();
    }


    /**
     * \brief Get all the videos put in favorites from an user
     */

    public static function getFavorites($idUser)
    {
        $s = self::$_db->prepare('SELECT id_vid FROM favoris WHERE id_user = :idUser');
        $s->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = ($data['id_vid']);
        }
        return $res;
    }


}