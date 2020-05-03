<?php
$bdd = new PDO('mysql:host=localhost;dbname=user','root','root');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
	$getid = intval($_GET['id']);
	$requete = $bdd -> prepare('SELECT * FROM membre WHERE id = ?');
	$requete -> execute(array($getid));
	$userinfo = $requete -> fetch();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h2>Profil de <?php echo $userinfo['pseudo']; ?> </h2>
		<br/>
		Pseudo = <?php echo $userinfo['pseudo']; ?>;
		<br/>
		Mail = <?php echo $userinfo['mail']; ?>;
		<br/>
		<?php
		if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
		{
		?>
		<a href="deconnexion.php"> Se déconnecter </a>
		<?php
		}
		?>
		
	</div>
</body>
</html>
<?php
}
?>




