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
        case 'backend':
            include('./vue/formulaire_afficher_backend.html');
            break;
        case 'homme':
            include('./vue/affiche.html');
            break;
        case 'animal_nouriture':
            include('./vue/animal_nouriture.html');
            break;
        case 'votre_compte':
            include('./vue/profil_utilisateur_courant.html');
            break;
        default:
            include('./controller/erreur.php');
            break;
    }
?>