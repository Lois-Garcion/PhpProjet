<?php
echo "<pre>";
var_dump($_SESSION["panier"]);
echo "</pre>";

$prix = 0;

if(empty($_SESSION["panier"])){
    echo "<p>Le panier est vide </p>";
}
else {
    foreach ($_SESSION["panier"] as $p => $qte) {
        $produit = Produit::getById($p);
        $prix = $prix + $produit->getPrix() * $qte;
        echo "Nom produit : " . $produit->getNomProduit();
        echo " Categorie : " . $produit->getCategorie();
        echo " Prix unitaire : " . $produit->getPrix();
        echo " Quantite : " . $qte;
        echo " Prix total : " . $produit->getPrix() * $qte;
        echo "<br>"; //TODO FAIRE LE STYLE DE CETTE PAGE

        echo "<form method=\"post\" action=\"?controller=ControllerUtilisateur&action=updateQuantity\">
                <input type=\"hidden\" name=\"idProduit\" value ='$p'>
                <input type=\"number\" name=\"quantite\" value ='$qte'>
                <input type=\"submit\" class=\"button\" value=\"Modifier la quantité\">
              </form>";

        echo "<form method=\"post\" action=\"?controller=ControllerUtilisateur&action=retirerProduitPanier\">
                <input type=\"hidden\" name=\"idProduit\" value ='$p'>
                <input type=\"submit\" class=\"button\" value=\"Supprimer\">
              </form>";
    }
    echo "<br>";
    $_SESSION["prixTotal"] = $prix;
    echo "le prix total est : " . $prix;

    echo "<a href=\"?controller=ControllerUtilisateur&action=annulerPanier\">Supprimer le panier</a>";
    echo "<a href=\"?controller=ControllerUtilisateur&action=validerPanier\">Finir la Commande</a>";

}
?>
