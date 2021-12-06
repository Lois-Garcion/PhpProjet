<div class="container">
<?php

if(empty($tab_ligneCP)){
    echo "Vous n'avez jamais fait de commandes";
}
else {
    echo"<ul class=\"responsive-table\">";
    echo"
        <li class=\"table-header\">
      <div class=\"col col-1\">Produit</div>
      <div class=\"col col-2\">Nom produit</div>
      <div class=\"col col-3\">Prix</div>
      <div class=\"col col-4\">Quantité</div>
    </li>
    ";
    foreach ($tab_ligneCP as $v) {
        $produit = Produit::getById($v->getIdProduit());
        echo "
        <li class=\"table-row\">
              <div class=\"col col-1\" data-label=\"id\"><img src =" . $produit->getFilepath() . "></div>   
              <div class=\"col col-2\" data-label=\"nom\">" . $produit->getNomProduit() . "</div>
              <div class=\"col col-3\" data-label=\"prix\">" . $produit->getPrix()*$v->getQuantite() . "€" . "</div>
              <div class=\"col col-4\" data-label=\"quantite\">" . $v->getQuantite() . "</div>
        </li>
        ";
    }
}
?>
    </ul>
</div>

