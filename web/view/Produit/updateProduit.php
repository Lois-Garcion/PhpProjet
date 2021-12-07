<?php $produit = Produit::getById($_GET["id"])?>

<div class="connect-container">
    <div class="text">
        Modifier le produit <?php echo $_GET["id"]?>
    </div>
    <form action="?controller=ControllerProduit&action=update&id=<?php echo $_GET["id"];?>" method="post">
        <div class="data">
            <label>Nom du produit</label>
            <input type="text" name="nomProduit" placeholder="Entrez le nom du produit" value="<?php echo $produit->getNomProduit();?>" required>
        </div>
        <div class="data">
            <label>Prix</label>
            <input type="number" name="prix" placeholder="Entrez le prix du produit" value="<?php echo $produit->getPrix();?>" required>
        </div>
        <div class="data1">
            <label>Categorie</label>
            <select name="categorie">
                <option value ="football" <?php if($produit->getCategorie()=="football")echo"selected"; ?>>Football</option>
                <option value ="badminton" <?php if($produit->getCategorie()=="badminton")echo"selected"; ?>>Badminton</option>
                <option value ="tennis" <?php if($produit->getCategorie()=="tennis")echo"selected"; ?>>Tennis</option>
                <option value ="running" <?php if($produit->getCategorie()=="running")echo"selected"; ?>>Running</option>
                <option value ="basket" <?php if($produit->getCategorie()=="basket")echo"selected"; ?>>Basket</option>
                <option value ="ping-pong" <?php if($produit->getCategorie()=="ping-pong")echo"selected"; ?>>Ping-Pong</option>
            </select>
        </div>
        <div class="data-desc">
            <label>Description</label>
            <textarea name="description" placeholder="Entrez la description du produit" rows="5"cols="65"><?php echo $produit->getDescription(); ?></textarea>
        </div>
        <div class="btn">
            <div class="inner"></div>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>