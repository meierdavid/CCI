
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" style="margin-left: 200px;">

            <?php echo form_open('PanierCtrl/ajout_panier');
            var_dump($produit[0]);
            die;?>
                    <br></br>
                    <div class="form-group">
                        <label class="control-label">Nom du Produit</label>
                        <input type="text" class="form-control" name="nomProduit" value="<?php echo  $produit[0]->nomProduit; ?>" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Categorie du Produit</label>
                        <input type="text" class="form-control" name="categorieProduit" value=" <?php echo $produit[0]->categorieProduit; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description du Produit</label>
                        <input type="text" class="form-control" name="descriptionProduit" value="<?php echo $produit[0]->descriptionProduit; ?>" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Prix Unitaire du Produit</label>
                        <input type="text" class="form-control" name="prixUnitaireProduit" value="<?php echo $produit[0]->prixUnitaireProduit; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Réduction sur le Produit</label>
                        <input type="text" class="form-control" name="reducProduit" value="<?php  echo $produit[0]->reducProduit; ?>" size="30" required/>
                    </div>
					<div class="form-group">
                        <label class="control-label">Couleur du Produit</label>
                        <input type="text" class="form-control" name="couleurProduit" value="<?php  echo $produit[0]->couleurProduit; ?>" size="30" required/>
                    </div>
					<div class="form-group">
                        <label class="control-label">Quantité souhaitée</label>
                        <input type="number" class="form-control" name="quantite" value="1" size="30" required/>
                    </div>

                    <div class="text-center">
                        <label class="control-label">Livraison: </label>
                        <input type="radio"  name="livraison" value="Oui" required/>Oui
                        <input type="radio"  name="livraison" value="Non" required/>Non
                    </div>

                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Ajouter"/></div>
                    <div class="text-center">


                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br></br>
            <br></br>



            </div>
        </div>
    </div>
</div>
