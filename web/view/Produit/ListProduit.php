<?php
if($tab_produit == false){
    echo "Il n'y a pas de produit";
}
else{
    foreach ($tab_produit as $v){
        echo "<p>".$v->getNomProduit(). " d'id : ".$v->getIdProduit(). " , de prix : ".$v->getPrix() . " , de categorie : ".$v->getCategorie();
    }
}

