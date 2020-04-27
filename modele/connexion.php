<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=user','root','root');

if(isset($_POST['formconnect']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$passwordconnect = sha1($_POST['passwordconnect']);
	if(!empty($mailconnect) AND !empty($passwordconnect))
	{
		$requete = $bdd -> prepare("SELECT * FROM membre WHERE mail= ? AND password = ? ");
		$requete -> execute (array ($mailconnect, $passwordconnect));
		$userexist = $requete -> rowcount();
		if($userexist == 1)
		{
			$userinfo = $requete -> fetch();
			$_SESSION["id"] = $userinfo["id"];
			$_SESSION["pseudo"] = $userinfo["pseudo"];
			$_SESSION["mail"] = $userinfo["mail"];
			$_SESSION["password"] = $userinfo["password"];
			header("Location: profil.php?id=".$_SESSION['id']);

		}
		else
		{
			$erreur = "Mauvais mail ou mot de passe";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent etre complétés ! ";
	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>inscription</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h2>Connexion</h2>
		<br/>
		<form method="POST" action="">
			<input type="email" name="mailconnect" placeholder="Mail"/>
			<input type="password" name="passwordconnect" placeholder="mot de passe"/>
			<input type="submit" name="formconnect" value="Se connecter !">

		</form>
		<?php
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur."</font>";
			}
		?>
	</div>
</body>
</html>