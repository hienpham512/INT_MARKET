<?php

$bdd = new PDO('mysql:host=localhost;dbname=mydb','root','root');

if(isset($_POST['inscris']))
{
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail1']) AND !empty($_POST['password']) AND !empty($_POST['password2']) )
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail1 = htmlspecialchars($_POST['mail1']);
		$password = sha1($_POST['password']);
		$password2 = sha1($_POST['password2']);

		if($mail == $mail1)
		{
			if(filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				if($password == $password2)
				{
					$insertmemebre = $bdd -> prepare ("INSERT INTO membre (pseudo, mail, password) VALUES(?, ?, ?)");
					$insertmemebre -> execute(array($pseudo, $mail, $password));
					$erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
				}
				else 
				{
				$erreur = "Vos mots de passes ne correspondent pas ! ";
				}
			}
			else
			{
				$erreur = "Votre adresse mail n'est pas valide";
			}
		}
		else
		{
			$erreur = "Vos adresses mail ne correspondent pas !";
		}
	}
	else {
		$erreur = "Tous les champs doivent etre complétés !";
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
		<h2>Inscription</h2>
		<br/>
		<form method="POST" action="">
		<table>
		<tr>
		<td>	
			<label>Pseudo : </label>
		</td>
		<td>
			<input type="text" id="pseudo" name="pseudo" placeholder="pseudo"/>
		</td>
		</tr>
		<tr>
		<td>	
			<label>Mail : </label>
		</td>
		<td>
			<input type="text" id="mail" name="mail" placeholder="mail"/>
		</td>
		</tr>
		<tr>
		<td>	
			<label>Confirmation du mail : </label>
		</td>
		<td>
			<input type="text" id="mail1" name="mail1" placeholder="confirmez votre mail "/>
		</td>
		</tr>
		<tr>
		<td>	
			<label>Mot de passe : </label>
		</td>
		<td>
			<input type="password" id="password" name="password" placeholder="mot de passe "/>
		</td>
		</tr>
			<tr>
		<td>	
			<label>Confirmation du mot de passe : </label>
		</td>
		<td>
			<input type="password" id="password2" name="password2" placeholder="confirmez votre mot de passe "/>
		</td>
		</tr>
		<tr>
			<td></td>
			<td align="center">
				<br/>
				<input type="submit" name="inscris" value="Je m'inscris"/></input>
			</td>
		</tr>
		</table>	
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