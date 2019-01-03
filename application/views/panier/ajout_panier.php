<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->

    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" style="margin-left: 200px;">

            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>

            <?php echo form_open('PanierCtrl/ajout_panier/'. $produit[0]->idProduit);?>
                    <br></br>
                    <div class="text-center">
                    <h2>Ajouter au panier</h2>
                    <h4>veuillez remplir la quantité souhatée</h4>
                    </div>
                    <br></br>

                    <div class="text-center">
                        <label class="control-label">Nom du Produit</label>
                        <input type="text" class="form-control" name="nomProduit" value="<?php echo  $produit[0]->nomProduit; ?>" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>
                    <div class="text-center">
                        <label class="control-label">Categorie du Produit</label>
                        <input type="text" class="form-control" name="categorieProduit" value=" <?php echo $produit[0]->categorieProduit; ?>" size="30" required/>
                    </div>
                    <div class="text-center">
                        <label class="control-label">Description du Produit</label>
                        <input type="text" class="form-control" name="descriptionProduit" value="<?php echo $produit[0]->descriptionProduit; ?>" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>
                    <div class="text-center">
                        <label class="control-label">Prix Unitaire du Produit</label>
                        <input type="text" class="form-control" name="prixUnitaireProduit" value="<?php echo $produit[0]->prixUnitaireProduit; ?>" size="30" required/>
                    </div>
                    <div class="text-center">
                        <label class="control-label">Réduction sur le Produit</label>
                        <input type="text" class="form-control" name="reducProduit" value="<?php  echo $produit[0]->reducProduit; ?>" size="30" required/>
                    </div>
                    <div class="text-center">
                        <label class="control-label">Prix du Produit après réduction</label>
                        <input type="text" class="form-control" name="prixUnitaireProduit" value="<?php echo intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100); ?>" size="30" required/>
                    </div>
					<div class="text-center">
                        <label class="control-label">Couleur du Produit</label>
                        <input type="text" class="form-control" name="couleurProduit" value="<?php  echo $produit[0]->couleurProduit; ?>" size="30" required/>
                    </div>
					<div class="text-center">
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
