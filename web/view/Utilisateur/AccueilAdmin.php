<p>Ici c'est l'accueil admin, tout le monde est super cool</p>

<h2>Ajouter un admin</h2>

<form method="post" action="?controller=ControllerUtilisateur&action=upgradeAdmin">
    <label>Adresse mail</label>
    <input type="text" name="mail" placeholder="Entre le mail de la personne à passer admin">
    <input type="submit" class="button" value="Valider">
</form>
    <div class = "formulaire">
        <div class = "container">
            <div class = "title">
                <h1>Ajouter un produit</h1>
            </div>
            <form method="post" action="?controller=ControllerProduit&action=created" enctype="multipart/form-data">
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
                    <select name="categorie">
                        <option value ="football">Football</option>
                        <option value ="badminton">Badminton</option>
                        <option value ="tennis">Tennis</option>
                        <option value ="running">Running</option>
                        <option value ="basket">Basket</option>
                        <option value ="ping-pong">Ping-Pong</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Description</label>
                    <textarea name="description" rows="8" cols="50">Entrez la description du produit</textarea>
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