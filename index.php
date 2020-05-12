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
            // eyal----------------------------------------------------------------------------------------------------
        case 'back_endd':
                include('./eyal/back_endd.php');
                break;
        case 'commande':
                    include('./eyal/commande.php');
                    break;
        case 'categorie':
                include('./eyal/categorie.php');
                break;
        case 'article':
                    include('./eyal/article.php');
                    break;
        case 'utilisateur':
                    include('./eyal/utilisateur.php');
                    break;
        case 'utilisateur':
                    include('./eyal/utilisateur.php');
                    break;
         case 'ajouter_categorie':
                    include('./eyal/ajouter_categorie.php');
                    break;
        case 'ajouter_article':
                        include('./eyal/ajouter_article.php');
                        break;
                        case 'sup_categorie':
                            include('./eyal/sup_categorie.php');
                            break;
            // fin eyal ---------------------------------------------------------------------------------------------------
        default:
            include('./controller/erreur.php');
            break;
    }
?>