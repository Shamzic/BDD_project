<?php

require_once 'base.php';

class Note extends Model_Base
{
	private $_id;
	private $_titre;
	private $_texte;
	private $_auteur;
		
	public function __construct ($id,$titre,$texte,$auteur)
	{
		$this->setId($id);
		$this->setTitre($titre);
		$this->setTexte($texte);
		$this->setAuteur($auteur);
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setId($id)
	{
		$this->_id = (int) $id;
	}
	
	public function getTitre()
	{
		return $this->_titre;
	}
	
	public function setTitre($titre)
	{
		if (is_string($titre))
		{
			$this->_titre = $titre;
		}
		else
		{
			$this->_titre = '';
		}
	}
	
	public function getTexte()
	{
		return $this->_texte;
	}
	
	public function setTexte($texte)
	{
		if (is_string($texte))
		{
			$this->_texte = $texte;
		}
		else
		{
			$this->_texte = '';
		}
	}
	
	public function getAuteur()
	{
		return $this->_auteur;
	}
	
	public function setAuteur($auteur)
	{
		$this->_auteur = (int) $auteur;
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
		$q->bindValue(':u',$uid, PDO::PARAM_INT);
		$q->bindValue(':n',$this->getId(), PDO::PARAM_INT);
		$q->execute();
		$data = $q->fetch(PDO::FETCH_ASSOC);
		return ($data['nb'] == 1);
	}
	
	/**
	 * \brief Permet de r�cup�rer toutes les notes cr��es par un utilisateur
	 * \details Effectue une requ�te SQL qui s�lectionne toutes les lignes de la table Notes o� l'auteur est �gal � l'id de l'utilisateur
	 * \param uid Identifant de l'utilisateur
	 * \return Renvoie un tableau compos� d'instances de Note
	 */
	
	public static function getByAuteur($uid)
	{
		$s = self::$_db->prepare('SELECT * FROM Notes WHERE auteur = :a');
		$s->bindValue(':a', $uid, PDO::PARAM_INT);
		$s->execute();
		$res = array();
		while ($data = $s->fetch(PDO::FETCH_ASSOC))
		{
			$res[] = new Note($data['id_note'],$data['titre'],$data['texte'],$data['auteur']);
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
				$data['texte'],
				$data['auteur']
			);
		} else {
			return null;
		}
	}
	
	/**
	 * \brief Permet de cr�er une nouvelle note dans la base de donn�es
	 * \details Effectue une requ�te d'insertion dans la table Notes
	 * \param titre Titre de la note � ajouter
	 * \param texte Texte de la note � ajouter
	 */
	
	public static function newNote($titre,$texte)
	{
		$q = self::$_db->prepare('INSERT INTO Notes VALUES (null,:t,:te,:a)');
		$q->bindValue(':t',$titre, PDO::PARAM_STR);
		$q->bindValue(':te',$texte, PDO::PARAM_STR);
		$q->bindValue(':a',$_SESSION['uid'], PDO::PARAM_INT);
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
	
	public static function save($titre,$texte,$id)
	{
		$s = self::$_db->prepare('UPDATE Notes SET titre = :ti, texte = :te WHERE id_note = :i');
		$s->bindValue(':ti',$titre,PDO::PARAM_STR);
		$s->bindValue(':te',$texte,PDO::PARAM_STR);
		$s->bindValue(':i',$id, PDO::PARAM_INT);
		$s->execute();
	}
}