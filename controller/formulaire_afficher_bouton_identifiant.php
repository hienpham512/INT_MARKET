<?php
if (!isset($_SESSION['idUtilisateur'])) {
    echo "<div class='dropdown' align='center'>
        <img src='/vue/photo_specific/photo_identifiant.png' class='dropbtn' height='30px' width='100px' alt='identifier'><br>Identifier
        <div class='dropdown-content'>
            <form action='/index.php?action=formulaire_connexion' method='post'>
                <button name='connexion' class='bouton' >connexion</button>
            </form>
            <form action='/index.php?action=formulaire_inscription' method='post'>
                <button name='inscription' class='bouton'>inscription</button>
            </form>
        </div>
    </div>";
} else {
    $id = $_SESSION['idUtilisateur'];
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    $reponde = $bdd->query("SELECT * FROM intmarket.utilisateur WHERE idUtilisateur = $id");
    while ($trouve = $reponde->fetch()) {
        $nom = $trouve['nom'];
        $prenom = $trouve['prenom'];
    }
    echo "<div class='dropdown' align='center'>
            <img src='/vue/photo_specific/photo_identifiant.png' class='dropbtn' height='30px' width='100px'><br>Mon compte 

            <div class='dropdown-content' align='left'>
                <a href='/controller/profil_utilisateur_courant.php?votre_compte' class='bouton'>Votre compte</a>
                <a href='/controller/profil_utilisateur_courant.php?votre_commande' class='bouton'>Votre commande</a>
                <a href='/controller/profil_utilisateur_courant.php?deconnecter' class='bouton'>deconnecter<img src='/vue/photo_specific/deconnecter.png' width='10%'></a>
            </div>
           </div>";
}
?>