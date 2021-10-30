<?php

if($tab_ligneCP == false){
    echo "Il n'y a pas de produit dans la commande";
}
else {
    echo "<pre>";
    foreach ($tab_ligneCP as $v) {
        $produit = Produit::getById($v->getIdProduit());
        echo "<p>" . $produit->getNomProduit() . " d'id : " . $v->getIdProduit() . " , de prix : " . $produit->getPrix() . " , de categorie : " . $produit->getCategorie() . " de quantite : " . $v->getQuantite() . "</p>";
    }
}
?>
