<?php

require_once 'base.php';

class Partage extends Model_Base
{
	private $_Id_User;
	private $_Id_Note;
		
	public function __construct ($uid,$nid)
	{
		$this->setIdUser($uid);
		$this->setIdNote($nid);
	}
	
	public function getIdUser()
	{
		return $this->_Id_User;
	}
	
	public function setIdUser($uid)
	{
		$this->_Id_User = (int) $uid;
	}
	
	public function getIdNote()
	{
		return $this->_Id_Note;
	}
	
	public function setIdNote($nid)
	{
		$this->_Id_Note = (int) $nid;
	}
	
	/**
	 * \brief Renvoie les notes partagées avec un utilisateur donné
	 * \details Permet de récupérer toutes les informations d'une note ainsi que le login de l'auteur
	 * \param uid Identifiant de l'utilisateur 
	 * \return Renvoie un tableau associatif contenant l'id, le titre, le texte ainsi que le login de l'auteur de toutes les notes partagées avec l'utilisateur \a uid
	 */
	
	public static function getSharedNotes($uid)
	{
		try
		{
			self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$s = self::$_db->prepare('SELECT n.*, u.login FROM Partage p JOIN Notes n ON n.id_note = p.Id_Note JOIN Users u ON u.id = n.auteur WHERE p.Id_User = :a');
			$s->bindValue(':a', $uid, PDO::PARAM_INT);
			$s->execute();
			$res = array();
			while ($data = $s->fetch(PDO::FETCH_ASSOC))
			{
				$res[] = array('id' => $data['id_note'],'titre' => $data['titre'],'texte' => $data['texte'],'auteur' => $data['login']);
			}
			return $res;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * \brief Renvoie les utilisateurs avec qui une note donnée est partagée
	 * \details Permet de récupérer tous les logins des utilisateurs avec qui une note est partagée
	 * \param nid Identifiant de la note recherchée
	 * \return Renvoie un tableau associatif contenant le login et l'id de tous les utilisateurs avec qui la note \a nid a été partagée
	 */
	
	public static function getUsersByNote($nid)
	{
		try
		{
			self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$s = self::$_db->prepare('SELECT u.login, u.id FROM Partage p JOIN Notes n ON n.id_note = p.Id_Note JOIN Users u ON u.id = p.Id_User WHERE p.Id_Note = :n');
			$s->bindValue(':n', $nid, PDO::PARAM_INT);
			$s->execute();
			$res = array();
			while ($data = $s->fetch(PDO::FETCH_ASSOC))
			{
				$res[] = array('login' => $data['login'],'id' => $data['id']);
			}
			return $res;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	/**
	 * \brief Partage une note avec un utilisateur
	 * \details Insère une ligne dans la table Partage de la base de données à partir de l'id de l'utilisateur et de l'id de la note
	 * \param uid Identifiant de l'utilisateur avec qui la note va être partagée
	 * \param nid Identifiant de la note à partager
	 */
	
	public static function shareNote($uid,$nid)
	{
		$q = self::$_db->prepare('INSERT INTO Partage VALUES (:id,:n)');
		$q->bindValue(':id',$uid, PDO::PARAM_INT);
		$q->bindValue(':n',$nid, PDO::PARAM_INT);
		$q->execute();
	}
	
	/**
	 * \brief Supprime le partage d'une note avec un utilisateur
	 * \details Supprime une ligne dans la table Partage de la base de données à partir de l'id de l'utilisateur et de l'id de la note
	 * \param uid Identifiant de l'utilisateur pour lequel on doit supprimer le partage
	 * \param nid Identifiant de la note pour laquelle on doit supprimer le partage
	 */
	
	public static function deleteShare($uid,$nid)
	{
		$q = self::$_db->prepare('DELETE FROM Partage WHERE Id_User = :id AND Id_Note = :n');
		$q->bindValue(':id',$uid, PDO::PARAM_INT);
		$q->bindValue(':n',$nid, PDO::PARAM_INT);
		$q->execute();
	}
}