<?php
echo "<html><head><title>accueil</title></head><body><table border='1' text-align='center'><tr><td>";
$donne = $_POST;
if($donne || isset($_POST['erreur'])){
    if(isset($_POST['erreur']) && $_POST['erreur'] =='connexion'){
        $erreur = "ERREUR : l'username ou le mot de pass est invalible! ";
    }elseif (isset($_POST['erreur']) && $_POST['erreur'] =='username_pris'){
        $erreur = "ERREUR : username a été pris!";
    }elseif (isset($_POST['erreur']) && $_POST['erreur'] =='comf_password'){
        $erreur = "ERREUR : La comfirmation de mot de pass n'est pas dupliqué!";
    }else{
        $erreur ='';
    }
    if(isset($donne['connexion'])){
        echo "<form action= '../index.php?action=connexion' method='post'>";
        echo "<h2>CONNEXION</h2>";
        echo "<h4>$erreur</h4>";
        echo "<label>username : </label><input type='text' name='username'><br>";
        echo "<label>password : </label><input type='password' name='password'><br>";
        echo "<input type='submit' name='valider' value='valider'>";
        echo "<input type='hidden' name='connexion'></form>";

    }
    if(isset($donne['inscription'])){
        echo "<form action='../index.php?action=inscription' method='POST'>";
        echo "<h2>INSCRIPTION<h2>";
        echo "<h4>$erreur</h4>";
        echo "<label>username : </label><input type='text' name='username'><br>";
        echo "<label>email: </label><input type='text' name='email'><br>";
        echo "<label>password : </label><input type='password' name='password'><br>";
        echo "<label>comfirmer de password :</label><input type='password' name='comf_password'><br>";
        echo "<input type='submit' name='valider' value='valider'>";
        $create_time = date('H\hi');
        echo "<input type='hidden' name='create_time' value='$create_time'>";
        echo "<input type='hidden' name='inscription'></form>";
    }
    echo "<button><a href=''>retourner</a></button>";
}else{
    echo "<form action='' method='post'>";
    echo "<input type='submit' name='connexion' value='connexion'><br>";
    echo "<input type='submit' name='inscription' value='incription'>";
}
echo "</form></tr></table></body></html>";
?>