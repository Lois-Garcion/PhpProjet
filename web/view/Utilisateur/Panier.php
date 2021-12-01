<?php

if(empty($_SESSION["panier"])){
    echo "<p>Le panier est vide </p>";
}
else{
    foreach ($_SESSION["panier"] as $p){
        $produit = Produit::getById($p["idProduit"]);
        echo "Nom produit : " . $produit->getNomProduit();
        echo " Categorie : " . $produit->getCategorie();
        echo " Prix unitaire : " . $produit->getPrix();
        echo " Quantite : " . $p["quantiteProduit"];
        echo " Prix total : " . $produit->getPrix() * $p["quantiteProduit"];
        echo "<br>"; //TODO FAIRE LE STYLE DE CETTE PAGE

        echo "<form method=\"post\" action=\"?controller=ControllerUtilisateur&action=retirerProduitPanier\">
                <input type=\"hidden\" name=\"idProduit\" value = \" ". $p["idProduit"] . "\">
                <input type=\"submit\" class=\"button\" value=\"Supprimer\">
              </form>";
    }
    echo "<br>";

    echo "Prix de la commande : " . $_SESSION["prixPanier"];
}