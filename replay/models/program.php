<?php

require_once 'base.php';

class Program extends Model_Base
{
    private $_id;
    private $_name;
    private $_image;

    public function __construct($id, $category_name, $category_img)
    {
        $this->setId($id);
        $this->setName($category_name);
        $this->setImage($category_img);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = (int)$id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($category_name)
    {
        if (is_string($category_name)) {
            $this->_name = $category_name;
        } else {
            $this->_name = '';
        }
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function setImage($category_img)
    {
        $this->_image = $category_img;
    }


    /**
     * \brief Get all the categories
     */

    public static function getPrograms()
    {
        $s = self::$_db->prepare('SELECT * FROM emission');
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Program($data['id_ems'], $data['name'], $data['image']);
        }
        return $res;
    }

    public static function getSubscribtion_by_id($idu)
    {
        $s = self::$_db->prepare('SELECT id_ems FROM abonnement WHERE id_user = :idu');
        $s->bindValue(':idu', $idu, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = ($data['id_ems']);
        }
        return $res;
    }

    public static function newSubscribeProg($idu, $idp)
    {
        $q = self::$_db->prepare('INSERT INTO abonnement (id_ems, id_user) VALUES (:idp,:idu)');
        $q->bindValue(':idu', $idu, PDO::PARAM_STR);
        $q->bindValue(':idp', $idp, PDO::PARAM_STR);
        $q->execute();
    }

    public static function deleteSubscribeProg($idu, $idp)
    {
        $s = self::$_db->prepare('DELETE FROM abonnement WHERE id_ems= :idp AND id_user = :idu');
        $s->bindValue(':idp', $idp, PDO::PARAM_INT);
        $s->bindValue(':idu', $idu, PDO::PARAM_INT);
        $s->execute();
    }

    public static function getSubscriptions($idUser)
    {
        $s = self::$_db->prepare('SELECT id_ems FROM abonnement WHERE id_user = :idUser');
        $s->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = ($data['id_ems']);
        }
        return $res;
    }
}