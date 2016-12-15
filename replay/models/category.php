<?php

require_once 'base.php';

class Category extends Model_Base
{
    private $_id;
    private $_name;
    private $_image;

    public function __construct ($id,$category_name, $category_img)
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
        $this->_id = (int) $id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($category_name)
    {
        if (is_string($category_name))
        {
            $this->_name = $category_name;
        }
        else
        {
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
        while ($data = $s->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = new Category($data['id_categorie'],$data['nom_categorie'],$data['category_image']);
        }
        return $res;
    }

    /**
     * \brief Permet de r�cup�rer la note dont l'id est pass� en param�tre
     * \details Effectue une requ�te SQL qui s�lectionne l'unique ligne de la table Notes o� l'id de la note est �gal � l'id pass� en param�tre
     * \param id Identifiant de la note recherch�e
     * \return Renvoie une instance de la classe Note
     */

    public static function getById($id)
    {
        $s = self::$_db->prepare('SELECT * FROM Notes WHERE id_note = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $data = $s->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Note(
                $data['id_note'],
                $data['titre'],
                $data['Image'],
                $data['auteur']
            );
        } else {
            return null;
        }
    }

    public static function deletecategorie($id)
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


}