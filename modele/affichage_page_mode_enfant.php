<?php
$bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
function verifier_quantite_taille_vetement($id){
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    $donne = $bdd->query("SELECT * FROM intmarket.article WHERE idArticle = '$id'");
    $option = "";
    while ($trouve = $donne->fetch()){
        $taille = array("xs","s","m","l","xl","xxl");
        for ($i = 0; $i < count($taille);$i++){
            $elt = "quantite_taille_".$taille["$i"];
            if($trouve["$elt"] !== NULL && intval($trouve[$elt]) !== 0){
                $option .= "<option value='".$taille[$i]."'>".$taille[$i]."</option>";
            }else{
                $option .= "";
            }
        }
    }
    return $option;
}
function afficher_image_item($id){
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    $donne = $bdd->query("SELECT * FROM intmarket.article WHERE idArticle = '$id'");
    $img = "";
    while ($trouve = $donne->fetch()){
        $img_bk = array('imageArticle','img_2','img_3','img_4','img_5');
        for($i = 0;$i<count($img_bk);$i++){
            $elt = $img_bk[$i];
            if($trouve[$elt] !== NULL && $trouve[$elt] !== ""){
                $img .= "<img class='item-image' src='data:image/jpeg;base64,".base64_encode($trouve[$elt])."'>";
            }
        }
    }
    return $img;
}


if(!isset($_GET['article'])){
    $donne = $bdd->query("SELECT * FROM intmarket.article");
    while ($trouve = $donne->fetch()){
        if($trouve['categorie_idCategorie'] == 8){
            echo "<li class='item_produit'>
                    <article class='mode-enfant'>
                        <div class='image-contient'>
                            <a href='./index.php?action=enfant&article=".base64_encode($trouve['idArticle'])."'><img class='item-image' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'></a>
                            <div class='item-detail'>
                                <h3 class='item-heading'>
                                    <a class='link' href='./index.php?action=enfant&article=".base64_encode($trouve['idArticle'])."'>".$trouve['nomArticle']."</a>
                                </h3>
                                <strong class='item-prix'>
                                    <span class='prix'>".$trouve['prixArticle']." €</span>
                                </strong>
                    </div>
                    </div>
                    </article></li>";
        }
    }
}else{
    $idArticle = base64_decode($_GET['article']);
    $donne = $bdd->query("SELECT * FROM intmarket.article WHERE idArticle = '$idArticle'");
    while ($trouve = $donne->fetch()){
        echo "<div class='item-detail-2'>
                <h3 class='item-heading'>
                    <p>".$trouve['nomArticle']."</p>
                </h3>
                <strong class='item-prix'>
                    <span class='prix'>".$trouve['prixArticle']." €</span>
                </strong>
                <div class='description-item'>
                ".$trouve['descriptionArticle']."
                </div>
                <form action='./modele/ajouter_au_panier.php' method='post'>
                    <input type='hidden' name='categorie' value='".$_GET['action']."'>
                    <input type='hidden' name='idArticle' value='$idArticle'>
                    <label><h3>Sélectionner la taille : </h3></label>
                    <select name='taille'>
                        ".verifier_quantite_taille_vetement($idArticle)."
                    </select><br>
                    <input type='submit' name='action' value='Ajouter au panier'>
                    </form>
</div>
</div>";
        echo "<div class='img-item'>
                ".afficher_image_item($idArticle)."

</div>";
    }
}

?>
