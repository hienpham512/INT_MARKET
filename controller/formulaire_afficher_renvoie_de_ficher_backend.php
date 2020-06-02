<?php
session_start();
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "succes") {
        $status = "SUCCÈS";
    } elseif ($_SESSION['status'] == "erreur_mail") {
        $status = "le mail est invalidé!";
    } elseif ($_SESSION['status'] == "erreur") {
        $status = "ERREUR";
    } else {
        $status = '';
    }
    echo "<label>$status</label>";
}
$_SESSION['status'] ='';