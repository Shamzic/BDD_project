<?php

require_once 'base.php';
require_once 'favorite.php';

class Video extends Model_Base
{
    private $_id;
    private $_titre;
    private $_texte;
    private $_auteur;
    private $_link;
    private $_idCat;

    public function __construct($id, $video_name, $video_img, $video_lnk, $idCat)
    {
        $this->setId($id);
        $this->setTitre($video_name);
        $this->setTexte($video_img);
        $this->setLink($video_lnk);
        $this->setIdCat($idCat);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = (int)$id;
    }

    public function getIdCat()
    {
        return $this->_idCat;
    }

    public function setIdCat($idCat)
    {
        $this->_idCat = (int)$idCat;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function setTitre($video_name)
    {
        if (is_string($video_name)) {
            $this->_titre = $video_name;
        } else {
            $this->_titre = '';
        }
    }

    public function getLink()
    {
        return $this->_link;
    }

    public function setLink($video_link)
    {
        if (is_string($video_link)) {
            $this->_link = $video_link;
        } else {
            $this->_link = '';
        }
    }

    public function getTexte()
    {
        return $this->_texte;
    }

    public function setTexte($video_img)
    {
        $this->_texte = $video_img;
    }

    public function getAuteur()
    {
        return $this->_auteur;
    }

    public function setAuteur($video_lnk)
    {
        $this->_auteur = $video_lnk;
    }

    /**
     * \brief Permet de savoir si une note est partag�e avec un utilisateur
     * \details Compte le nombre de lignes o� apparaissent la note en question et l'utilisateur dont l'id est pass� en param�tre
     * \param uid Identifiant de l'utilisateur
     * \return Renvoie vrai si la note est partag�e avec l'utilisateur dont l'id est pass� en param�tre, faux sinon
     */

    public function isSharedWith($uid)
    {
        $q = self::$_db->prepare('SELECT COUNT(*) AS nb FROM Partage WHERE Id_User = :u AND Id_Note = :n');
        $q->bindValue(':u', $uid, PDO::PARAM_INT);
        $q->bindValue(':n', $this->getId(), PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return ($data['nb'] == 1);
    }

    /**
     * \brief get all the videos
     * \return table of Video class
     */

    public static function getVideos()
    {
        $s = self::$_db->prepare('SELECT * FROM video');
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Video($data['id_vid'], $data['nom_vid'], $data['video_image'], null,$data['id_categ']);
        }
        return $res;
    }

    /**
     * \brief get the videos by category
     * \details query that select videos that have the category id
     * \param category id
     * \return table of Video class
     */

    public static function getByCategory($id)
    {
        $s = self::$_db->prepare('SELECT * FROM video WHERE id_categ = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $res = array();

        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Video($data['id_vid'], $data['nom_vid'], $data['video_image'],null, $data['id_categ']);
        }
        return $res;
    }

    /**
     * \brief get the favorites videos by user id
     * \details query that select video that are in favorite table
     * \param id of the user
     * \return instance of Video class
     */

    public static function getByFavorite($id)
    {
        $s = self::$_db->prepare('SELECT * FROM video WHERE id_vid in (SELECT id_vid FROM favoris WHERE id_user = :id)');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Video($data['id_vid'], $data['nom_vid'], $data['video_image'],null, $data['id_categ']);
        }
        return $res;
    }

    /**
     * \brief get the video by its video gave as argument
     * \details query that select video by its own id gave as argument
     * \param id of the video
     * \return instance of Video class
     */

    public static function getById($id)
    {
        $s = self::$_db->prepare('SELECT * FROM video WHERE id_vid = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Video($data['id_vid'], $data['nom_vid'], $data['video_image'], $data['video_link'],  $data['id_categ']);
        }
        return $res;
//        $data = $s->fetch(PDO::FETCH_ASSOC);
//		if ($data) {
//			return new Note(
//				$data['id_note'],
//				$data['titre'],
//				$data['texte'],
//				$data['auteur']
//			);
//		} else {
//			return null;
//		}
    }

      public static function getByRecommended($id)
    {
        $s = self::$_db->prepare('SELECT * FROM video WHERE id_vid in (SELECT id_vid FROM interesse WHERE id_user = :id)');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new Video($data['id_vid'], $data['nom_vid'], $data['video_image'],null, $data['id_categ']);
        }
        return $res;
    }


    /**
     * \brief Permet de cr�er une nouvelle note dans la base de donn�es
     * \details Effectue une requ�te d'insertion dans la table Notes
     * \param titre Titre de la note � ajouter
     * \param texte Texte de la note � ajouter
     */

    public static function newNote($video_name, $video_img)
    {
        $q = self::$_db->prepare('INSERT INTO Notes VALUES (null,:t,:te,:a)');
        $q->bindValue(':t', $video_name, PDO::PARAM_STR);
        $q->bindValue(':te', $video_img, PDO::PARAM_STR);
        $q->bindValue(':a', $_SESSION['uid'], PDO::PARAM_INT);
        $q->execute();
    }

    /**
     * \brief Permet de supprimer une note dans la base de donn�es
     * \details Effectue une requ�te SQL qui supprime une ligne dans la table Notes o� l'id de la note est �gal � l'id pass� en param�tre
     * \param id Identifiant de la note � supprimer
     */

    public static function deleteNote($id)
    {
        $s = self::$_db->prepare('DELETE FROM Notes WHERE id_note = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
    }

    /**
     * \brief Permet de mettre � jour une note dans la base de donn�es
     * \details Effectue une requ�te SQL qui met � jour la ligne dans la table Notes o� l'id de la note est �gal � l'id pass� en param�tre
     * \param titre Nouveau titre de la note
     * \param texte Nouveau texte de la note
     * \param id Identifant de la note � modifier
     */

    public static function save($video_name, $video_img, $id)
    {
        $s = self::$_db->prepare('UPDATE Notes SET titre = :ti, texte = :te WHERE id_note = :i');
        $s->bindValue(':ti', $video_name, PDO::PARAM_STR);
        $s->bindValue(':te', $video_img, PDO::PARAM_STR);
        $s->bindValue(':i', $id, PDO::PARAM_INT);
        $s->execute();
    }
}