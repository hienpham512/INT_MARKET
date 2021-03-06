<?php
$status = '';
$status_mdp = '';
if(isset($_SESSION['status'])){
    if($_SESSION['status'] == 'succes'){
        $status = '<label style="color: green">SUCCÈS</label>';
    }else{
        if(isset($_SESSION['erreur']) && $_SESSION['erreur'] == 'mail'){
            $status = '<label style="color: #f44336">ERREUR : le mail est été connecté avec un autre compte!</label>';
            $status_mdp = '';
        }elseif (isset($_SESSION['erreur']) && $_SESSION['erreur'] == 'mdp'){
            $status_mdp = '<label style="color: #f44336">ERREUR : le mot de pass actuel est incorrect!</label>';
            $status = '';
        }elseif (isset($_SESSION['erreur']) && $_SESSION['erreur'] == 'comf_mdp') {
            $status_mdp = "<label style='color: #f44336'>ERREUR : le nouveau mot de pass n'est pas dupliqué!</label>";
            $status = '';
        }else{
            $status = '';
            $status_mdp = '';
        }
    }
    unset($_SESSION['status']);
    unset($_SESSION['erreur']);
}
if (isset($_GET)) {
    if ($_GET['action'] == "deconnecter") {
        session_start();
        session_destroy();
        header("location: ../index.php");
    }elseif ($_GET['action'] == "votre_compte") {
        if (!isset($_SESSION['idUtilisateur'])) {
            header("location: ../index.php?action=formulaire_connexion&erreur=reconnexion");
        } else {
            $idUtilisateur = $_SESSION['idUtilisateur'];
            $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
            $donne = $bdd->query("SELECT * FROM intmarket.utilisateur WHERE idUtilisateur = $idUtilisateur");
            $an_actuel = intval(date('Y'));
            $max_an = $an_actuel - 10;
            $min_an = $an_actuel - 110;
            $max_date_de_naissance = date("$max_an-m-d");
            $min_date_de_naissance = date("$min_an-m-d");

            while ($trouve = $donne ->fetch()){
                $nom = $trouve['nom'];
                $prenom = $trouve['prenom'];
                $addresse = $trouve['addresse'];
                $mail = $trouve['mail'];
                $dateDeNaissance = $trouve['dateDeNaissance'];
                echo "<label class='salution'><h5>Bienvenue</h5> <h2><i>$prenom $nom</i></h2></label>";
                echo "<div class='information_utilisateur'>
                        <fieldset class='info_utilisateur'>
                            <legend><h2>Mes information</h2></legend>
                            $status
                            <form method='post' action='./modele/analyser_changer_info_personnel.php'>
                                <label><h5>Civilité</h5></label><br>
                                <select name='civilite'>
                                    <option value='Mlle'>Mlle</option>
                                    <option value='Mme'>Mme</option>
                                    <option value='M'>M.</option>
                                </select>
                                <label><h5>Nom</h5></label><br>
                                <input type='text' name='nom' value='$nom'><br>
                                <label><h5>Prénom</h5></label><br>
                                <input type='text' name='prenom' value='$prenom'><br>
                                <label><h5>Mail</h5></label><br>
                                <input type='text' name='mail' value='$mail'><br>
                                <label><h5>Addresse</h5></label><br>
                                <input type='text' name='addresse' value='$addresse'><br>
                                <label><h5>Date de naissance</h5></label><br>
                                <label><i>Un cadeau vous attend pour votre anniversaire !</i></label><br>
                                <input type='date' max='$max_date_de_naissance' min='$min_date_de_naissance' name='date_de_naissance' value='$dateDeNaissance'><br>
                                <input type='submit' class='valider_btn' name='changer_info_personnel' value='Valider'>
                                </fieldset>
                                </form>
                                </div>";
                echo "<div class='changer_mdp'>
                        <fieldset class='info_utilisateur'>
                            <legend><h2>Changer mot de pass</h2></legend>
                            $status_mdp
                            <form method='post' action='./modele/analyser_changer_info_personnel.php'>
                                    <label><h4>Mot de pass actuel</h4></label><br>
                                    <input type='password' name='mdp_actuel'>
                                    <label><h4>Nouveau mot de pass</h4></label><br>
                                    <input type='password' name='nouveau_mdp'>
                                    <label><h4>Comfirmer nouveau mot de pass</h4></label><br>
                                    <input type='password' name='comf_nouveau_mdp'><br>
                                    <input type='submit' class='valider_btn' name='changer_mdp' value='Valider'>
                                    </form>
                                </fieldset>
                       </div>";
            }
        }
    }

}
?>