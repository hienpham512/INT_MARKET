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
            include('./vue/affichage_page_mode_homme.html');
            break;
        case 'femme':
            include('./vue/affichage_page_mode_femme.html');
            break;
        case 'enfant':
            include('./vue/affichage_page_mode_enfant.html');
            break;
        case 'alimentation':
            include('./vue/affichage_page_marche_alimentation.html');
            break;
        case 'pain':
            include('./vue/affichage_page_marche_pain.html');
            break;
        case 'boisson':
            include('./vue/affichage_page_marche_boisson.html');
            break;
        case 'boucherie':
            include('./vue/affichage_page_marche_boucherie.html');
            break;
        case 'salon':
            include('./vue/affichage_page_maison_loisir_salon.html');
            break;
        case 'cusine':
            include('./vue/affichage_page_maison_loisir_cusine.html');
            break;
        case 'salle_de_bain':
            include('./vue/affichage_page_maison_loisir_salle_de_bain.html');
            break;
        case 'materiaux':
            include('./vue/affichage_page_maison_loisir_materiaux.html');
            break;
        case 'loisir':
            include('./vue/affichage_page_maison_loisir_loisir.html');
            break;
        case 'nouriture':
            include('./vue/affichage_page_animal_nouriture.html');
            break;
        case 'accessoire':
            include('./vue/affichage_page_animal_accessoire.html');
            break;
        case 'votre_compte':
            include('./vue/profil_utilisateur_courant.html');
            break;
        default:
            include('./controller/erreur.php');
            break;
    }
?>