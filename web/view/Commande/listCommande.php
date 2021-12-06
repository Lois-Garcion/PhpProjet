<div class="container">
<?php

if(empty($tabCommande)){
    echo "Vous n'avez jamais fait de commandes";
}
else {
    echo"<ul class=\"responsive-table\">";
    echo"
        <li class=\"table-header\">
      <div class=\"col col-1\">ID</div>
      <div class=\"col col-2\">Date</div>
      <div class=\"col col-3\">Montant</div>
      <div class=\"col col-4\">Produits</div>
    </li>
    ";
    foreach ($tabCommande as $c) {
        echo "
        <li class=\"table-row\">
              <div class=\"col col-1\" data-label=\"id\">" . $c->getIdCommande() . "</div>
              <div class=\"col col-2\" data-label=\"date\">" . $c->getDate() . "</div>
              <div class=\"col col-3\" data-label=\"montant\">" . $c->getMontant() . "€" . "</div>
              <div class=\"col col-4\" data-label=\"statut\">
                <a href=\"?controller=ControllerCommande&action=read&id=" . $c->getIdCommande() . "\">Voir les produits</a>
              </div>
              </li>
        ";
    }
}
?>
    </ul>
</div>

