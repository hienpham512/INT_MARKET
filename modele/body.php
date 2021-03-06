<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1 {font-family: "Montserrat", sans-serif}
img {margin-bottom: -7px}
.w3-row-padding img {margin-bottom: 12px}
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:100%">





<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">


<!-- Photo Grid -->
<div class="w3-row" id="myGrid" style="margin-bottom:128px">
  <div class="w3-third">
    <img src="./vue/photo_specific/enfant.jpg" style="width:100%">
    <img src="./vue/photo_specific/enfant1.jpg" style="width:100%">
    <img src="./vue/photo_specific/sport1.jpg" style="width:100%">
    <img src="./vue/photo_specific/femme.jpg" style="width:100%">
  </div>

  <div class="w3-third">
    <img src="./vue/photo_specific/fruit.jpg" style="width:100%">
    <img src="./vue/photo_specific/legume.png" style="width:100%">
    <img src="./vue/photo_specific/alimentation2.jpg" style="width:100%">
    <img src="./vue/photo_specific/vin.jpg" style="width:100%">
  </div>

  <div class="w3-third">
    <img src="./vue/photo_specific/dec2.jpg" style="width:100%">
    <img src="./vue/photo_specific/art.jpg" style="width:100%">
    <img src="./vue/photo_specific/cuine.jpg" style="width:100%">
    <img src="./vue/photo_specific/deco.jpg" style="width:100%">
  </div>


<!-- End Page Content -->
 <!-- Footer -->
 <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s4">
        <h4>Contact</h4>
        <p>Des questions? Allez y.</p>
        <form action="./index.php" method="POST">
          <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="w3-button w3-block w3-black">Send</button>
        </form>
      </div>

      <div class="w3-col s4">
        <h4>A propos</h4>
        <p><a href="#">Service Clients</a></p>
        <p><a href="#">Aide</a></p>
        <p><a href="#">Magasins</a></p>
        <p><a href="#">Mentions légales et confidentialité</a></p>
      </div>

      <div class="w3-col s4 w3-justify">
        <h4>Magasins</h4>
        <p><a href="https://www.google.com/search?q=intech&rlz=1C1CHBF_frFR842FR842&oq=intech&aqs=chrome.0.69i59j0l4j69i60l3.4713j0j7&sourceid=chrome&ie=UTF-8&sxsrf=ALeKk022dGY4piIBRkwWUagSNcAWqBgtBA:1591618174373&npsic=0&rflfq=1&rlha=0&rllag=48854940,2356447,10748&tbm=lcl&rldimm=2523522275773450028&lqi=CgZpbnRlY2haEAoGaW50ZWNoIgZpbnRlY2g&ved=2ahUKEwi625rfl_LpAhVQ1hoKHeLiBcAQvS4wAHoECAsQIQ&rldoc=1&tbs=lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!3sIAE,lf:1,lf_ui:2&rlst=f#rlfi=hd:;si:17527167201580339468,l,CgZpbnRlY2haEAoGaW50ZWNoIgZpbnRlY2g;mv:[[52.827741499999995,22.2009075],[44.7660202,-1.1940199999999999]]"><i class="fa fa-fw fa-map-marker"></i> INT'MARKET</p></a>
        <p><i class="fa fa-fw fa-phone"></i> 0033753522072</p>
        <p><i class="fa fa-fw fa-envelope"></i> intmarket@gmail.com</p>
        <h4>Paiement</h4>
        <p><i class="fa fa-fw fa-cc-amex"></i> Paypal</p>
        <p><i class="fa fa-fw fa-credit-card"></i> Credit Card</p>
        <br>
        <a href="https://www.facebook.com/Intmarket-110395434038948/"><i class="fa fa-facebook-official w3-hover-opacity w3-large"></i></a>
        <a href="https://www.instagram.com/intmarket1/"><i class="fa fa-instagram w3-hover-opacity w3-large"></i></a>
        <i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
        <i class="fa fa-twitter w3-hover-opacity w3-large"></i>
      </div>
    </div>
  </footer>
</div>

 
<script>
// Toggle grid padding
function myFunction() {
  var x = document.getElementById("myGrid");
  if (x.className === "w3-row") {
    x.className = "w3-row-padding";
  } else { 
    x.className = x.className.replace("w3-row-padding", "w3-row");
  }
}

// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.width = "100%";
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>
