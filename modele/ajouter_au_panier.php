<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    if(!empty($_POST) && isset($_SESSION['idUtilisateur'])){
        $idUtilisateur = $_SESSION['idUtilisateur'];
        $idArticle = $_POST['idArticle'];
        if(isset($_POST['categorie'])){
            $categorie = $_POST['categorie'];
            if(($_POST['categorie'] == 'femme') || ($_POST['categorie'] == 'enfant') || ($_POST['categorie'] == "homme")){
                $taille = $_POST["taille"];
            }else{
                $quantite = $_POST['quantite'];
            }

        }
        $donne = $bdd -> query("SELECT * FROM intmarket.article WHERE idArticle = '$idArticle' ");
        while ($trouve = $donne->fetch()) {
            if (isset($taille)) {
                $elt = "quantite_taille_" .$taille;
                $quantite_elt = (intval($trouve[$elt]) - 1);
                $nouveau_quantite = (intval($trouve['quantite']) - 1);
                $sql = "UPDATE intmarket.article SET $elt = $quantite_elt , quantite = $nouveau_quantite WHERE idArticle = $idArticle;";
            } elseif (isset($quantite)) {
                $nouveau_quantite = intval($trouve['quantite']) - intval($quantite);
                $sql = "UPDATE intmarket.article SET quantite = $nouveau_quantite WHERE idArticle = $idArticle; ";
            }
            if ($bdd->exec($sql) == true) {
                $status = "succes";
            } else {
                $status = "erreur";
            }
            if($status == "succes"){
                $donne = $bdd->query("SELECT * FROM intmarket.panier WHERE utilisateur_idUtilisateur = $idUtilisateur");
                while ($trouve = $donne->fetch()){
                    if(isset($taille)){
                        $idArticle_inserer = $trouve['idArticles'].",".$idArticle."-".$taille;
                    }elseif (isset($quantite)){
                        $idArticle_inserer = $trouve['idArticles'].",".$idArticle."-".$quantite;
                    }
                    $sql = "UPDATE intmarket.panier SET idArticles = '$idArticle_inserer' WHERE utilisateur_idUtilisateur = $idUtilisateur";
                    if ($bdd->exec($sql) == true) {
                        $status = "succes";
                    } else {
                        $status = "erreur";
                    }
                }
            }
            if($status == "erreur"){
                header('Status: 301 Moved Permanently', false, 301);
                header("Location: ../index.php?action=$categorie&article=".base64_encode($idArticle)."&erreur=invalide");
                exit();
            }else{
                header('Status: 301 Moved Permanently', false, 301);
                header("Location: ../index.php?action=$categorie&article=".base64_encode($idArticle)."");
                exit();
            }
        }

    }
?>