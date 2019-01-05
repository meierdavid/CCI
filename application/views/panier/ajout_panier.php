<link href="<?php echo base_url()."../template/css/affichage_produit.css"; ?>" rel="stylesheet" type="text/css" media="all" />
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eCommerce Product Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  </head>

  <body>
	
	<div class="container">
	<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						<?php
				if ($produit[0]->imageProduit == NULL) {
					$produit[0]->imageProduit = "not_found.jpg";
				}
				?>
						  <div class="tab-pane active" id="pic-1"><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>" /></div>
						</div>						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo $produit[0]->nomProduit; ?></h3>
						
						<h6>Vendu par : <strong><a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$entreprise[0]->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a></strong></br></br></h6></br>

						<h4 class="price">Prix: <?php
											if ($produit[0]->reducProduit !=0){
												echo  "<span>" . (intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 ))  . "€ </span>" . "  au lieu de <span> " . $produit[0]->prixUnitaireProduit . "€ </span>" ;
											}
											else {
												echo "<span>" .$produit[0]->prixUnitaireProduit . "€ </span>" ;
											}
											?> </h4>
						
						
						<h6>
						<?php if ($entreprise[0]->livraisonEntreprise == TRUE) { 
                echo "<p><strong> Cet article est éligible à la livraison </strong></p><br/><br/>";
            
            } else {
                echo "<p><strong> Cet article n'est pas éligible à la livraison </strong></p>";
            }
            ?>
					</h6>	
					<h6> Il reste <strong><?php echo "  ".$produit[0]->nbDispoProduit . "  "; ?></strong>	 articles disponibles </br></br></h6>	
					
					<div class="form-login" >

			<?php echo form_open_multipart('PanierCtrl/ajout_panier/' . $produit[0]->idProduit); ?>
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
                    <input type="number" class="form-control" name="quantite" value="0" size="30" min="1" max="<?php echo $produit[0]->nbDispoProduit; ?>" required/>
                </div>
				</br>
                 <?php if($entreprise[0]->livraisonEntreprise == 1){?>
                <div class="text-center">
                    <label class="control-label">Livraison: </label>
                    <input type="radio"  name="livraison" value="Oui" required/>Oui
                    <input type="radio"  name="livraison" value="Non" required/>Non
                </div>
                <?php }else { ?>
                     <div class="text-center">
                         <label class="control-label">Cet article doit être retiré en magasin </label>
                         <input type="hidden" name="livraison" value="Non" required/>
                     </div>
                <?php } ?>                    
                                <br>	

					
						
						<div class="text-center"><input class="add-to-cart btn btn-default" type="submit" value="Ajouter au panier" href="<?php echo base_url("PanierCtrl/ajout_panier/".$produit[0]->idProduit); ?>" ></div>
	   
                </form>
                <br></br>
            </div>
			</div>
					
					<div class="action">
						<a class= "btn btn-default"href="<?php echo base_url("ProduitCtrl/comparer_produit/" . $produit[0]->idProduit); ?>">Comparer avec des articles similaires</a>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>

