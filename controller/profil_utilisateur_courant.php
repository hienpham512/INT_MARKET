<?php
session_start();
if (isset($_GET)) {
    if ($_GET['action'] == "deconnecter") {
        session_destroy();
        header("location: ../index.php");
    } elseif ($_GET['action'] == "votre_profil") {
        if (!isset($_SESSION['idUtilisateur'])) {
            header("location: ../index.php?action=formulaire_connexion&erreur=reconnexion");
        } else {

        }
    }

}
?>