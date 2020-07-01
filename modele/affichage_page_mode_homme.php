<?php
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    $donne = $bdd->query("SELECT * FROM intmarket.article");
    while ($trouve = $donne->fetch()){
        if($trouve['categorie_idCategorie'] == 7){
            echo "<li class='item_produit'>
                    <article class='mode-homme'>
                        <div class='image-contient'>
                            <a href='#'><img class='item-image' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'></a>
                            <div class='item-detail'>
                                <h3 class='item-heading'>
                                    <a class='link' href=''>".$trouve['nomArticle']."</a>
                                </h3>
                                <strong class='item-prix'>
                                    <span class='prix'>".$trouve['prixArticle']." €</span>
                                </strong>
</div>
</div>
</article></li>";
        }
    }
?>
