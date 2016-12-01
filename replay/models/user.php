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

	public function __construct($id,$l,$pw,$n,$pr,$m,$d,$pa) {
		$this->setId($id);
		$this->setLogin($l);
		$this->setMdp($pw);
		$this->setNom($n);
		$this->setPrenom($pr);
		$this->setMail($m);
		$this->setDateN($d);
		$this->setPays($pa);
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
	
	public function getNom() {
		return $this->_nom;
	}
	public function setNom($n) {
		if (is_string($n))
		{
			$this->_nom = $n;
		}
		else
		{
			$this->_nom = '';
		}
	}
	
	public function getPrenom() {
		return $this->_prenom;
	}
	public function setPrenom($pr) {
		if (is_string($pr))
		{
			$this->_prenom = $pr;
		}
		else
		{
			$this->_prenom = '';
		}
	}
	
	public function getMail() {
		return $this->_mail;
	}
	public function setMail($m) {
		if (is_string($m))
		{
			$this->_mail = $m;
		}
		else
		{
			$this->_mail = '';
		}
	}
	
	public function getDateN() {
		return $this->_dateN;
	}
	public function setDateN($d) {
		if (is_string($d))
		{
			$this->_dateN = $d;
		}
		else
		{
			$this->_dateN = '';
		}
	}
	
	public function getPays() {
		return $this->_pays;
	}
	public function setPays($pa) {
		if (is_string($pa))
		{
			$this->_pays = $pa;
		}
		else
		{
			$this->_pays = '';
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
				$data['pays']
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
	
	public static function newUser($l,$pw,$n,$pr,$m,$d,$pa)
	{
		$q = self::$_db->prepare('INSERT INTO utilisateur (login_user,mdp_user,nom_user,prenom_user,mail_user,dateNaiss_user,pays) VALUES (:l,:pw,:n,:pr,:m,:d,:pa)');
		$q->bindValue(':l',$l, PDO::PARAM_STR);
		$q->bindValue(':pw',$pw, PDO::PARAM_STR);
		$q->bindValue(':n',$n, PDO::PARAM_STR);
		$q->bindValue(':pr',$pr, PDO::PARAM_STR);
		$q->bindValue(':m',$m, PDO::PARAM_STR);
		$q->bindValue(':d',$d, PDO::PARAM_STR);
		$q->bindValue(':pa',$pa, PDO::PARAM_STR);
		$q->execute();
	}
}
