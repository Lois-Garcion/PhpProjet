<div class="head">
    <h1>Nos produits</h1>
    <hr/>
</div>
<section class = "products">
    <?php
    if($tab_produit == false){
        echo "Il n'y a pas de produit";
    }
    foreach ($tab_produit as $v){
        echo "
            <div class = \"product-card\">
                <div class = \"product-image\">
                    <img src =\"assets/images/raquette-yonex.jpg\">
                </div>
                <div class = \"product-info\">
                    <h5>" . $v->getNomProduit() . "</h5>
                    <h6>" . $v->getPrix() ."€". "<h6>
                </div>
            </div>
            <div class = \"formulaire\">
                <div class = \"container\">
                    <form method=\"post\" action=\"?controller=ControllerUtilisateur&action=ajoutPanier\">
                        <input type = \"hidden\" name = \"idProduit\" value=\" ". $v->getIdProduit() . " \" required>
                        <div class=\"input-group\">
                        <label>Quantité</label>
                        <input type = \"number\" name=\"quantite\" placeholder=\"Quantité\" required>
                        </div>                     
                        <div class=\"input-group\">
                        <button type=\"submit\" name=\"submit\" class=\"submit-btn\">Ajouter</button>
                        </div>    
                        </form>                    
                    </div>
                
                ";

    }
    ?>
</section>
