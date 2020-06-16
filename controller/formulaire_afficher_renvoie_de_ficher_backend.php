<?php
session_start();
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "succes") {
        $status = "SUCCÈS";
        echo "<center><label style='color: green;' class='succes'>$status</label></center>";
    } elseif ($_SESSION['status'] == "erreur_mail") {
        $status = "le mail est invalidé!";
        echo "<center><label style='color: red;' class='erreur'>$status</label></center>";
    } elseif ($_SESSION['status'] == "erreur") {
        $status = "ERREUR";
        echo "<center><label style='color: red;' class='erreur'>$status</label></center>";
    }
}
$_SESSION['status'] ='';