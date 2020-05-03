<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=intmarket','root','root');

if(isset($_POST)){
    $donne = $_POST;
}
var_dump($donne);

if(isset($donne['valider'])){
    $mail = $donne['mail'];
    $mdp = $donne['mdp'];
    $reponde = $bdd->query("SELECT mail,mdp FROM intmarket.utilisateur");
    while($trouve = $reponde->fetch()){
        if($donne['mail'] == $trouve['mail'] && $donne['mdp'] == $trouve['mdp']){
            $connexion = true;
            $id_utilisateur = $trouve['idUtilisateur'];
            break;
        }else{
            $connexion = false;
            $id_utilisateur = '';
        }
    }
    if($connexion == false){
        header('location: ../index.php?action=formulaire_connexion&erreur=connexion');
    }else{
        $_SESSION['utilisateur_courant'] = $id_utilisateur;
        header('location: ../index.php');
    }
}else{
    header("location: ../index.php?action=formulaire_connexion");
}
?>