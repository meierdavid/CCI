
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->

<div class="container">
    <div class="row">


        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <div class="text-center">
            <h2>Ajouter au panier</h2>
            <br>
            <h4>veuillez remplir la quantité souhatée</h4>
        </div>
        <br><br>
        <div class="row mb-2">
            <div class="col-md-4">
                <br></br>

                <img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible">
                <br></br>
                Couleur de l'article :
                <div style="background-color: <?php echo $produit[0]->couleurProduit; ?>; width: 40px;
                     height: 40px; border-radius: 20px;">
                </div>

            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label class="control-label"><?php echo $produit[0]->nomProduit; ?></label>
                </div>


                <p><?php echo $produit[0]->descriptionProduit; ?> </p>
                <p> de : <a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/" . $entreprise[0]->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a>
                    <br>

                <p><a href="<?php echo base_url("ProduitCtrl/liste_avis/" . $produit[0]->idProduit); ?>">Voir les avis</a></p>
                ____________________________________________________________________

                <br><br>
                <p>Prix : <?php echo $produit[0]->prixUnitaireProduit; ?> € </p>
                <?php
                if ($produit[0]->reducProduit > 0) {
                    echo "<p> bénéficiez d'une réducion de " . $produit[0]->reducProduit . "% </p>";
                    echo "<p> Soit au prix exceptionnel de : " . (intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 )) . "€ </p>";
                }
                ?>
                <br>
                <?php if ($entreprise[0]->livraisonEntreprise == TRUE) { ?>
                    <p> Cet article est éligible à la livraison </p>
                    <?php
                } else {
                    echo "<p> Cet article n'est pas éligible à la livraison </p>";
                }
                ?>

                <p> Il reste : <?php echo $produit[0]->nbDispoProduit; ?>	articles disponibles </p>
                <br>
                <p><a href="<?php echo base_url("ProduitCtrl/comparer_produit/" . $produit[0]->idProduit); ?>">Comparer avec des articles similaires</a></p>
                <br>
            </div>


            <br></br>
            <br></br>


        </div>

        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
<?php echo form_open('PanierCtrl/ajout_panier/' . $produit[0]->idProduit); ?>
                <br></br>

                <br>
                <input type="hidden" class="form-control" name="nomProduit" value="<?php echo $produit[0]->nomProduit; ?>" size="30" />
                <input type="hidden" class="form-control" name="categorieProduit" value=" <?php echo $produit[0]->categorieProduit; ?>" size="30" required/>
                <input type="hidden" class="form-control" name="descriptionProduit" value="<?php echo $produit[0]->descriptionProduit; ?>" size="30" required/>
                <input type="hidden" class="form-control" name="prixUnitaireProduit" value="<?php echo $produit[0]->prixUnitaireProduit; ?>" size="30" required/>                 
                <input type="hidden" class="form-control" name="reducProduit" value="<?php echo $produit[0]->reducProduit; ?>" size="30" required/>
                <input type="hidden" class="form-control" name="prixUnitaireProduit" value="<?php echo intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100); ?>" size="30" required/>
                <input type="hidden" class="form-control" name="couleurProduit" value="<?php echo $produit[0]->couleurProduit; ?>" size="30" required/>                   
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

                </div>
                </form>
                <br></br>
                <br></br>
            </div></div>



    </div>
</div>
