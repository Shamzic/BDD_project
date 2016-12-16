<?php

require_once 'base.php';

class Category extends Model_Base
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

    public static function getCategories()
    {
        $s = self::$_db->prepare('SELECT * FROM categorie');
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Category($data['id_categorie'], $data['nom_categorie'], $data['category_image']);
        }
        return $res;
    }

    public static function getById($id)
    {
        $s = self::$_db->prepare('SELECT * FROM categorie WHERE id_categorie = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();

        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Category($data['id_categorie'], $data['nom_categorie'], $data['category_image']);
        }
        return $res;
    }

    public static function deleteCategory($id)
    {
        $s = self::$_db->prepare('DELETE FROM categorie WHERE id_categorie = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
    }

    public function saveCategorie($n)
    {
        if (!is_null($this->_id)) {
            $q = self::$_db->prepare('UPDATE categorie SET nom_categorie = :n WHERE id_user = :id');
            $q->bindValue(':n', $n, PDO::PARAM_STR);
            $q->bindValue(':id', $this->_id, PDO::PARAM_INT);
            $q->execute();
        }
    }

    public static function updateCat($id, $name)
    {
        $q = self::$_db->prepare('UPDATE categorie SET nom_categorie=:name WHERE id_categorie=:id');
        $q->bindValue(':id', $id, PDO::PARAM_STR);
        $q->bindValue(':name', $name, PDO::PARAM_STR);
        $q->execute();
    }

}