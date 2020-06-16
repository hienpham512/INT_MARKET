<style>
    .center-div {
     margin: 0 auto;
     width: 100px; 
     
}
</style>

<?php
session_start();
if(isset($_GET['action_controller']) ){
    echo "<style>
        #btn_".$_GET['action_controller']."{
        color: blue;
        }
    </style>";
}elseif(isset($_SESSION['action_administrateur'])){
    echo "<style>
        #btn_".$_SESSION['action_administrateur']."{
        color: blue;
        }
        </style>";
}

if(isset($_GET['table'])){
    echo "<style>
            #t_".$_GET['table']."{
            color: blue;
            }
            </style>";
}elseif(isset($_SESSION['table_courant'])){
    echo "<style>
            #".$_SESSION['table_courant']."{
            color: blue;
            }
            </style>";
}
$bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
//vérifier si l'utikisateur courant est un administrateur.
if(isset($_SESSION["role"]) && $_SESSION["role"] == "administrateur") {
    echo "<div class='indent' class='table_bdd'>
    <div  class='table_bdd_contient' >
        <button onclick='afficher(1)' class='dropbtn' id='t_1'>ARTICLE</button>
        <button onclick='afficher(2)' class='dropbtn' id='t_2'>CATEGORIE</button>
        <button onclick='afficher(3)' class='dropbtn' id='t_3'>COMMANDE</button>
        <button onclick='afficher(4)' class='dropbtn' id='t_4'>UTILISATEUR</button>
    </div>
</div>";
    if (isset($_GET['table'])) {
        $table = $_GET['table'];
        if (isset($_GET['status'])) {
            if ($_GET['status'] == "succes") {
                $resultat = "<label></label>";
            }
        }
    }
    //recupérer le requette de fichier formulaire_afficher_backend.html pour analyser.
    if (isset($_GET['action_controller'])) {
        $_SESSION['action_administrateur'] = $_GET['action_controller'];
    } elseif (isset($_GET['table'])) {
        $table = $_GET['table'];
    } elseif (isset($_GET["modifier"])) {
        $modifier = $_GET["modifier"];
    } elseif (isset($_GET["supprimer"])) {
        $supprimer = $_GET["supprimer"];
    }
}
if(isset($_SESSION['action_administrateur']) && isset($table)){
    $action_administrateur = $_SESSION['action_administrateur'];
    //action afficher
    if ($action_administrateur == 1 && $table == 1) {
        $donne = $bdd->query("SELECT * FROM intmarket.article");
        echo "<br><center><table border='1'><tr><th>idArticle<th>nomArticle<th>prixArticle<th>imageArticle<th>img_2<th>img_3<th>img_4<th>img_5<th>descriptionArticle<th>quantite<th>categorie_idCategorie</th></tr>";
        while ($trouve = $donne->fetch()) {
            echo "<tr><td>" . $trouve["idArticle"] . "<td>" . $trouve["nomArticle"] . "<td>" . $trouve["prixArticle"] . "<td>" . "<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_2'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_3'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_4'])."'></img>". "<td>"  ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_5'])."'></img>". "<td>" .  $trouve["descriptionArticle"] . "<td>" . $trouve["quantite"] . "<td>" . $trouve["categorie_idCategorie"] . "</td></tr>";
        }
    } elseif ($action_administrateur == 1 && $table == 2) {
        $donne = $bdd->query("SELECT * FROM intmarket.categorie");
        echo "<br><center><table border='1'><tr><th>idCategorie<th>nomCategorie<th>sousCategorie</th></tr>";
        while ($trouve = $donne->fetch()) {
            echo "<tr><td>" . $trouve["idCategorie"] . "<td>" . $trouve["nomCategorie"] . "<td>" . $trouve["sousCategorie"] . "</td></tr>";
        }
    } elseif ($action_administrateur == 1 && $table == 3) {
        $donne = $bdd->query("SELECT * FROM intmarket.commande");
        echo "<br><center><table border='1'><tr><th>idCommande<th>dateCommande<th>utilisateur_idUtilisateur</th></tr>";
        while ($trouve = $donne->fetch()) {
            echo "<tr><td>" . $trouve["idCommande"] . "<td>" . $trouve["dateCommande"] . "<td>" . $trouve["utilisateur_idUtilisateur"] . "</td></tr>";
        }
    } elseif ($action_administrateur == 1 && $table == 4) {
        $donne = $bdd->query("SELECT * FROM intmarket.utilisateur");
        echo "<br><center><table border='1'><tr><th>idUtilisateur<th>civilite<th>nom<th>prenom<th>dateDeNaissance<th>mail<th>mdp<th>addresse<th>panier<th>role</th></tr>";
        while ($trouve = $donne->fetch()) {
            echo "<tr><td>" . $trouve["idUtilisateur"] . "<td>" . $trouve["civilite"] ."<td>" . $trouve["nom"] . "<td>" . $trouve["prenom"] ."<td>" . $trouve["dateDeNaissance"] . "<td>" . $trouve["mail"] . "<td>" . $trouve["mdp"] . "<td>" . $trouve["addresse"] . "<td>" . $trouve["panier"] . "<td>" . $trouve["role"] . "</td></tr>";
        }
        echo "</table>";
        //action ajouter
    } elseif ($action_administrateur == 2 && $table == 1) {
        $_SESSION['table_courant'] = "article";
        $donne = $bdd->query("SELECT * FROM intmarket.categorie");
        $nomCategories = array();
        $sousCategories = array();

        while ($trouve = $donne->fetch()) {
            $i = 0;
            while ($i < count($nomCategories)) {
                if ($trouve['nomCategorie'] == $nomCategories[$i]) {
                    break;
                } else {
                    $i++;
                    continue;
                }
            }
            if ($i >= count($nomCategories)) {
                $nomCategories[count($nomCategories)] = $trouve['nomCategorie'];
            }
            $j = 0;
            while ($j < count($sousCategories)) {
                if ($trouve['sousCategorie'] == $sousCategories[$j]) {
                    break;
                } else {
                    $j++;
                    continue;
                }
            }
            if ($j >= count($sousCategories)) {
                $sousCategories[count($sousCategories)] = $trouve['sousCategorie'];
            }
        }
        $select_sousCategorie = "<select name='sousCategorie' >";
        $select_nomCategorie = "<select name='nomCategorie' >";
        for ($i = 0; $i < count($nomCategories); $i++) {
            $select_nomCategorie .= "<option value='$nomCategories[$i]'>$nomCategories[$i]</option>";
        }
        for ($i = 0; $i < count($sousCategories); $i++) {
            $select_sousCategorie .= "<option value='$sousCategories[$i]'>$sousCategories[$i]</option>";
        }
        $select_sousCategorie .= "</select>";
        $select_nomCategorie .= "</select>";
        echo "<div class='center-div'>
                <form action='./modele/backend.php' method='post' enctype='multipart/form-data'><br>
                <label>nomArticle : </label></label><input type='text' name='nomArticle'><br>
                <label>prixArticle : </label><input step='any' type='number' min='1' name='prixArticle'><br>
                <label>imageArticle: </label><input type='file' name='imageArticle'><br>
                <label>imageArticle_2(s'il en y a): </label><input type='file' name='img_2'><br>
                <label>imageArticle_3(s'il en y a): </label><input type='file' name='img_3'><br>
                <label>imageArticle_4(s'il en y a): </label><input type='file' name='img_4'><br>
                <label>imageArticle_5(s'il en y a): </label><input type='file' name='img_5'><br>
                <label>descriptionArticle: </label><input type='text' name='descriptionArticle'><br>
                <label>quantite: </label><input type='number'  min='1' name='quantite'><br>
                <label>nomCategorie: </label>$select_nomCategorie
                <label>sousCategorie: </label>$select_sousCategorie<br><br/>
                <input type='submit' name='ajouter' value='insérer'>
                <input type='hidden' name='table' value='article'>
</form>
</div>";
    } elseif ($action_administrateur == 2 && $table == 2) {
        $_SESSION['table_courant'] = "categorie";
        echo "<div class='center-div'>
                    <form action='./modele/backend.php' method='post'><br/><br/>
                    <select name='nomCategorie'>
                    <option value='courses'>COURSES</option>
                    <option value='mode'>MODE</option>
                    <option value='maison_loisir'>MAISON ET LOISIR</option>
                    <option value='animal'>ANIMAL</option>
                    </select><br/><br/>
                    <input type='text' name='sousCategorie'><br/><br/>
                    <input type='submit' name='ajouter' value='insérer'>
                    <input type='hidden' name='table' value='categorie'>
        </form>
        </div>";
    } elseif ($action_administrateur == 2 && $table == 3) {
        $_SESSION['table_courant'] = "commande";
        echo "<div  class='center-div'>
                    <form action='./modele/backend.php' method='post'>
                    <label><h3><strong>Date De Commande</strong></h3></label><input type='date' name = 'date'><br/><br/>
                    <input type='number' name='idUtilisateur' min='1'><br/><br/>
                    <input type='submit' name='ajouter' value='insérer'>
                    <input type='hidden' name='table' value='commande'>
                    </form>
        </div>";
    } elseif ($action_administrateur == 2 && $table == 4) {
        $_SESSION['table_courant'] = "utilisateur";
        $an_actuel = intval(date('Y'));
        $max_an = $an_actuel - 10;
        $min_an = $an_actuel - 110;
        $max_date_de_naissance = date("$max_an-m-d");
        $min_date_de_naissance = date("$min_an-m-d");
        echo "<div  class='center-div'>
                    <form action='./modele/backend.php' method='post'>
                    <label>Civilité : </label>
                                <select name='civilite'>
                                    <option value='Mlle'>Mlle</option>
                                    <option value='Mme'>Mme</option>
                                    <option value='M'>M.</option>
                                </select><br>
                    <label>nom : </label><input type='text' name='nom'><br>
                    <label>prenom : </label><input type='text' name='prenom'><br>
                    <label>Date de naissance</label><br>
                    <input type='date' max='$max_date_de_naissance' min='$min_date_de_naissance' name='dateDeNaissance' ><br>
                    <label>email : </label><input type='text' name='mail'><br>
                    <label>mot de pass : </label><input type='text' name='mdp'><br>
                    <label>addresse : </label><input type='text' name='addresse'><br>
                    <label>panier : </label><input type='text' name='panier'><br>
                    <label>role : </label><input type='text' name='role'><br>
                    <input type='hidden' name='table' value='utilisateur'><br/>
                    <input type='submit' name='ajouter' value='insérer'>
        
        </div>";
        //action modifier
    }elseif ($action_administrateur == 3 && $table == 1) {
        $donne = $bdd->query("SELECT * FROM intmarket.article");
        echo "<br><center><table border='1'><tr><th>idArticle<th>nomArticle<th>prixArticle<th>imageArticle<th>img_2<th>img_3<th>img_4<th>img_5<th>descriptionArticle<th>quantite<th>categorie_idCategorie<th>action</th></tr>";
        $_SESSION['table_courant'] = "article";
        while ($trouve = $donne->fetch()) {
            $idArticle = $trouve['idArticle'];
            echo "<tr><td>" . $trouve["idArticle"] . "<td>" . $trouve["nomArticle"] . "<td>" . $trouve["prixArticle"] . "<td>" . "<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_2'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_3'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_4'])."'></img>". "<td>"  ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_5'])."'></img>". "<td>" . $trouve["descriptionArticle"] . "<td>" . $trouve["quantite"] . "<td>" . $trouve["categorie_idCategorie"] . "<td>" . "<div><button onclick='modifier($idArticle)'>modifier</button></div>" . "</td></tr>";
        }
    } elseif ($action_administrateur == 3 && $table == 2) {
        $_SESSION['table_courant'] = "categorie";
        $donne = $bdd->query("SELECT * FROM intmarket.categorie");
        echo "<br><center><table border='1'><tr><th>idCategorie<th>nomCategorie<th>sousCategorie<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idCategorie = $trouve['idCategorie'];
            echo "<tr><td>" . $trouve["idCategorie"] . "<td>" . $trouve["nomCategorie"] . "<td>" . $trouve["sousCategorie"] . "<td>" . "<div><button onclick='modifier($idCategorie)'>modifier</button></div>" . "</td></tr>";
        }
    } elseif ($action_administrateur == 3 && $table == 3) {
        $_SESSION['table_courant'] = "commande";
        $donne = $bdd->query("SELECT * FROM intmarket.commande");
        echo "<br><center><table border='1'><tr><th>idCommande<th>dateCommande<th>utilisateur_idUtilisateur<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idCommande = $trouve['idCommande'];
            echo "<tr><td>" . $trouve["idCommande"] . "<td>" . $trouve["dateCommande"] . "<td>" . $trouve["utilisateur_idUtilisateur"] . "<td>" . "<div><button onclick='modifier($idCommande)'>modifier</button></div>" . "</td></tr>";
        }
    } elseif ($action_administrateur == 3 && $table == 4) {
        $_SESSION['table_courant'] = "utilisateur";
        $donne = $bdd->query("SELECT * FROM intmarket.utilisateur");
        echo "<br><center><table border='1'><tr><th>idUtilisateur<th>civilite<th>nom<th>prenom<th>dateDeNaissance<th>mail<th>mdp<th>addresse<th>panier<th>role<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idUtilisateur = $trouve['idUtilisateur'];
            echo "<tr><td>" . $trouve["idUtilisateur"] . "<td>" . $trouve["civilite"] ."<td>" . $trouve["nom"] . "<td>" . $trouve["prenom"] ."<td>" . $trouve["dateDeNaissance"] . "<td>" . $trouve["mail"] . "<td>" . $trouve["mdp"] . "<td>" . $trouve["addresse"] . "<td>" . $trouve["panier"] . "<td>" . $trouve["role"] . "<td>" . "<div><button onclick='modifier($idUtilisateur)'>modifier</button></div>" . "</td></tr>";
        }
        //action supprimer
    } elseif ($action_administrateur == 4 && $table == 1) {
        $_SESSION['table_courant'] = "article";
        $donne = $bdd->query("SELECT * FROM intmarket.article");
        echo "<br><center><table border='1'><tr><th>idArticle<th>nomArticle<th>prixArticle<th>imageArticle<th>img_2<th>img_3<th>img_4<th>img_5<th>descriptionArticle<th>quantite<th>categorie_idCategorie<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idArticle = $trouve['idArticle'];

            echo "<tr><td>" . $trouve["idArticle"] . "<td>" . $trouve["nomArticle"] . "<td>" . $trouve["prixArticle"] . "<td>" . "<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_2'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_3'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_4'])."'></img>". "<td>"  ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_5'])."'></img>". "<td>" .  $trouve["descriptionArticle"] . "<td>" . $trouve["quantite"] . "<td>" . $trouve["categorie_idCategorie"] . "<td>"
                . "<div  class='dropdown'>
                        <button onclick='myFunction()' class='dropbtn'>supprimer</button>
                        <div  class='dropdown-content'>
                                <h1>Vous êtes sûr de supprimer? $idArticle</h1>
                                <form action='./modele/backend.php' method='post'>
                                    <input type='hidden' name='idArticle' value='$idArticle'>
                                    <button name='supprimer' value='$idArticle'>oui</button>
                                </form>
                            </div>
                        </div>" ."</td></tr>";
        }
    }elseif ($action_administrateur == 4 && $table == 2) {
        $_SESSION['table_courant'] = "categorie";
        $donne = $bdd->query("SELECT * FROM intmarket.categorie");
        echo "<br><center><table border='1'><tr><th>idCategorie<th>nomCategorie<th>sousCategorie<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idCategorie = $trouve['idCategorie'];
            echo "<tr><td>" . $trouve["idCategorie"] . "<td>" . $trouve["nomCategorie"] . "<td>" . $trouve["sousCategorie"] ."<td>"
                            . "<div class='dropdown'>
                                <button onclick='myFunction()' class='dropbtn'>supprimer</button>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de supprimer? $idCategorie</h1>
                                        <form action='./modele/backend.php' method='post'>
                                            <input type='hidden' name='idCategorie' value='$idCategorie'>
                                            <button name='supprimer' value='$idCategorie'>oui</button>
                                        </form>
                                    </div>
                                </div>" ."</td></tr>";
        }
    }elseif ($action_administrateur == 4 && $table == 3) {
        $_SESSION['table_courant'] = "commande";
        $donne = $bdd->query("SELECT * FROM intmarket.commande");
        echo "<br><center><table border='1'><tr><th>idCommande<th>dateCommande<th>utilisateur_idUtilisateur<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idCommande = $trouve['idCommande'];
            echo "<tr><td>" . $trouve["idCommande"] . "<td>" . $trouve["dateCommande"] . "<td>" . $trouve["utilisateur_idUtilisateur"]
                        . "<td><div class='dropdown'>
                                <button onclick='myFunction()' class='dropbtn'>supprimer</button>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de supprimer?$idCommande</h1>
                                        <form action='./modele/backend.php' method='post'>
                                            <input type='hidden' name='idCommande' value='$idCommande'>
                                            <button name='supprimer' value='oui'>oui</button>
                                        </form>
                                    </div>
                                </div>" ."</td></tr>";
        }
    }elseif($action_administrateur == 4 && $table == 4) {
        $_SESSION['table_courant'] = "utilisateur";
        $donne = $bdd->query("SELECT * FROM intmarket.utilisateur");
        echo "<br><center><table border='1'><tr><th>idUtilisateur<th>civilite<th>nom<th>prenom<th>dateDeNaissance<th>mail<th>mdp<th>addresse<th>panier<th>role<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idUtilisateur = $trouve['idUtilisateur'];
            echo "<tr><td>" .$idUtilisateur."<td>" .$trouve["civilite"] ."<td>" . $trouve["nom"] . "<td>" . $trouve["prenom"] ."<td>" .$trouve["dateDeNaissance"] . "<td>" . $trouve["mail"] . "<td>" . $trouve["mdp"] . "<td>" . $trouve["addresse"] . "<td>" . $trouve["panier"] . "<td>" . $trouve["role"] . "<td>"
                            . "<div class='dropdown'>
                                <button onclick='myFunction()' class='dropbtn'>supprimer</button>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de supprimer? ".$idUtilisateur."</h1>
                                        <form action='./modele/backend.php' method='post'>
                                            <input type='hidden' name='idUtilisateur' value='$idUtilisateur'>
                                            <button name='supprimer' value='oui'>oui</button>
                                        </form>
                                    </div>
                                </div>" . "</td></tr>";
        }
    }
//afficher la table pour modifier d'élément avec index égal à id.
    //modifier
}elseif (isset($_SESSION['table_courant']) && isset($_GET['modifier'])) {
    $table_courant = $_SESSION['table_courant'];
    $id_index_modifier = $_GET['modifier'];
    if ($table_courant == 'article') {
        $donne = $bdd->query("SELECT * FROM intmarket.article");
        echo "<form action='./modele/backend.php' method='post' enctype='multipart/form-data' ><center><table border='1'><tr><th>idArticle<th>nomArticle<th>prixArticle<th>imageArticle<th>img_2<th>img_3<th>img_4<th>img_5<th>descriptionArticle<th>quantite<th>categorie_idCategorie<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idArticle = $trouve['idArticle'];
            if ($trouve['idArticle'] == $id_index_modifier) {
                echo "<tr>
                        <td> ".$trouve['idArticle']." <input type='hidden' min='1' name='idArticle' value='" . $trouve['idArticle'] . "'></td>
                        <td><input type='text' name='nomArticle' value='" . $trouve['nomArticle'] . "'></td>
                        <td><input type='number' min='0' name='prixArticle' value='" . $trouve['prixArticle'] . "'></td>
                        <td><input type='file' name='imageArticle'>". "</td>
                        <td><input type='file' name='img_2'>". "</td>
                        <td><input type='file' name='img_3'>". "</td>
                        <td><input type='file' name='img_4'>". "</td>
                        <td><input type='file' name='img_5'>". "</td>
                        <td><input type='text' name='descriptionArticle' value='" . $trouve['descriptionArticle'] . "'></td>
                        <td><input type='number' min='1' name='quantite' value='" . $trouve['quantite'] . "'></td>
                        <td><input type='number' min='1' name='categorie_idCategorie' value='" . $trouve['categorie_idCategorie'] . "'></td>
                        <td><div class='dropdown'>
                                <a onclick='myFunction()' class='dropbtn'>Valider</a>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de modifier?</h1>
                                        <button name='modifier' value='oui'>oui</button>
                                    </div>
                                </div>
                        </td></tr>";
            } else {
                echo "<tr><td>" . $trouve["idArticle"] . "<td>" . $trouve["nomArticle"] . "<td>" . $trouve["prixArticle"] . "<td>" . "<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['imageArticle'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_3'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_3'])."'></img>". "<td>" ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_4'])."'></img>". "<td>"  ."<img widtd='20%' height='10%' src='data:image/jpeg;base64,".base64_encode($trouve['img_5'])."'></img>". "<td>" . $trouve["descriptionArticle"] . "<td>" . $trouve["quantite"] . "<td>" . $trouve["categorie_idCategorie"] . "<td>" . "<div><a onclick='modifier($idArticle)'>modifier</a></div>" . "</td></tr>";
            }
        }
        echo "</table></form>";
    } elseif ($table_courant == "categorie") {
        $donne = $bdd->query("SELECT * FROM intmarket.categorie");
        echo "<form action='./modele/backend.php' method='post'><center><table border='1'><tr><th>idCategorie<th>nomCategorie<th>sousCategorie<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idCategorie = $trouve['idCategorie'];
            if ($trouve['idCategorie'] == $id_index_modifier) {
                echo "<tr>
                        <td>". $trouve['idCategorie'] ."<input type='hidden' min='1' name='idCategorie' value='" . $trouve['idCategorie'] . "'></td>
                        <td><input type='text' name='nomCategorie' value='" . $trouve['nomCategorie'] . "'></td>
                        <td><input type='text' name='sousCategorie' value='" . $trouve['sousCategorie'] . "'></td>
                        <td><div class='dropdown'>    
                                <a onclick='myFunction()' class='dropbtn'>Valider</a>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de modifier?</h1>
                                        <button name='modifier' value='oui'>oui</button>
                                    </div>
                                </div>
                        </td></tr>";
            } else {
                echo "<tr><td>" . $trouve["idCategorie"] . "<td>" . $trouve["nomCategorie"] . "<td>" . $trouve["sousCategorie"] . "<td>" . "<div><a onclick='modifier($idCategorie)'>modifier</a></div>" . "</td></tr>";
            }
        }
        echo "</table></form>";
    } elseif ($table_courant == "commande") {
        $donne = $bdd->query("SELECT * FROM intmarket.commande");
        echo "<form action='./modele/backend.php' method='post'><center><table border='1'><tr><th>idCommande<th>dateCommande<th>utilisateur_idUtilisateur<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idCommande = $trouve['idCommande'];
            $dateCommande = $trouve['dateCommande'];
            $utilisateur_idUtilisateur = $trouve['utilisateur_idUtilisateur'];
            if ($trouve['idCommande'] == $id_index_modifier) {
                echo "<tr>
                       <td> $idCommande <input type='hidden' min='1' name='idCommande' value='$idCommande'></td>
                            <td><input type='date' name='dateCommande' value='$dateCommande'></td>
                            <td><input type='number' min='1' name='utilisateur_idUtilisateur' value='$utilisateur_idUtilisateur'></td>
                            <td><div class='dropdown'>
                                <a onclick='myFunction()' class='dropbtn'>Valider</a>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de modifier?</h1>
                                        <button name='modifier' value='oui'>oui</button>
                                    </div>
                                </div></td>
                        </tr>";
            } else {
                echo "<tr><td>" . $trouve["idCommande"] . "<td>" . $trouve["dateCommande"] . "<td>" . $trouve["utilisateur_idUtilisateur"] . "<td>" . "<div><a onclick='modifier($idCommande)'>modifier</a></div>" . "</td></tr>";
            }
        }
        echo "</table></form>";
    } elseif ($table_courant == 'utilisateur') {
        $an_actuel = intval(date('Y'));
        $max_an = $an_actuel - 10;
        $min_an = $an_actuel - 110;
        $max_date_de_naissance = date("$max_an-m-d");
        $min_date_de_naissance = date("$min_an-m-d");
        $donne = $bdd->query("SELECT * FROM intmarket.utilisateur");
        echo "<form action='./modele/backend.php' method='post'><center><table border = '1'><tr><th>idUtilisateur<th>civilite<th>nom<th>prenom<th>dateDeNaissance<th>mail<th>mdp<th>addresse<th>panier<th>role<th>action</th></tr>";
        while ($trouve = $donne->fetch()) {
            $idUtilisateur = $trouve['idUtilisateur'];
            if ($trouve['idUtilisateur'] == $id_index_modifier) {
                echo "<tr>
                        <td>" . $trouve['idUtilisateur'] . "<input type='hidden' name='idUtilisateur' value='" . $trouve['idUtilisateur'] . "'></td>
                        <td><select name='civilite'>
                                    <option value='Mlle'>Mlle</option>
                                    <option value='Mme'>Mme</option>
                                    <option value='M'>M.</option>
                                </select></td>
                        <td><input type='text' name='nom' value='" . $trouve['nom'] . "'></td>
                        <td><input type='text' name='prenom' value='" . $trouve['prenom'] . "'></td>
                        <td><input type='date'  max='$max_date_de_naissance' min='$min_date_de_naissance' name='dateDeNaissance' value='" . $trouve['dateDeNaissance'] . "'></td>
                        <td><input type='text' name='mail' value='" . $trouve['mail'] . "'></td>
                        <td><input type='password' name='mdp' value='" . $trouve['mdp'] . "'></td>
                        <td><input type='text' name='addresse' value='" . $trouve['addresse'] . "'></td>
                        <td><input type='text' name='panier' value='" . $trouve['panier'] . "'></td>
                        <td><input type='text' name='role' value='" . $trouve['role'] . "'></td>
                        <td><div class='dropdown'>
                                <a onclick='myFunction()' class='dropbtn'>Valider</a>
                                <div id='myDropdown' class='dropdown-content'>
                                        <h1>Vous êtes sûr de modifier?</h1>
                                        <button name='modifier' value='oui'>oui</button>
                                    </div>
                                </div></td>
                        </tr>";
            } else {
                echo "<tr><td>" . $trouve["idUtilisateur"] . "<td>" . $trouve["civilite"] . "<td>" . $trouve["nom"] . "<td>" . $trouve["prenom"] . "<td>" . $trouve["dateDeNaissance"] . "<td>" . $trouve["mail"] . "<td>" . $trouve["mdp"] . "<td>" . $trouve["addresse"] . "<td>" . $trouve["panier"] . "<td>" . $trouve["role"] . "<td>" . "<div><a onclick='modifier($idUtilisateur)'>modifier</a></div>" . "</td></tr>";
            }
        }
        echo "</table></form>";
    }
}
?>

