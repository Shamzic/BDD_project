<?php

require_once 'base.php';

class User extends Model_Base
{
    private $_id;
    private $_login;
    private $_mdp;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_dateN;
    private $_pays;
    private $_admin;

    public function __construct($id, $l, $pw, $n, $pr, $m, $d, $pa, $admin)
    {
        $this->setId($id);
        $this->setLogin($l);
        $this->setMdp($pw);
        $this->setNom($n);
        $this->setPrenom($pr);
        $this->setMail($m);
        $this->setDateN($d);
        $this->setPays($pa);
        $this->setAdmin($admin);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($v)
    {
        $this->_id = (int)$v;
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function setLogin($l)
    {
        if (is_string($l)) {
            $this->_login = $l;
        } else {
            $this->_login = '';
        }
    }

    public function getMdp()
    {
        return $this->_mdp;
    }

    public function setMdp($pw)
    {
        if (is_string($pw)) {
            $this->_mdp = $pw;
        } else {
            $this->_mdp = '';
        }
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($n)
    {
        if (is_string($n)) {
            $this->_nom = $n;
        } else {
            $this->_nom = '';
        }
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function setPrenom($pr)
    {
        if (is_string($pr)) {
            $this->_prenom = $pr;
        } else {
            $this->_prenom = '';
        }
    }

    public function getMail()
    {
        return $this->_mail;
    }

    public function setMail($m)
    {
        if (is_string($m)) {
            $this->_mail = $m;
        } else {
            $this->_mail = '';
        }
    }

    public function getDateN()
    {
        return $this->_dateN;
    }

    public function setDateN($d)
    {
        if (is_string($d)) {
            $this->_dateN = $d;
        } else {
            $this->_dateN = '';
        }
    }

    public function getPays()
    {
        return $this->_pays;
    }

    public function setPays($pa)
    {
        if (is_string($pa)) {
            $this->_pays = $pa;
        } else {
            $this->_pays = '';
        }
    }

    public function getIsAdmin()
    {
        return $this->_admin;
    }

    public function setAdmin($admin)
    {
        $this->_admin = $admin;
    }

    /**
     * \brief Permet d'�diter les donn�es d'un utilisateur
     * \details Ex�cute une requ�te SQL qui met � jour les donn�es d'un utilisateur d'id correspondant � l'id de l'instance appelante
     * \param l Nouveau login de l'utilisateur
     * \param pw Nouveau mot de passe de l'utilisateur
     */

    public function save($l, $pw)
    {
        if (!is_null($this->_id)) {
            $q = self::$_db->prepare('UPDATE utilisateur SET login_user = :l, mdp_user = :pw WHERE id_user = :id');
            $q->bindValue(':l', $l, PDO::PARAM_STR);
            $q->bindValue(':pw', $pw, PDO::PARAM_STR);
            $q->bindValue(':id', $this->_id, PDO::PARAM_INT);
            $q->execute();
        }
    }

    /**
     * \brief Permet de supprimer un utilisateur
     * \details Ex�cute une requ�te SQL qui supprime l'utilisateur d'id correspondant � l'id de l'instance appelante
     */

    public function delete()
    {
        if (!is_null($this->_id)) {
            $q = self::$_db->prepare('DELETE FROM utilisateur WHERE id_user = :id');
            $q->bindValue(':id', $this->_id, PDO::PARAM_INT);
            $q->execute();
            $this->_id = null;
        }
    }

    /**
     * \brief R�cup�re un utilisateur � partir de son login
     * \details Effectue une requ�te SQL pour r�cup�rer la ligne de l'utilisateur du login pass� en param�tre
     * \param login Login de l'utilisateur
     * \return Renvoie une instance de la classe User si le login existe, null sinon
     */

    public static function get_by_login($login)
    {
        $s = self::$_db->prepare('SELECT * FROM utilisateur WHERE login_user= :l'); //id_user,login_user,mdp_user
        $s->bindValue(':l', $login, PDO::PARAM_STR);
        $s->execute();
        $data = $s->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new User(
                $data['id_user'],
                $data['login_user'],
                $data['mdp_user'],
                $data['nom_user'],
                $data['prenom_user'],
                $data['mail_user'],
                $data['dateNaiss_user'],
                $data['pays'],
                $data['boolAdmin_user']
            );
        } else {
            return null;
        }
    }

    /*
     * \brief R�cup�re un utilisateur � partir de son id
     * \details Effectue une requ�te SQL pour r�cup�rer la ligne de l'utilisateur d'id pass� en param�tre
     * \param id Identifiant de l'utilisateur
     * \return Renvoie une instance de la classe User si l'id existe, null sinon
     */

    public static function get_by_id($id)
    {
        $s = self::$_db->prepare('SELECT * FROM utilisateur WHERE id_user = :id');
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new User(
                $data['id_user'],
                $data['login_user'],
                $data['mdp_user'],
                $data['nom_user'],
                $data['prenom_user'],
                $data['mail_user'],
                $data['dateNaiss_user'],
                $data['pays'],
                $data['boolAdmin_user']
            );
        }
        return $res;
    }

    /**
     * \brief Cr�ation d'un nouvel utilisateur dans la base de donn�es
     * \details Effectue une requ�te SQL qui ins�re un nouvel utilisateur dans la table Users
     * \param l Login du nouvel utilisateur
     * \param pw Mot de passe hach� du nouvel utilisateur
     */

    public static function newUser($l, $pw, $n, $pr, $m, $d, $pa, $admin)
    {
        $q = self::$_db->prepare('INSERT INTO utilisateur (login_user,mdp_user,nom_user,prenom_user,mail_user,dateNaiss_user,pays,boolAdmin_user) VALUES (:l,:pw,:n,:pr,:m,:d,:pa, :admin)');
        $q->bindValue(':l', $l, PDO::PARAM_STR);
        $q->bindValue(':pw', $pw, PDO::PARAM_STR);
        $q->bindValue(':n', $n, PDO::PARAM_STR);
        $q->bindValue(':pr', $pr, PDO::PARAM_STR);
        $q->bindValue(':m', $m, PDO::PARAM_STR);
        $q->bindValue(':d', $d, PDO::PARAM_STR);
        $q->bindValue(':pa', $pa, PDO::PARAM_STR);
        $q->bindValue(':admin', $admin, PDO::PARAM_STR);
        $q->execute();
    }

    public static function getUsers()
    {
        $s = self::$_db->prepare('SELECT * FROM utilisateur');
        $s->execute();
        $res = array();
        while ($data = $s->fetch(PDO::FETCH_ASSOC)) {
            $res[] = new User(
                $data['id_user'],
                $data['login_user'],
                $data['mdp_user'],
                $data['nom_user'],
                $data['prenom_user'],
                $data['mail_user'],
                $data['dateNaiss_user'],
                $data['pays'],
                $data['boolAdmin_user']
            );
        }
        return $res;
    }

    public static function deleteUser($idu)
    {
        $s = self::$_db->prepare('DELETE FROM utilisateur WHERE id_user = :idu');
        $s->bindValue(':idu', $idu, PDO::PARAM_INT);
        $s->execute();

    }

    public static function updateUsr($id, $name, $surname, $login, $password, $mail, $country)
    {
        $q = self::$_db->prepare('UPDATE utilisateur SET nom_user=:name, prenom_user=:surname, login_user=:login, mdp_user=:password, mail_user =:mail, pays=:country WHERE id_user=:id');
        $q->bindValue(':id', $id, PDO::PARAM_STR);
        $q->bindValue(':name', $name, PDO::PARAM_STR);
        $q->bindValue(':surname', $surname, PDO::PARAM_STR);
        $q->bindValue(':login', $login, PDO::PARAM_STR);
        $q->bindValue(':password', $password, PDO::PARAM_STR);
        $q->bindValue(':mail', $mail, PDO::PARAM_STR);
        $q->bindValue(':country', $country, PDO::PARAM_STR);
        $q->execute();
    }
}
