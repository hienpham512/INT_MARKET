
<?php
	if(isset($_GET["idCategorie"]))
	{
		$id = $_GET["idCategorie"];
		if(!empty($id) && is_numeric($id))
		{
			include("connexionn.php");
			$query = "delete from categorie where idCategorie=$id";
			$bdd -> exec($query);
			header("Location: ../index.php?action=categorie");
		}
	}
?>