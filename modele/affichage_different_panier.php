<?php
$bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
if(isset($_SESSION['idUtilisateur'])){
    $idUtilisateur = intval($_SESSION['idUtilisateur']);
    $donne = $bdd->query("SELECT *FROM intmarket.panier WHERE utilisateur_idUtilisateur = $idUtilisateur");
    while ($trouve = $donne->fetch()){
        $elt_panier = $trouve['idArticles'];
        $elt_panier = explode(",",$elt_panier);
        $elt_panier = compter_les_meme_article_dans_meme_panier($elt_panier);
        if(!$trouve['idArticles'] == NULL || !$trouve['idArticles'] == "0"){
            affichage_panier($elt_panier);
        }else{
            echo "";
        }
    }
}
function compter_les_meme_article_dans_meme_panier($elt_panier){
    if(count($elt_panier)> 2) {
        for($i = 1; $i < count($elt_panier) ; $i++){
            $compteur = 1;

            for ($j = $i + 1; $j < count($elt_panier)+ $compteur + 1 ; $j++){
                if(isset($elt_panier[$i])  && isset($elt_panier[$j])){
                    if(substr($elt_panier[$i], 0,2) == substr($elt_panier[$j],0,2) ){
                        $compteur ++;
                        unset($elt_panier[$j]);
                    }
                }else{
                    continue;
                }
            }
            if(isset($elt_panier[$i])){
                $elt_panier[$i] = strval($elt_panier["$i"])."-".$compteur;
            }
        }
        array_slice($elt_panier,0,1);
        return $elt_panier;
    }else{
        $elt_panier[1] = strval($elt_panier[1])."-1";
        array_slice($elt_panier,0,1);
        return $elt_panier;
    }
}

function affichage_panier($elt_panier){
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    foreach ($elt_panier as $key => $value){
        $value = explode('-', $value);
        $value[0] = intval($value[0]);
        $donne = $bdd-> query("SELECT * FROM intmarket.article WHERE idArticle = $value[0];");
        while ($trouve = $donne->fetch()){
            $categorie = intval($trouve['categorie_idCategorie']);
            $donne_categorie = $bdd-> query("SELECT * FROM intmarket.categorie WHERE idCategorie = $categorie;");
            while ($trouve_categorie = $donne_categorie->fetch()){
                $action_categorie = $trouve_categorie['typeCategorie'];
                echo "<div class='elt-item-painer'><img class='item-image-panier' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'>
                    <a id='lien-item' href='./index.php?action=".$action_categorie."&article=".base64_encode($trouve['idArticle'])."'><h5>".$trouve['nomArticle']."</h5></a>";
                if(intval($value[1]) == 0){
                    echo "<div class='detail-item-panier'><h6>".$value[1]."</h6> X".$value[2]."   -   <label class='prixArticle'>".(floatval($trouve["prixArticle"])*intval($value[2]))."</label>€<br></div>";
                }else{
                    echo "<div class='detail-item-panier'> X ".$value[1] ."<br></div>";
                }
            }
        }
    }
    echo "<br><button class='bouton_passer_commande'><a href='#'>Passer la commande</a></button></div></div></div>";
}
?>
