<?php
    if(isset($_GET['action'])){
        $page = $_GET['action'];
    }elseif(count($_GET) == 0){
        $page = 'index';
    }
    switch ($page) {
        case 'index':
            include('./vue/accueil_identifiant.html');
            break;
        case 'connexion':
            include ('./modele/connexion.php');
            break;
        case 'inscription':
            include ('./modele/inscription.php');
            break;
        case 'accueil_identifiant':
            include('./controller/accueil_identifiant.php');
            break;
        case 'formulaire_connexion':
            include('./vue/formulaire_connexion.html');
            break;
        case 'formulaire_inscription':
            include('./vue/formulaire_inscription.html');
            break;
        default:
            include('./controller/erreur.php');
            break;
    }
?>