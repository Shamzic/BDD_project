<?php

require_once 'base.php';

class User extends Model_Base
{
	private $_id;
	private $_login;
	private $_mdp;

	public function __construct($id,$l,$pw) {
		$this->setId($id);
		$this->setLogin($l);
		$this->setMdp($pw);
	}

	public function getId() {
		return $this->_id;
	}

	public function setId($v) {
		$this->_id = (int) $v;
	}
	public function getLogin() {
		return $this->_login;
	}

	public function setLogin($l) {
		if (is_string($l))
		{
			$this->_login = $l;
		}
		else
		{
			$this->_login = '';
		}
	}
	
	public function getMdp() {
		return $this->_mdp;
	}

	public function setMdp($pw) {
		if (is_string($pw))
		{
			$this->_mdp = $pw;
		}
		else
		{
			$this->_mdp = '';
		}
	}
	
	/**
	 * \brief Permet d'éditer les données d'un utilisateur
	 * \details Exécute une requête SQL qui met à jour les données d'un utilisateur d'id correspondant à l'id de l'instance appelante
	 * \param l Nouveau login de l'utilisateur
	 * \param pw Nouveau mot de passe de l'utilisateur
	 */

	public function save($l,$pw)
	{
		if(!is_null($this->_id)) {
			$q = self::$_db->prepare('UPDATE utilisateur SET login_user = :l, mdp_user = :pw WHERE id_user = :id');
			$q->bindValue(':l',$l, PDO::PARAM_STR);
			$q->bindValue(':pw',$pw, PDO::PARAM_STR);
			$q->bindValue(':id', $this->_id, PDO::PARAM_INT);
			$q->execute();
		}
	}
	
	/**
	 * \brief Permet de supprimer un utilisateur
	 * \details Exécute une requête SQL qui supprime l'utilisateur d'id correspondant à l'id de l'instance appelante
	 */

	public function delete()
	{
		if(!is_null($this->_id)) {
			$q = self::$_db->prepare('DELETE FROM utilisateur WHERE id_user = :id');
			$q->bindValue(':id', $this->_id, PDO::PARAM_INT);
			$q->execute();
			$this->_id = null;
		}
	}
	
	/**
	 * \brief Récupère un utilisateur à partir de son login
	 * \details Effectue une requête SQL pour récupérer la ligne de l'utilisateur du login passé en paramètre
	 * \param login Login de l'utilisateur 
	 * \return Renvoie une instance de la classe User si le login existe, null sinon
	 */

	public static function get_by_login($login) {
		$s = self::$_db->prepare('SELECT id_user,login_user,mdp_user FROM utilisateur WHERE login_user= :l'); //id_user,login_user,mdp_user
		$s->bindValue(':l', $login, PDO::PARAM_STR);
		$s->execute();
		$data = $s->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			echo $data['login_user'];
			echo $data['mdp_user'];

			return new User(
				$data['id_user'],
				$data['login_user'],
				$data['mdp_user']
			);
		} else {
			return null;
		}
	}
	
	/*
	 * \brief Récupère un utilisateur à partir de son id
	 * \details Effectue une requête SQL pour récupérer la ligne de l'utilisateur d'id passé en paramètre
	 * \param id Identifiant de l'utilisateur 
	 * \return Renvoie une instance de la classe User si l'id existe, null sinon
	 */

	public static function get_by_id($id) {
		$s = self::$_db->prepare('SELECT id_user,login_user,mdp_user FROM utilisateur WHERE id_user = :id');
		$s->bindValue(':id', $id, PDO::PARAM_INT);
		$s->execute();
		$data = $s->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			return new User(
				$data['id_user'],
				$data['login_user'],
				$data['mdp_user']
			);
		} else {
			return null;
		}
	}
	
	/**
	 * \brief Création d'un nouvel utilisateur dans la base de données
	 * \details Effectue une requête SQL qui insère un nouvel utilisateur dans la table Users
	 * \param l Login du nouvel utilisateur
	 * \param pw Mot de passe haché du nouvel utilisateur
	 */
	
	public static function newUser($l,$pw)
	{
		$q = self::$_db->prepare('INSERT INTO utilisateur (login_user,mdp_user) VALUES (:l,:pw)');
		$q->bindValue(':l',$l, PDO::PARAM_STR);
		$q->bindValue(':pw',$pw, PDO::PARAM_STR);
		$q->execute();
	}
}
