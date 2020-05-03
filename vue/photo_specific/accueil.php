<?php
echo "<html><head><title>accueil</title></head><body><table border='0' width='100%' ><tr><th class='left_logo' width='50%' height='650px'>
<img src='logo_2.png' width='50%'><th>";
if(!empty($_POST) || isset($_GET['erreur'])){
    $donne = $_POST;
    if (isset($_GET['erreur']) && $_GET['erreur'] == "case_vide"){
        $erreur = "ERREUR : Il faut remplir tous les cases!";
    }else if(isset($_GET['erreur']) && $_GET['erreur'] =='connexion'){
        $erreur = "ERREUR : l'username ou le mot de pass est invalible! ";
    }elseif (isset($_GET['erreur']) && $_GET['erreur'] =='email_pris'){
        $erreur = "ERREUR : le mail a été utilisé par un autre utilisateur!";
    }elseif (isset($_GET['erreur']) && $_GET['erreur'] =='comf_mdp'){
        $erreur = "ERREUR : La comfirmation de mot de pass n'est pas dupliqué!";
    }
    else{
        $erreur ='';
    }

    if(isset($donne['inscription']) || (isset($_GET['erreur']) && ($_GET['erreur'] == 'comf_mdp' || $_GET['erreur'] == 'email_pris' || $_GET['erreur'] == "case_vide"))){
        echo "<form action='../../index.php?action=inscription' method='POST'>";
        echo "<label class='nom_projet'><h1>I N T ' M A R K E T</h1></label>";
        echo "<p class='p'>Completer pour nous rejoindre, s'il vous plaît!</p>";
        echo "<h4 class='erreur'>$erreur</h4>";
        echo "<input type='text' name='nom'  placeholder='Nom' class='input' >             ";
        echo "<input type='text' name='prenom' placeholder='Prénom' class='input'><br>";
        echo "<input type='email' name='mail' placeholder='Email' class='input'><br>";
        echo "<input type='text' name='addresse' placeholder='Addresse' class='input'><br>";
        echo "<input type='password' name='mdp' placeholder='Mot de pass' class='input'><br>";
        echo "<input type='password' name='comf_mdp' placeholder='Comfirmer mot de pass' class='input'><br>";
        echo "<br><input type='submit' name='valider' value='valider' class='valider_btn'>";
        echo "</form>";
        echo "<br><br><br><form method='post'>
               <input type='hidden' name='connexion'>
               <a href='../../index.php?action=formulaire_connexion' class='retourner_btn'>Avez-vous déjà une compte? Connectez-vous.</a></form>";
    }
    if(isset($donne['connexion']) || (isset($_GET['erreur']) && $_GET['erreur'] == 'connexion')){
        echo "<form action= '../../index.php?action=connexion' method='post'>";
        echo "<h2>CONNEXION</h2>";
        echo "<h4>$erreur</h4>";
        echo "<label>username : </label><input type='email' name='mail'><br>";
        echo "<label>mot de pass : </label><input type='password' name='mdp'><br>";
        echo "<input type='submit' name='valider' value='valider' class='valider_btn'>";
        echo "</form>";
        echo "<br><br><br><form method='post'>
               <input type='hidden' name='connexion'><a href='../../index.php?action=formulaire_inscription' class='retourner_btn'>N'avez-vous pas une compte? Inscirez-vous.</a></form>";

    }

}
echo "</form></tr></table></body></html>";
?>