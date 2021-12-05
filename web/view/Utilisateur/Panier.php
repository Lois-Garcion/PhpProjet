<?php

$prix = 0;

if(empty($_SESSION["panier"])){
    echo "<p>Le panier est vide </p>";
}
else {
    echo "<h1>Votre panier</h1>";
    foreach ($_SESSION["panier"] as $p => $qte) {
        $produit = Produit::getById($p);
        $prix = $prix + $produit->getPrix() * $qte;
        echo "
        <div class=\"small-container cart-page\">
        <table>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
            <tr>
                <td>
                    <div class=\"cart-info\">
                        <img src =" . $produit->getFilepath() . ">
                        <div>
                            <p>" . $produit->getNomProduit() . "</p>
                            <small>Prix: " . $produit->getPrix() . "€" . " </small>
                            <br>
                            <form class =\"btn-remove\" method=\"post\" action=\"?controller=ControllerUtilisateur&action=retirerProduitPanier\">
                                <input type=\"hidden\" name=\"idProduit\" value ='$p'>
                                <input type=\"submit\" class=\"button\" value=\"Supprimer\">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form method=\"post\" action=\"?controller=ControllerUtilisateur&action=updateQuantity\">
                        <input type=\"hidden\" name=\"idProduit\" value ='$p'>
                        <input class=\"quantite\" name=\"quantite\" type=\"number\" value='$qte' onchange='this.form.submit()'>
                      </form>
                </td>
                <td>" . $produit->getPrix() * $qte . "€" . "</td>
            </tr>
        </table>";
        }
        $_SESSION["prixTotal"] = $prix;
        echo "<div class=\"total-price\">
            <table>
                <tr>
                    <td>Total: " . $prix . "€" . "</td>
                </tr> 
            </table>
        </div>
    </div>";

    echo "
        <div class=\"btn-control\">
            <a href=\"?controller=ControllerUtilisateur&action=annulerPanier\">Supprimer le panier</a>
            <a href=\"?controller=ControllerUtilisateur&action=validerPanier\">Finir la Commande</a>
        </div>";
}
?>
