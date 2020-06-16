<?php
    session_start();
    include ("../controller/fct_analyser_mdp.php");
    $idUtilisateur = $_SESSION['idUtilisateur'];
    $bdd = new PDO('mysql:host=localhost;dbname=intmarket', 'root', 'root');
    if(!empty($_POST)) {
        if (isset($_POST['changer_info_personnel'])) {
            $civilite = $_POST['civilite'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $dateDeNaissance = $_POST['date_de_naissance'];
            $addresse = $_POST['addresse'];

            $donne = $bdd->query("SELECT * FROM intmarket.utilisateur");

            while ($trouve = $donne->fetch()) {
                if ($trouve['mail'] == $mail && $trouve['idUtilisateur'] !== $_SESSION['idUtilisateur']) {
                    $_SESSION['status'] = "erreur";
                    $_SESSION['erreur'] = "mail";
                    break;
                }else{
                    $sql = "UPDATE intmarket.utilisateur SET
                                civilite = '$civilite',
                                nom = '$nom',
                                prenom = '$prenom',
                                mail = '$mail',
                                addresse = '$addresse',
                                dateDeNaissance = '$dateDeNaissance'
                    WHERE idUtilisateur = '$idUtilisateur';";
                    if ($bdd->exec($sql) == true) {
                        $_SESSION['status'] = "succes";
                    } else {
                        $_SESSION['status'] = "erreur";
                    }
                    break;
                }
            }
        }elseif (isset($_POST['changer_mdp'])){
            $mdp_actuel = $_POST['mdp_actuel'];
            $nouveau_mdp = $_POST['nouveau_mdp'];
            $comf_nouveau_mdp = $_POST['comf_nouveau_mdp'];

            $donne = $bdd ->query("SELECT mdp FROM intmarket.utilisateur WHERE idUtilisateur = '$idUtilisateur'");
            while ($trouve = $donne->fetch()){
                if(dechiffrer_mdp($trouve['mdp']) == $mdp_actuel){
                    if($nouveau_mdp == $comf_nouveau_mdp){
                        $nouveau_mdp = chiffrer_mdp($nouveau_mdp);
                        $sql = "UPDATE intmarket.utilisateur SET 
                                mdp = '$nouveau_mdp'
                            WHERE idUtilisateur = '$idUtilisateur';";
                        if($bdd -> exec($sql) == true){
                            $_SESSION['status'] = "succes";
                        }else{
                            $_SESSION['status'] = "erreur";
                        }
                        break;
                    }else{
                        $_SESSION['status'] = "erreur";
                        $_SESSION['erreur'] = 'comf_mdp';
                        break;
                    }
                }else{
                    $_SESSION['status'] = "erreur";
                    $_SESSION['erreur'] = 'mdp';
                    break;
                }
            }
        }
    }
?>
<meta http-equiv="refresh" content="0;URL=../index.php?action=votre_compte">
