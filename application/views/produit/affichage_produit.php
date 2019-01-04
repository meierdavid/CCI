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
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>" /></div>
						</div>						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo $produit[0]->nomProduit; ?></h3>
						
						<h6>Vendu par : <strong><a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$entreprise[0]->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a></strong></br></br></h6></br>
						<h6>Catégorie : <strong><?php echo $produit[0]->categorieProduit; ?></strong></br></br></h6>
						<p class="product-description"><?php echo $produit[0]->descriptionProduit; ?></p>
						<h4 class="price">Prix: <?php
											if ($produit[0]->reducProduit !=0){
												echo  "<span>" . (intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 ))  . "€ </span>" . "  au lieu de <span> " . $produit[0]->prixUnitaireProduit . "€ </span>" ;
											}
											else {
												echo "<span>" .$produit[0]->prixUnitaireProduit . "€ </span>" ;
											}
											?> </h4>
						
						<p class="vote">Les consommateurs ont mis une note de : <strong><?php
						$this->load->model('poster_avis');
						echo $this->poster_avis->moyenne($produit[0]->idProduit);
						?></strong></p>
						<h6>
						<?php if ($entreprise[0]->livraisonEntreprise == TRUE) { 
                echo "<p><strong> Cet article est éligible à la livraison </strong></p><br/><br/>";
            
            } else {
                echo "<p><strong> Cet article n'est pas éligible à la livraison </strong></p>";
            }
            ?>
					</h6>	
					<h6> Il reste <strong><?php echo "  ".$produit[0]->nbDispoProduit . "  "; ?></strong>	 articles disponibles </br></br></h6>	
						<h5 class="colors">Couleur : 
							<div  class="text-center" style="background-color: <?php echo $produit[0]->couleurProduit; ?>; width: 40px;
                 height: 40px; border-radius: 40px; margin-left: 20px; display: inline-block; vertical-align: middle;">
            </div>

							</br></br>
						</h5>
						
						<div class="action">
							<a class="add-to-cart btn btn-default" type="button" href="<?php echo base_url("PanierCtrl/ajout_panier/".$produit[0]->idProduit); ?>" >Ajouter au panier</a>
							<a class="like btn btn-default" type="button" href="<?php echo base_url("ProduitCtrl/liste_avis/" . $produit[0]->idProduit); ?>" ><span class="fa fa-heart"  >AVIS</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
