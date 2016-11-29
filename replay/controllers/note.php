<?php

require_once 'models/note.php';
require_once 'models/partage.php';
require_once 'models/user.php';

class Controller_Note
{
	/**
	 * \brief Cette méthode permet à un utilisateur de créer une notes
	 * \details Si l'utilisateur arrive en GET et est connecté, on affiche le formulaire de création de note (vue create_note)
	 * \details Si l'utilisateur arrive en POST, on traite les données du formulaire : si le titre n'est pas vide, on ajoute la note à la base de données puis on redirige l'utilisateur vers l'affichage de ses notes
	 */
	 
	public function createNote()
	{
		if (isset($_SESSION['user']))
		{
			switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'GET':
					include 'views/create_note.html';
					break;
				
				case 'POST':
					if (isset($_POST['titre']) && isset($_POST['txt']))
					{
						if ($_POST['titre'] != '')
						{
							$titre = htmlspecialchars($_POST['titre']);
							$texte = htmlspecialchars($_POST['txt']);
							Note::newNote($titre,$texte);
							$_SESSION['message'] = 'Note créée !';
							header('Location: index.php?ctrl=note&action=mesNotes');
							exit();
						}
						else
						{
							$error_message = "Le titre ne doit pas être vide !";
							include 'views/error.php';
						}
					}
					else
					{
						$error_message = "Données postées incomplètes !";
						include 'views/error.php';
					}
					break;
			}
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 * \brief Affiche les notes créées par l'utilisateur connecté
	 * \details Si l'utilisateur est connecté, on récupère toutes ses notes puis on les affiche grâce à la vue mes_notes, sinon on le redirige vers l'accueil
	 */
	
	public function mesNotes()
	{
		if (isset($_SESSION['user']))
		{
			$n = Note::getByAuteur($_SESSION['uid']);
			include 'views/videos.php';
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 * \brief Permet l'édition d'une note
	 * \details Si l'utilisateur est déconnecté, on le redirige vers l'accueil
	 * \details Si l'utilisateur est connecté et qu'il arrive en GET, on récupère l'id de la note passé dans l'url puis on vérifie si cette note existe et si l'utilisateur a le droit de l'éditer. S'il a le droit de l'éditer, on affiche un formulaire contenant les informations liées à la note que l'utilisateur peut modifier. S'il est l'auteur de la note, on affiche une vue permettant de partager la note avec d'autres utilisateurs.
	 * \details Si l'utilisateur est connecté et qu'il arrive en POST, on vérifie que le nouveau titre entré n'est pas vide puis on met à jour les données de la note en question dans la base. Enfin, on redirige l'utilisateur soit sur l'affichage de ses notes s'il était l'auteur de la note modifiée, soit sur l'affichage des notes partagées avec lui s'il n'était pas l'auteur de la note modifiée.
	 */
	
	public function editNote()
	{
		if (isset($_SESSION['user']))
		{
			switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'GET':
					if (isset($_GET['id']))
					{	
						$id = (int)$_GET['id'];
						$note = Note::getById($id);
						if (!is_null($note))
						{		
							if ($_SESSION['uid'] == $note->getAuteur() || $note->isSharedWith($_SESSION['uid']))
							{
								$u = Partage::getUsersByNote($note->getId());
								include 'views/edit_note.php';
								if ($_SESSION['uid'] == $note->getAuteur())
								{
									include 'views/share_note.php';
								}
							}
							else
							{
								$error_message = "Vous n'avez pas le droit d'éditer cette note !";
								include 'views/error.php';
							}
						}
						else
						{
							$error_message = "Cette note n'existe pas !";
							include 'views/error.php';
						}
					}
					else
					{
						$error_message = "Données dans l'url incomplètes !";
						include 'views/error.php';
					}
					break;
					
				case 'POST':
					if (isset($_POST['titre']) && isset($_POST['txt']))
					{
						if ($_POST['titre'] != '')
						{
							$titre = htmlspecialchars($_POST['titre']);
							$texte = htmlspecialchars($_POST['txt']);
							$nid = (int)$_GET['id'];
							Note::save($titre,$texte,$nid);
							if ($_SESSION['uid'] == Note::getById($nid)->getAuteur())
							{
								header('Location: index.php?ctrl=note&action=mesNotes');
								exit();
							}
							else
							{
								header('Location: index.php?ctrl=note&action=showsharedNotes');
								exit();
							}
						}
						else
						{
							$error_message = "Le titre ne doit pas être vide !";
							include 'views/error.php';
						}
					}
					else
					{
						$error_message = "Données postées incomplètes !";
						include 'views/error.php';
					}
					break;
			}	
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 * \brief Permet la suppression d'une note par son auteur
	 * \details Si l'utilisateur n'est pas connecté, on le redirige vers la page d'accueil
	 * \details Si l'utilisateur est connecté, on récupère l'id de la note à supprimer passé dans l'url puis on vérifie que la note existe et que l'utilisateur a le droit de la supprimer (s'il en est l'auteur). S'il a le droit de la supprimer, on la supprime de la base de données puis on le redirige vers l'affichage de ses notes.
	 */
	
	public function deleteNote()
	{
		if (isset($_SESSION['user']))
		{
			if (isset($_GET['id']))
			{	
				$id = (int)$_GET['id'];
				$note = Note::getById($id);
				if (!is_null($note))
				{
					if ($_SESSION['uid'] == $note->getAuteur())
					{
						Note::deleteNote($id);
						header('Location: index.php?ctrl=note&action=mesNotes');
						exit();
					}
					else
					{
						$error_message = "Vous n'avez pas le droit de supprimer cette note !";
						include 'views/error.php';
					}
				}
				else
				{
					$error_message = "Cette note n'existe pas !";
					include 'views/error.php';
				}
			}
			else
			{
				$error_message = "Données dans l'url incomplètes !";
				include 'views/error.php';
			}
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 * \brief Permet de partager une note avec d'autres utilisateurs
	 * \details Si l'utilisateur arrive en GET, il est redirigé vers la page d'accueil car le partage ne doit s'effectuer qu'après envoi du formulaire associé (vue share_note)
	 * \details Si l'utilisateur arrive en POST, on récupère l'id de la note à partager passé dans l'url puis on découpe la chaîne du champ share du formulaire en utilisant comme séparateur un "-". Pour chaque sous-chaîne récupérée, on enlève les espaces et on vérifie si le login existe dans la base de données. S'il existe, on ajoute une ligne dans la table Partage et on redirige l'utilisateur vers la page d'affichage de ses notes.
	 */
	
	public function shareNote()
	{
		switch($_SERVER['REQUEST_METHOD'])
		{
			case 'GET':
			header('Location: index.php');
			exit();
			break;
			
			case 'POST':
			$nid = $_GET['id'];
			if (Note::getById($nid)->getAuteur() == $_SESSION['uid'])
			{
				$share = htmlspecialchars($_POST['share']);
				$users = explode('-',$share);
				foreach($users as $u)
				{
					$u = trim($u);
					if ($u != $_SESSION['user'])
					{
						$user = User::get_by_login($u);
						if (!is_null($user))
						{
							Partage::shareNote($user->getId(),$nid);
						}
					}
				}
				header('Location: index.php?ctrl=note&action=mesNotes');
				exit();
			}
			else
			{
				$error_message = "Vous n'avez pas le droit de partager cette note !";
				include 'views/error.php';
			}
			break;
		}
	}
	
	/**
	 * \brief Permet de supprimer le partage d'une note avec un utilisateur
	 * \details Si l'utilisateur est déconnecté, il est redirigé vers la page d'accueil
	 * \details Si l'utilisateur est connecté, on récupère l'id de la note pour laquelle on veut supprimer le partage et l'id de l'utilisateur pour qui on doit supprimer le partage, tous deux passés dans l'url. Si la note existe et que l'utilisateur en est l'auteur, on supprime le partage de cette note avec l'utilisateur dont l'id est passé dans l'url.
	 */
	
	public function deleteShare()
	{
		if (isset($_SESSION['user']))
		{
			if (isset($_GET['nid']) && isset($_GET['uid']))
			{	
				$nid = (int)$_GET['nid'];
				$note = Note::getById($nid);
				if (!is_null($note))
				{		
					if ($_SESSION['uid'] == $note->getAuteur())
					{
						$uid = (int)$_GET['uid'];
						Partage::deleteShare($uid,$nid);
						header('Location: index.php?ctrl=note&action=mesNotes');
						exit();
					}
					else
					{
						$error_message = "Vous n'avez pas le droit de supprimer ce partage !";
						include 'views/error.php';
					}
				}
				else
				{
					$error_message = "Cette note n'existe pas !";
					include 'views/error.php';
				}
			}
			else
			{
				$error_message = "Données dans l'url incomplètes !";
				include 'views/error.php';
			}
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 * \brief Affichage les notes partagées avec l'utilisateur connecté
	 * \details Si l'utilisateur est déconnecté, il est redirigé vers la page d'accueil
	 * \details Si l'utilisateur est connecté, on récupère toutes les notes partagées avec lui puis on les affiche à l'aide de la vue shared_notes
	 */
	
	public function showSharedNotes()
	{
		if(isset($_SESSION['uid']))
		{
			$sharedNotesWithMe = Partage::getSharedNotes($_SESSION['uid']);
			include 'views/shared_notes.php';
		}
		else
		{
			header('Location: index.php');
		}
	}
}