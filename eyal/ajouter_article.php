ADD article

<!DOCTYPE html>
<html>
    <style>
.m{
    text-align: center;
    
}
.button4 {
    /* type submit "OK" */
    background-color: lightgrey;
    width: auto;
    border: 1px solid red;
    padding: 5px;
    margin: 20px;
}

        </style>
<title>BACK-END</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src='./vue/photo_specific/logo.png'  style="width:100%">
  <a href="./index.php?action=back_endd" class="w3-bar-item w3-button w3-padding-large w3-black">
    <!-- <i class="fa fa-home w3-xxlarge"></i> -->
    <p>AFFICHER</p>
  </a>
  <a href="./index.php?action=ajouter_categorie" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <p>AJOUTER</p>
  </a>
  <a href="#photos" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <p>MODIFIER</p>
  </a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <p>SUPRIMER</p>
  </a>
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <p>SITE</p>
  </a>

</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">AFFICHER</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">AJOUTER</a>
    <a href="#photos" class="w3-bar-item w3-button" style="width:25% !important">MODIFIER</a>
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">SUPRIMER</a>

  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">INT'MARKET</span> Back-End</h1>
  </header>


   
  <div class="w3-padding-32">    <div class="w3-bar w3-border">
      <a href="./index.php?action=article" class="w3-bar-item w3-button">ARTICLE</a>
      <a href="./index.php?action=ajouter_categorie" class="w3-bar-item w3-button w3-light-grey">CATEGORIE</a>
      <a href="./index.php?action=commande" class="w3-bar-item w3-button">COMMANDE</a>
      <a href="./index.php?action=utilisateur" class="w3-bar-item w3-button w3-hide-small">UTILISATEUR</a>
    </div>
  </div>
</header>


        </div>
  
  

</div>

</body>
</html>








<form class="m" method="POST" action="">
        <input class="button5" type="substr_compare" name="nomArticle" placeholder="Nom "/><br />

        <input class="button5" type="substr_compare" name="prixArticle" placeholder="Prix "/><br />

        <input class="button5" type="substr_compare" name="descriptionArticle" placeholder="Description "/><br />

        <input class="button5" type="substr_compare" name="quantite" placeholder="Quantite "/><br />

       
                     <input class="button4" type="submit" value="OK"/><br/>
                     <input class="button4" type="reset" value="Reset">


    </form>
    <?php

    
    
    
// connexion a la base de donne, recuperation des valeurs dans la bdd et affichage sur l'interface 
include("connexionn.php");

   if(isset($_POST['nomArticle']) AND isset($_POST['prixArticle'])AND isset($_POST['descriptionArticle'])AND isset($_POST['quantite']))
   
{
   $requete = $bdd->prepare("INSERT INTO article(nomArticle, prixArticle, descriptionArticle, quantite) VALUES(?, ?, ?, ?)");

   $requete->execute(array($_POST['nomArticle'], $_POST['prixArticle'], $_POST['descriptionArticle'], $_POST['quantite']));
   ?>

    <?php
   }


   

    ?>

</body>
</html>