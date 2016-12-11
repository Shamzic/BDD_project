<?php

require_once 'models/user.php';

class Controller_User
{
	/**
	 * \brief Cette méthode permet la connexion d'un utilisateur
	 * \details Si l'utilisateur arrive en GET et qu'il est connecté, on affiche une erreur, sinon on affiche la vue de connexion (formulaire)
	 * \details Si l'utilisateur arrive en POST, on traite les données du formulaire, on vérifie que le login existe puis on teste la correspondance avec le mot de passe. Si ce dernier est bon, on stocke son login et son id dans des variables de session, sinon on affiche une erreur.
	 */
	
	public function connexion() {
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET' :
				if (isset($_SESSION['user'])) {
					$error_message = "Vous êtes déjà connectés en tant que ".$_SESSION['user'];
					include 'views/error.php';
				} else {
					include 'views/connexion.html';
				}
				break;

			case 'POST' :
				if (isset($_POST['login']) && isset($_POST['pw'])) {
					$login = htmlspecialchars($_POST['login']);
					$pw = htmlspecialchars($_POST['pw']);
					$u = User::get_by_login($login);
					if (!is_null($u)) {
						echo ' login : '.$login;
						echo ' get_by_login : '.$u->getLogin();
						echo ' get_by_login mdp hashed : '.$u->getMdp();
						echo ' hash pw : '.hash('md5',$pw);


						if ($u->getMdp() == hash('md5',$pw))
						{
							$_SESSION['user'] = $login;
							$_SESSION['uid'] = $u->getId();
							header('Location: index.php?ctrl=video&action=showVideos');
							exit();
						}
						else
						{
							$error_message = "Combinaison login/mot de passe incorrecte !";
							include 'views/error.php';
						}
					}
					else
					{
						$error_message = "Ce login n'existe pas !";
						include 'views/error.php';
					}
				} else {
					$error_message = "Données postées incomplètes";
					include 'views/error.php';
				}
				break;
		}	
	}

	/**
	 * \brief Cette méthode permet à un utilisateur de s'inscrire
	 * \details Si l'utilisateur arrive en GET et qu'il est connecté, on le redirige vers la page d'accueil, sinon on affiche la vue d'inscription (formulaire)
	 * \details Si l'utilisateur arrive en POST, on traite les données du formulaire : on vérifie qu'aucun des champs ne soit vide puis on teste la correspondance entre les deux mots de passe. Si les deux mots de passe entrés sont identiques, on vérifie que le login entré n'est pas déjà utilisé. Si ce n'est pas le cas, on ajoute l'utilisateur à la base de données.
	 */
	
	public function inscription() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			if (!isset($_SESSION['user']))
			{
				include 'views/inscription.html';
			}
			else
			{
				header('Location: index.php');
			}
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if (isset($_POST['login']) && isset($_POST['pw']) && isset($_POST['pw2']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['dateN']) &&  isset($_POST['pays']) )
			{
				if ($_POST['login'] != '' && $_POST['pw'] != '' && $_POST['pw2'] != '' && $_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['mail'] != '' && $_POST['dateN'] != ''  && $_POST['pays'] != '')
				{
					$login = htmlspecialchars($_POST['login']);
					$mdp = hash('md5',htmlspecialchars($_POST['pw']));
					$mdp2 = hash('md5',htmlspecialchars($_POST['pw2']));
					$nom = htmlspecialchars($_POST['nom']);
					$prenom = htmlspecialchars($_POST['prenom']);
					$mail = htmlspecialchars($_POST['mail']);
					$dateN = htmlspecialchars($_POST['dateN']);
					$pays = htmlspecialchars($_POST['pays']);
					
					if ($mdp == $mdp2)
					{
						$u = User::get_by_login($login);
						if (is_null($u))
						{
							User::newUser($login,$mdp,$nom,$prenom,$mail,$dateN,$pays);
							$_SESSION['message'] = "Inscription réalisée avec succès !";
						}
						else
						{
							$error_message = "Login déjà utilisé !";
							include 'views/error.php';
						}
					}
					else
					{
						$error_message = "Les mots de passe ne correspondent pas !";
						include 'views/error.php';
					}
				}
				else
				{
					$error_message = "Tous les champs doivent être remplis !";
					include 'views/error.php';
				}
			}
			else
			{
				$error_message = "Données postées incomplètes";
				include 'views/error.php';
			}
		}
	}

	/**
	 * \brief Cette méthode permet à un utilisateur de consulter son profil et de modifier son login et/ou son mot de passe
	 * \details Si l'utilisateur n'est pas connecté, on le redirige vers la page d'accueil
	 * \details Si l'utilisateur arrive en GET et qu'il est connecté, on affiche la vue du profil, le champ "Login" étant déjà renseigné avec son login
	 * \details Si l'utilisateur arrive en POST, on traite les données du formulaire : on vérifie que le login n'est pas vide puis on vérifie que le mot de passe actuel renseigné est bien correct. Ensuite, on teste l'unicité du login renseigné puis on met à jour les données de l'utilisateur dans la base.
	 */
	
	public function profil()
	{
		if (isset($_SESSION['user']))
		{
			if ($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				$u = User::get_by_login($_SESSION['user']);
				include 'views/profil.php';
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$mdp2 = htmlspecialchars($_POST['pw2']);
				$u = User::get_by_login($_SESSION['user']);
				if ($u->getMdp() == hash('md5',$mdp2))
				{
					$mdp = htmlspecialchars($_POST['pw']);
					$newlogin = htmlspecialchars($_POST['login']);
					$u2 = User::get_by_login($newlogin);
					if ($newlogin != '')
					{
						if (is_null($u2) || $newlogin == $_SESSION['user'])
						{
							if ($mdp != '')
							{
								$newmdp = hash('md5',$mdp);
								$u->save($newlogin,$newmdp);
							}
							else
							{
								$u->save($newlogin,$u->getMdp());
							}
							$_SESSION['user'] = $newlogin;
							echo 'Login et/ou mot de passe modifié(s)!<br>';
						}
						else
						{
							$error_message = "Ce login est déjà utilisé !";
							include 'views/error.php';
						}
					}
					else
					{
						$error_message = "Le login ne peut être vide !";
						include 'views/error.php';
					}
				}
				else
				{	
					$error_message = "Le mot de passe actuel est faux !";
					include 'views/error.php';
				}
			}
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 * \brief Cette méthode permet à un utilisateur de se déconnecter
	 * \details Détruit la variable de session puis redirige l'utilisateur vers la page d'accueil
	 */
	
	public function deconnexion()
	{
		session_destroy();
		header('Location: index.php');
		exit();
	}	
}