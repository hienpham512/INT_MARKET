<?php
function verifier_mdp($mdp){
    $erreur = "";
    if(strlen($mdp) < 6){
        $erreur = false;
        $_SESSION['erreur'] = "moin_de_6_carractere";
    }
    return $erreur;
}
function chiffrer_mdp($mdp){
    $erreur = verifier_mdp($mdp);
    if($erreur !== ""){
        return $erreur;
    }else{
        $mdp = base64_encode($mdp);
    }
    return $mdp;
}
function dechiffrer_mdp($mdp){
    $mdp = base64_decode($mdp);
    return $mdp;
}

?>