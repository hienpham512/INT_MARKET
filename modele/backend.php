<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');

if(isset($_POST) && isset($_SESSION['role']) && $_SESSION['role'] == 'administrateur'){
    //mettre le numéro pour les tables.
    if($_SESSION['table_courant'] == "article"){
        $table = 1;
    }elseif ($_SESSION['table_courant'] == "categorie"){
        $table = 2;
    }elseif ($_SESSION['table_courant'] == "commande"){
        $table = 3;
    }elseif ($_SESSION['table_courant'] == "utilisateur"){
        $table = 4;
    }
    echo "<br>";
    //si la table qu'il veux modifier est "article".
    if(isset($_POST['modifier']) && $_SESSION["table_courant"] == "article") {
        $imageArticle = "";
        $img_2 = "";
        $img_3 = "";
        $img_4 = "";
        $img_5 = "";
        //s'il y a eu déjà un photo dedans BDD
        $idArticle = intval($_POST['idArticle']);
        $donne = $bdd ->query("SELECT * FROM intmarket.article WHERE idArticle = '$idArticle'");
        while ($trouve = $donne->fetch() ){
            if($trouve['imageArticle'] !== ''){
                $imageArticle = addslashes($trouve['imageArticle']);
            }
            if ($trouve['img_2'] !== ''){
                $img_2 = addslashes($trouve['img_2']);
            }
            if ($trouve['img_3'] !== ''){
                $img_3 = addslashes($trouve['img_3']);
            }
            if ($trouve['img_4'] !== ''){
                $img_4 = addslashes($trouve['img_4']);
            }
            if ($trouve['img_5'] !== ''){
                $img_5 = addslashes($trouve['img_5']);
            }
        }
        //récupérer les photos sont ajouté par administrateur
        if(isset($_FILES['imageArticle']['tmp_name']) && $_FILES['imageArticle']['tmp_name'] !== ""){
            $imageArticle = file_get_contents($_FILES['imageArticle']['tmp_name']);
            $imageArticle = addslashes($imageArticle);
        }
        if (isset($_FILES['img_2']['tmp_name']) && $_FILES['img_2']['tmp_name'] !== ""){
            $img_2 = file_get_contents($_FILES['img_2']['tmp_name']);
            $img_2 = addslashes($img_2);
        }
        if (isset($_FILES['img_3']['tmp_name'])&& $_FILES['img_3']['tmp_name'] !== ""){
            $img_3 = file_get_contents($_FILES['img_3']['tmp_name']);
            $img_3 = addslashes($img_3);
        }
        if (isset($_FILES['img_4']['tmp_name'])&& $_FILES['img_4']['tmp_name'] !== ""){
            $img_4 = file_get_contents($_FILES['img_4']['tmp_name']);
            $img_4 = addslashes($img_4);
        }
        if (isset($_FILES['img_5']['tmp_name'])&& $_FILES['img_5']['tmp_name'] !== ""){
            $img_5 = file_get_contents($_FILES['img_5']['tmp_name']);
            $img_5 = addslashes($img_5);
        }

        $idArticle = intval($_POST['idArticle']);
        $nomArticle = $_POST['nomArticle'];
        $prixArticle = $_POST['prixArticle'];
        $descriptionArticle = $_POST['descriptionArticle'];

        $quantite = intval($_POST['quantite']);
        $categorie_idCategorie = intval($_POST['categorie_idCategorie']);
        $quantite_taille = array("xs","s","m","l","xl","xxl");
        for ($i = 0; $i< count($quantite_taille);$i++){
            $elt = "quantite_taille_".$quantite_taille[$i];
            if(isset($_POST[$elt])){
                $quantite_taille[$i] = intval($_POST[$elt]);
            }else{
                $quantite_taille[$i] = '';
            }
        }
        $type = $_POST['type'];

        $sql = "UPDATE intmarket.article SET nomArticle = '$nomArticle',
                             prixArticle = '$prixArticle',
                             descriptionArticle = '$descriptionArticle',
                             imageArticle = '$imageArticle',
                             img_2 = '$img_2',
                             img_3 = '$img_3',
                             img_4 = '$img_4',
                             img_5 = '$img_5',
                             quantite = '$quantite',
                             categorie_idCategorie = '$categorie_idCategorie',
                             type = '$type',
                            quantite_taille_xs = '$quantite_taille[0]',
                             quantite_taille_s = '$quantite_taille[1]',
                             quantite_taille_m = '$quantite_taille[2]',
                             quantite_taille_l = '$quantite_taille[3]',
                             quantite_taille_xl = '$quantite_taille[4]',
                             quantite_taille_xxl = '$quantite_taille[5]'
                            WHERE article.idArticle = '$idArticle';";

        //Verifier si la requete "update" a été correctement executée.
        if($bdd ->exec($sql) == true){
            $status = "succes";
        }else{
            $status = "erreur";
        }
//si la table qu'il veux modifier est "categorie".
    }elseif (isset($_POST['modifier']) && $_SESSION["table_courant"] == "categorie"){
        $idCategorie = intval($_POST['idCategorie']);
        $nomCategorie = $_POST['nomCategorie'];
        $typeCategorie = $_POST['typeCategorie'];

        //vérifier s'il a choisi correct le sousCategori avec nomCategorie
        $donne = $bdd ->query("SELECT * FROM intmarket.categorie");
        while ($trouve = $donne -> fetch()){
            if($trouve['idCategorie'] == $idCategorie){
                $sql = "UPDATE intmarket.categorie SET
                               nomCategorie = '$nomCategorie',
                               typeCategorie = '$typeCategorie'
                               WHERE categorie.idCategorie = '$idCategorie';";
                if($bdd ->exec($sql) == true){
                    $status = "succes";
                }else{
                    $status = "erreur";
                }
                break;
            }
        }
        //si la table qu'il veux modifier est "commande".
    }elseif (isset($_POST['modifier']) && $_SESSION["table_courant"] == "commande"){
        $idCommande = intval($_POST['idCommande']);
        $dateCommande = $_POST['dateCommande'];
        $utilisateur_idUtilisateur = intval($_POST['utilisateur_idUtilisateur']);
        $sql = "UPDATE intmarket.commande SET
                               dateCommande = '$dateCommande',
                               utilisateur_idUtilisateur = '$utilisateur_idUtilisateur'
                               WHERE commande.idCommande = '$idCommande';";
        if($bdd ->exec($sql) == true){
            $status = "succes";
        }else{
            $status = "erreur";
        }
        //si la table qu'il veux modifier est "utilisatuer".
    }elseif (isset($_POST['modifier']) && $_SESSION["table_courant"] == "utilisateur"){
        include("../controller/fct_analyser_mdp.php");
        $idUtilisateur = intval($_POST['idUtilisateur']);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];

        $mdp = chiffrer_mdp($_POST['mdp']);
        if($mdp == false){
            $status = "erreur";
            $erreur = "moin_de_6_carractere";
        }
        $role = $_POST['role'];
        $addresse = $_POST['addresse'];
        $dateDeNaissance = $_POST['dateDeNaissance'];
        $civilite = $_POST['civilite'];

        //verifier si le mail est été pris par un autre utilisateur.
        $donne = $bdd ->query("SELECT * FROM intmarket.utilisateur");
        while ($trouve = $donne ->fetch()){
            if($trouve['mail'] == $mail && intval($trouve['idUtilisateur']) !== intval($idUtilisateur)){
                $status = "erreur";
                $erreur = "mail";
                break;
            }
        }
        if($dateDeNaissance == ''){
            $sql = "UPDATE intmarket.utilisateur SET 
                                 civilite = '$civilite',
                                 nom = '$nom',
                                 prenom = '$prenom',
                                 mail = '$mail',
                                 mdp = '$mdp',
                                 addresse = '$addresse',
                                 role = '$role'
                                 WHERE utilisateur.idUtilisateur = '$idUtilisateur';";
        }else{
            $sql = "UPDATE intmarket.utilisateur SET 
                                 civilite = '$civilite',
                                 nom = '$nom',
                                 prenom = '$prenom',
                                 mail = '$mail',
                                 mdp = '$mdp',
                                 addresse = '$addresse',
                                 role = '$role',
                                 dateDeNaissance = '$dateDeNaissance'
                                 WHERE utilisateur.idUtilisateur = '$idUtilisateur';";
        }
        if (!isset($status)){
            if($bdd ->exec($sql) == true){
                $status = "succes";
            }else{
                $status = "erreur";
            }
        }
    }elseif (isset($_POST['supprimer']) && $_SESSION['table_courant'] == "article"){
        $idArticle = intval($_POST["idArticle"]);
        $sql = "DELETE FROM intmarket.article WHERE idArticle = '$idArticle';";
        if($bdd ->exec($sql) == true){
            $status = "succes";
        }else{
            $status = "erreur";
        }
        //il y a encore de faut , ne peut pas de supprimer, $idCategorie est tj 2.
    }elseif (isset($_POST['supprimer']) && $_SESSION['table_courant'] == "categorie"){
        $idCategorie = intval($_POST["idCategorie"]);
        $sql = "DELETE FROM intmarket.categorie WHERE idCategorie = '$idCategorie';";
        if($bdd ->exec($sql) == true){
            $status = "succes";
        }else{
            $status = "erreur";
        }
    }elseif (isset($_POST['supprimer']) && $_SESSION['table_courant'] == "commande"){
        $idCommande = intval($_POST["idCommande"]);
        $sql = "DELETE FROM intmarket.commande WHERE idCommande = '$idCommande';";
        if($bdd ->exec($sql) == true){
            $status = "succes";
        }else{
            $status = "erreur";
        }
    }elseif (isset($_POST['supprimer']) && $_SESSION['table_courant'] == "utilisateur"){
        $idUtilisateur = intval($_POST["idUtilisateur"]);
        $sql = "DELETE FROM intmarket.utilisateur WHERE idUtilisateur = '$idUtilisateur';";
        if($bdd ->exec($sql) == true){
            $bdd ->query($sql);
            $status = "succes";
        }else{
            $status = "erreur";
        }

    }elseif (isset($_POST['ajouter']) && $_SESSION['table_courant'] == 'article'){
        foreach ($_POST as $key => $value) {
            $value = str_split($value);
            $compteur = 0;
            for($i = 0; $i < count($value); $i++){
                if($value[$i] !== " " || $value[$i] !== "   "){
                    $compteur++;
                }
            }
            if($compteur == 0){
                $erreur = "case_vide";
                break;
            }
        }
        $imageArticle = "";
        $img_2 = "";
        $img_3 = "";
        $img_4 = "";
        $img_5 = "";

        if(!isset($erreur)){
            if(isset($_FILES['imageArticle']['tmp_name']) && $_FILES['imageArticle']['tmp_name'] !== ""){
                $imageArticle = file_get_contents($_FILES['imageArticle']['tmp_name']);
                $imageArticle = addslashes($imageArticle);
            }
            if (isset($_FILES['img_2']['tmp_name']) && $_FILES['img_2']['tmp_name'] !== ""){
                $img_2 = file_get_contents($_FILES['img_2']['tmp_name']);
                $img_2 = addslashes($img_2);
            }
            if (isset($_FILES['img_3']['tmp_name'])&& $_FILES['img_3']['tmp_name'] !== ""){
                $img_3 = file_get_contents($_FILES['img_3']['tmp_name']);
                $img_3 = addslashes($img_3);
            }
            if (isset($_FILES['img_4']['tmp_name'])&& $_FILES['img_4']['tmp_name'] !== ""){
                $img_4 = file_get_contents($_FILES['img_4']['tmp_name']);
                $img_4 = addslashes($img_4);
            }
            if (isset($_FILES['img_5']['tmp_name'])&& $_FILES['img_5']['tmp_name'] !== ""){
                $img_5 = file_get_contents($_FILES['img_5']['tmp_name']);
                $img_5 = addslashes($img_5);
            }


            $nomArticle = $_POST['nomArticle'];
            $prixArticle = $_POST['prixArticle'];
            $descriptionArticle = $_POST['descriptionArticle'];
            $quantite = intval($_POST['quantite']);
            $nomCategorie = $_POST['nomCategorie'];
            $typeCategorie = $_POST['typeCategorie'];
            $quantite_taille = array("xs","s","m","l","xl","xxl");
            for ($i = 0; $i< count($quantite_taille);$i++){
                $elt = "quantite_taille_".$quantite_taille[$i];
                if(isset($_POST[$elt])){
                    $quantite_taille[$i] = intval($_POST[$elt]);
                }else{
                    $quantite_taille[$i] = '';
                }
            }
            $type = $_POST['type'];
            $donne = $bdd ->query("SELECT * FROM intmarket.categorie");
            while ($trouve = $donne ->fetch()){
                if($trouve['typeCategorie'] == $typeCategorie && $trouve['nomCategorie'] == $nomCategorie){
                    $categorie_idCategorie = $trouve['idCategorie'];
                    $idCategorie_trouve = true;
                    $sql = "INSERT INTO intmarket.article
                            (nomArticle, prixArticle, imageArticle,img_2, img_3 ,img_4 ,img_5 , descriptionArticle, quantite, categorie_idCategorie,type,quantite_taille_xs,quantite_taille_s,quantite_taille_m,quantite_taille_l,quantite_taille_xl,quantite_taille_xxl) VALUES 
                            ('$nomArticle','$prixArticle','$imageArticle','$img_2','$img_3','$img_4','$img_5','$descriptionArticle','$quantite','$categorie_idCategorie','$type',$quantite_taille[0],$quantite_taille[1],$quantite_taille[2],$quantite_taille[3],$quantite_taille[4],$quantite_taille[5])";
                    if($bdd ->exec($sql) == true){
                        $status = "succes";
                    }else{
                        $status = "erreur";
                    }
                    break;
                }else{
                    $idCategorie_trouve = false;
                    $status = 'erreur';
                }
            }
        }
    }elseif (isset($_POST['ajouter']) && $_SESSION['table_courant'] == 'categorie'){
        foreach ($_POST as $key => $value) {
            $value = str_split($value);
            $compteur = 0;
            for($i = 0; $i < count($value); $i++){
                if($value[$i] !== " " || $value[$i] !== "   "){
                    $compteur++;
                }
            }
            if($compteur == 0){
                $erreur = "case_vide";
                break;
            }
        }
        if(!isset($erreur)){
            $nomCategorie = $_POST['nomCategorie'];
            $typeCategorie = $_POST['typeCategorie'];
            $sql = "INSERT INTO intmarket.categorie(nomCategorie, typeCategorie) VALUES ('$nomCategorie','$typeCategorie')";
            if($bdd ->exec($sql) == true){
                $status = "succes";
            }else{
                $status = "erreur";
            }
        }
    }elseif (isset($_POST['ajouter']) && $_SESSION['table_courant'] == 'commande'){
        foreach ($_POST as $key => $value) {
            $value = str_split($value);
            $compteur = 0;
            for($i = 0; $i < count($value); $i++){
                if($value[$i] !== " " || $value[$i] !== "   "){
                    $compteur++;
                }
            }
            if($compteur == 0){
                $erreur = "case_vide";
                break;
            }
        }
        if(!isset($erreur)){
            $dateCommande = $_POST['date'];
            $idUtilisateur = $_POST['idUtilisateur'];
            $sql = "INSERT INTO intmarket.commande(dateCommande, utilisateur_idUtilisateur) VALUES ('$dateCommande', '$idUtilisateur')";
            if($bdd ->exec($sql) == true){
                $status = "succes";
            }else{
                $status = "erreur";
            }
        }

    }elseif (isset($_POST['ajouter']) && $_SESSION['table_courant'] == 'utilisateur'){
        foreach ($_POST as $key => $value) {
            $value = str_split($value);
            $compteur = 0;
            for($i = 0; $i < count($value); $i++){
                if($value[$i] !== " " || $value[$i] !== "   "){
                    $compteur++;
                }
            }
            if($compteur == 0){
                $erreur = "case_vide";
                break;
            }
        }
        $civilite = $_POST['civilite'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $role = $_POST['role'];
        $addresse = $_POST['addresse'];
        $dateDeNaissance = $_POST['dateDeNaissance'];
        $donne = $bdd ->query("SELECT * FROM intmarket.utilisateur");
        while ($trouve = $donne ->fetch()){
            if($trouve['mail'] == $mail){
                $status = false;
                $erreur = "mail";
                break;
            }
        }
        if(!isset($erreur) || !isset($status)){
            $sql = "INSERT INTO intmarket.utilisateur
                (civilite,nom, prenom,dateDeNaissance, mail, mdp, addresse, role)
                 VALUES ('$civilite','$nom','$prenom','$dateDeNaissance','$mail','$mdp','$addresse','$role');";
            if($bdd ->exec($sql) == true){
                $status = "succes";
            }else{
                $status = "erreur";
            }
        }

    }
    $_SESSION['status'] = $status;
    header("location: ../index.php?action=backend");
}
?>