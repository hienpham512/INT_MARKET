<?php
    if(isset($_GET['action'])){
        $page = $_GET['action'];
    }elseif(count($_GET) == 0){
        $page = 'index';
    }
    switch ($page) {

        case 'index':
            include('./controller/accueil.php');
            break;
        default:
            include('./controller/erreur.php');
            break;
    }
?>