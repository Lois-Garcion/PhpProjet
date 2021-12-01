<?php
if(empty($panier)){
    echo "<p>Le panier est vide </p>";
}
else{
    foreach ($panier as $p){
        $produit = Produit::getById($p["id"]);
        echo "Nom produit : " . $produit->getNomProduit();
        echo "Categorie : " . $produit->getCategorie();
        echo "Prix unitaire : " . $produit->getPrix();
        echo "Prix total : " . $produit->getPrix() * $p["quantite"];
    }
}