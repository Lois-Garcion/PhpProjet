<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo.png">
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
        <link rel="stylesheet" href="assets/css/header.css" type="text/css">
        <link rel="stylesheet" href="assets/css/footer.css" type="text/css">
        <link rel="stylesheet" href="assets/css/produits.css" type="text/css">
        <link rel="stylesheet" href="assets/css/profil.css" type="text/css">
        <link rel="stylesheet" href="assets/css/popupform.css" type="text/css">
        <link rel="stylesheet" href="assets/css/panier.css" type="text/css">
        <link rel="stylesheet" href="assets/css/accueil.css" type="text/css">
        <link rel="stylesheet" href="assets/css/listCommande.css" type="text/css">
        <link rel="stylesheet" href="assets/css/connexion.css" type="text/css">
        <link rel="stylesheet" href="assets/css/validationPanier.css" type="text/css">
        <link rel="stylesheet" href="assets/css/finCommande.css" type="text/css">
        <link rel="stylesheet" href="assets/css/pageProduit.css" type="text/css">
        <link rel="stylesheet" href="assets/css/accueilAdmin.css" type="text/css">
        <link rel="stylesheet" href="assets/css/aboutUs.css" type="text/css">
    </head>
    <body>

      <header class="header">

        <div class="menu">
          <ul>
            <li><a href="./">Accueil</a></li>
              <li><a href=./?controller=ControllerUtilisateur&action=aboutUs>About us</a></li>
              <li><a href="./?controller=ControllerProduit&action=readAll">Les produits</a></li>
              <?php if(!isset($_SESSION["status"])){
                      echo "<li><a href="."./?controller=ControllerUtilisateur&action=formConnect".">Se connecter</a></li>";
              }
              else{
                  echo"<li><a href=\"?controller=ControllerCommande&action=readAll\">Mes commandes</a></li>";
                  echo "<li><a href="."./?controller=ControllerUtilisateur&action=pageUtilisateur".">Mon profil</a></li>";
                  if($_SESSION["admin"]==1){
                      echo "<li><a href="."./?controller=ControllerUtilisateur&action=accueilAdmin".">Admin</a></li>";
                  }
                  echo "<li><a href="."./?controller=ControllerUtilisateur&action=logout".">Se deconnecter</a></li>";
              }
              if(isset($_SESSION["panier"]) && !empty($_SESSION["panier"])){
                  echo "<li><a href="."./?controller=ControllerUtilisateur&action=afficherPanier".">Panier</a></li>";
              }
              ?>
          </ul>
        </div>

    	</header>

        <div class="content">

          <?php
          if(is_null($controller) & (is_null($view)) ){
              $filepath = File::build_path(array("view","Accueil.php"));
          }
          else {
              if (is_null($controller)) $filepath = File::build_path(array("view", "$view.php"));
              else $filepath = File::build_path(array("view", $controller, "$view.php"));

              require $filepath;
          }
          ?>
          <div class="push"></div>
      </div>
      <footer class="footer">

          <div class="lescolonnes">
              <div class="colonne">
                  <ul class="listecolonne">
                      <li><p>Redirection</p></li>
                      <li><a href="./">Accueil</a></li>
                      <li><a href=./?controller=ControllerUtilisateur&action=aboutUs>About us</a></li>
                      <?php if(!isset($_SESSION["status"])){
                          echo "<li><a href="."./?controller=ControllerUtilisateur&action=formConnect".">Se connecter</a></li>";
                      }
                      else{
                          if($_SESSION["admin"]==1){
                              echo "<li><a href="."./?controller=ControllerUtilisateur&action=accueilAdmin".">Admin</a></li>";
                          }
                          echo "<li><a href="."./?controller=ControllerUtilisateur&action=pageUtilisateur".">Mon profil</a></li>";
                          echo"<li><a href=\"?controller=ControllerCommande&action=readAll\">Mes commandes</a></li>";
                          echo "<li><a href="."./?controller=ControllerUtilisateur&action=logout".">Se deconnecter</a></li>";
                      }
                      if(isset($_SESSION["panier"]) && !empty($_SESSION["panier"])){
                          echo "<li><a href="."./?controller=ControllerUtilisateur&action=afficherPanier".">Panier</a></li>";
                      }
                      ?>
                      <li><a href="./?controller=ControllerProduit&action=readAll">Les produits</a></li>
                  </ul>
              </div>

              <div class="colonne">
                  <ul class="listecolonne">
                      <li><p>L'équipe</p></li>
                      <li><a>Kellian Puginier</a></li>
                      <li><a>Florian Cam</a></li>
                      <li><a>Loïs Garcion</a></li>
                  </ul>
              </div>

              <div class="colonne">
                  <ul class="listecolonne">
                      <li><p>Remerciements</p></li>
                      <li><a>Cyrille Nadal</a></li>
                      <li><a>Le poulpe de Git</a></li>
                      <li><a>Optimum Prime</a></li>
                  </ul>
              </div>

          </div>

          <div class="dessous">
              <p>Copyright © 2021 BoutiqueDeLaCaillé Corp. All rights reserved.</p>
          </div>
      </footer>

    </body>
</html>
