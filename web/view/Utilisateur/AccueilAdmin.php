<div class="admin-container2">
    <div class="text">
        Ajouter un admin
    </div>
    <form method="post" action="?controller=ControllerUtilisateur&action=upgradeAdmin">
        <div class="data">
            <label>Adresse mail</label>
            <input type="email" name="mail" placeholder="Entre le mail de la personne à passer admin">
        </div>
        <div class="btn">
            <div class="inner"></div>
            <button type="submit" class="submit-btn">Ajouter</button>
        </div>
    </form>
</div>
<div class="admin-container1">
    <div class="text">
        Ajouter un produit
    </div>
    <form method="post" action="?controller=ControllerProduit&action=created" enctype="multipart/form-data">
        <div class="data">
            <label>Nom du produit</label>
            <input type = "text" name="nomProduit" placeholder="Entrez le nom du produit" required>
        </div>
        <div class="data">
            <label>Prix</label>
            <input type = "number" name="prix" placeholder="Entrez le prix du produit" required>
        </div>
        <div class="data1">
            <label>Categorie</label>
            <select name="categorie">
                <option value ="football">Football</option>
                <option value ="badminton">Badminton</option>
                <option value ="tennis">Tennis</option>
                <option value ="running">Running</option>
                <option value ="basket">Basket</option>
                <option value ="ping-pong">Ping-Pong</option>
            </select>
            <input type = "file" name="file" required>
        </div>
        <div class="data-desc">
            <label>Description</label>
            <textarea name="description" placeholder="Entrez la description du produit" rows="5"cols="65"></textarea>
        </div>
        <div class="btn">
            <div class="inner"></div>
            <button type="submit" name="submit" class="submit-btn">Ajouter</button>
        </div>
    </form>
</div>