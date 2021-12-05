<?php

if(empty($tabCommande)){
    echo "Vous n'avez jamais fait de commandes";
}
else {
    foreach ($tabCommande as $c) {
        echo "
    <h2>Commande " . $c->getIdCommande() . "</h2>
    <p>Montant : " . $c->getMontant() . "</p>
    <p>Date : " . $c->getDate() . "</p>
    <a href=\"?controller=ControllerCommande&action=read&id=" . $c->getIdCommande() . "\">Voir les produits de la Commande</a>
    ";
    }
}