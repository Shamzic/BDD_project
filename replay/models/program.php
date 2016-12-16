<?php

require_once 'base.php';

class Program extends Model_Base
{
    private $_id;
    private $_name;
    private $_image;
    private $_desc;

    public function __construct($id, $program_name, $program_img, $desc)
    {
        $this->setId($id);
        $this->setName($program_name);
        $this->setImage($program_img);
        $this->setDesc($desc);
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

    public function setName($program_name)
    {
        if (is_string($program_name)) {
            $this->_name = $program_name;
        } else {
            $this->_name = '';
        }
    }

    public function getDesc()
    {
        return $this->_desc;
    }

    public function setDesc($desc)
    {
        if (is_string($desc)) {
            $this->_desc = $desc;
        } else {
            $this->_desc = '';
        }
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function setImage($program_img)
    {
        $this->_image = $program_img;
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
            $res[] = new Program($data['id_ems'], $data['prog_name'], $data['image'], $data['description']);
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

    public static function getById($id)
    {
        $s = self::$_db->prepare('SELECT * FROM emission WHERE id_ems = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();

        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Program($data['id_ems'], $data['prog_name'], $data['image'], $data['description']);
        }
        return $res;
    }

    public static function deleteProgram ($id)
    {
        $s = self::$_db->prepare('DELETE FROM emission WHERE id_ems = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
    }

    public static function updateProg($id, $name, $desc)
    {
        $q = self::$_db->prepare('UPDATE emission SET prog_name=:name, description=:desc WHERE id_ems=:id');
        $q->bindValue(':id', $id, PDO::PARAM_STR);
        $q->bindValue(':name', $name, PDO::PARAM_STR);
        $q->bindValue(':desc', $desc, PDO::PARAM_STR);
        $q->execute();
    }

    public static function getSubscribeName($idUser)
    {
        $s = self::$_db->prepare('SELECT prog_name FROM emission WHERE id_ems IN (SELECT id_ems FROM abonnement WHERE id_user = :idUser )');
        $s->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = ($data['prog_name']);
        }
        return $res;
    }
}