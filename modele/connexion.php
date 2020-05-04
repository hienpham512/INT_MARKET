<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=intmarket','root','root');

if(isset($_POST)){
    $donne = $_POST;
}

if(isset($donne['valider'])){
    $mail = $donne['mail'];
    $mdp = $donne['mdp'];
    $reponde = $bdd->query("SELECT mail,mdp FROM intmarket.utilisateur");
    while($trouve = $reponde->fetch()){
        if($donne['mail'] == '' || $donne['mdp'] == '' ||$donne['comf_mdp'] == '' || $donne['nom'] == '' || $donne['addresse'] == ''|| $donne['nom'] == '' || $donne['prenom' == '']) {
            $erreur = "case_vide";
            $connexion = false;
            $id_utilisateur = '';
            break;
        }elseif($donne['mail'] == $trouve['mail'] && $donne['mdp'] == $trouve['mdp']){
            $connexion = true;
            $id_utilisateur = $trouve['idUtilisateur'];
            break;
        }else{
            $connexion = false;
            $erreur = "connexion";
            $id_utilisateur = '';
        }
    }
    if($connexion == false){
        header("location: ../index.php?action=formulaire_connexion&erreur=$erreur");
    }else{
        $_SESSION['utilisateur_courant'] = $id_utilisateur;
        header('location: ../index.php');
    }
}else{
    header("location: ../index.php?action=formulaire_connexion");
}
?>