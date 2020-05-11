<?php
    if(isset($_GET['action'])){
        $page = $_GET['action'];
    }elseif(count($_GET) == 0){
        $page = 'index';
    }
    switch ($page) {
        case 'index':
            include('./vue/accueil_intmarket.html');
            break;
        case 'formulaire_connexion':
            include('./vue/formulaire_connexion.html');
            break;
        case 'formulaire_inscription':
            include('./vue/formulaire_inscription.html');
            break;
            case 'back_end':
            include('./controller/back_end.php');
            break;
            case 'afficher_categorie':
                include('./controller/afficher_categorie.php');
                break;
        default:
            include('./controller/erreur.php');
            break;
    }
?>