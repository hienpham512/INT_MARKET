<?php
function verifier_mdp($mdp){
    $erreur = "";
    if(strlen($mdp) < 6){
        $erreur = false;
        $_SESSION['erreur'] = "moin_de_6_carractere";
    }
    /*$mdp = str_split(htmlspecialchars($mdp));
    $replace_special_carractere = array("á","â", "à", "å", "ä", "é", "ê", "è", "ë", "ì", "í", "î", "ï", "ô", "ö", "ñ", "ò", "ó", "õ", "ø", "œ", "š", "ç", "ù", "û", "ú", "ü");
    foreach ($replace_special_carractere as $key => $value) {
        if (in_array($value, $mdp)) {
            $erreur = "carractere_special";
        }
    }*/
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