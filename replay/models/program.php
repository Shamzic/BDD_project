<?php

require_once 'base.php';

class program extends Model_Base
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

    public static function getPrograms()
    {
        $s = self::$_db->prepare('SELECT * FROM emission');
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = new Program($data['id_ems'],$data['name'],$data['image']);
        }
        return $res;
    }
}