
<div class="product-container">
    <div class="product-left-column">
        <img src ="<?php echo $produit->getFilepath(); ?>">
    </div>

    <div class="product-right-column">
        <div class="product-description">
            <span><?php echo $produit->getCategorie(); ?></span>
            <h1><?php echo $produit->getNomProduit(); ?></h1>
            <p><?php echo $produit->getDescription(); ?></p>
        </div>
        <div class="product-price">
            <span><?php echo $produit->getPrix(); ?>€</span>
            <form method="post" action="?controller=ControllerUtilisateur&action=ajoutPanier">
                <input type = "hidden" name = "idProduit" value="<?php echo $produit->getIdProduit() ?>" required>
                <input type = "number" name="quantite" value="1" required>
                <button type="submit" name="submit" class="cart-btn">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>