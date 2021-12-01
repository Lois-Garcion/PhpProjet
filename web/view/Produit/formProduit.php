<div class = "formulaire">
    <div class = "container">
        <div class = "title">
            <h1>Ajouter un produit</h1>
        </div>
        <form method="post" action="?controller=ControllerProduit&action=created">
            <div class="input-group">
                <label>Identifiant produit</label>
                <input type = "number" name="idProduit" placeholder="Entrez l'id du produit" required>
            </div>
            <div class="input-group">
                <label>Nom du produit</label>
                <input type = "text" name="nomProduit" placeholder="Entrez le nom du produit" required>
            </div>
            <div class="input-group">
                <label>Prix</label>
                <input type = "number" name="prix" placeholder="Entrez le prix du produit" required>
            </div>
            <div class="input-group">
                <label>Categorie</label>
                <input type = "text" name="categorie" placeholder="Entrez la catégorie du produit" required>
            </div>
            <div class="input-group">
                <label>Image</label>
                <input type = "file" name="file" required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="submit-btn">Ajouter</button>
            </div>
        </form>
    </div>
</div>