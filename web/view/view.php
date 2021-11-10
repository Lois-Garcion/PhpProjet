<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle ?></title>
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
        <link rel="stylesheet" href="assets/css/header.css" type="text/css">
        <link rel="stylesheet" href="assets/css/footer.css" type="text/css">
        <link rel="stylesheet" href="assets/css/produits.css" type="text/css">
    </head>
    <body>



      <header class="header">

        <div class="menu">
          <ul>
            <li><a href="./">Accueil</a></li>
              <?php if(!isset($_SESSION["status"]) && $_SESSION["status"] !== "connected"){ //TODO REGLER LE PROBLEME
                  echo "<li><a href="."./?controller=ControllerUtilisateur&action=formConnect".">Se connecter</a></li>";
              }
              ?>
            <li><a href="https://youtu.be/dQw4w9WgXcQ">Les produits</a></li>
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
          <div class="menu">
            <ul>
              <li><a href="https://webinfo.iutmontp.univ-montp2.fr/~garcionl/eCommerce/projetPHP/web/index.php">Accueil</a></li>
              <li><a href="https://youtu.be/dQw4w9WgXcQ">Nos produits</a></li>
              <li><a href="https://youtu.be/dQw4w9WgXcQ">Mon profil</a></li>
            </ul>
          </div>
        </footer>

    </body>
</html>
