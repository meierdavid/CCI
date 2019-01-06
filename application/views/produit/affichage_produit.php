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

						<h6>Vendu par : <strong><a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$entreprise[0]->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a></strong></h6>
						<h6>Catégorie : <strong><?php echo $produit[0]->categorieProduit; ?></strong></h6>
						<p class="product-description"><?php echo $produit[0]->descriptionProduit; ?></p>
						<h4 class="price">Prix: <?php
											if ($produit[0]->reducProduit !=0){
												echo  "<span>" . (intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 ))  . "€ </span>" . "  au lieu de <span> " . $produit[0]->prixUnitaireProduit . "€ </span>" ;
											}
											else {
												echo "<span>" .$produit[0]->prixUnitaireProduit . "€ </span>" ;
											}
											?> </h4>
						<?php
						$this->load->model('poster_avis');
            if ($this->poster_avis->selectByIdProduit($produit[0]->idProduit) != null) {
              echo "<p class='vote'>Les consommateurs ont mis une note de : <strong>".$this->poster_avis->moyenne($produit[0]->idProduit)."</strong></p>";
            }
						else{
              echo "<p class='vote'>Cet article n'a pas encore d'avis</p>";
            }
						?>
						<h6>
						<?php if ($entreprise[0]->livraisonEntreprise == TRUE) {
                echo "<p><strong> Cet article est éligible à la livraison </strong></p><br/><br/>";

            } else {
                echo "<p><strong> Cet article n'est pas éligible à la livraison </strong></p>";
            }
            ?>
					</h6>
					<h6> Il reste <strong><?php echo "  ".$produit[0]->nbDispoProduit . "  "; ?></strong>	 articles disponibles </h6>
						<h5 class="colors">Couleur :
							<div  class="text-center" style="background-color: <?php echo $produit[0]->couleurProduit; ?>; width: 40px;
                 height: 40px; border-radius: 40px; margin-left: 20px; display: inline-block; vertical-align: middle;">
            </div>

							
						</h5>

						<div class="action">
							<a class="add-to-cart btn btn-default" type="button" href="<?php echo base_url("PanierCtrl/ajout_panier/".$produit[0]->idProduit); ?>" >Ajouter au panier</a>
							<a class="like btn btn-default" type="button" href="<?php echo base_url("ProduitCtrl/liste_avis/" . $produit[0]->idProduit); ?>" ><span class="fa fa-heart"  >AVIS</span></a>
						</div>
					</div>
					<div class="action">
						<a class= "btn btn-default"href="<?php echo base_url("ProduitCtrl/comparer_produit/" . $produit[0]->idProduit); ?>">Comparer avec des articles similaires</a>
						</div>
					</div>
				</div>
				 
    <h6><strong>Autres produits pouvant vous intéresser :</strong></h6>
    <br>
    <div class="row mb-2">
                     <?php foreach ($produitsProposés as $item) { ?>
        <div class="col-md-4">
			<div class="text-center">
                         <?php
                         echo "<h6>" . $item->nomProduit . " </h6><br>";

                         if ($item->imageProduit == NULL) {
                             $item->imageProduit = "not_found.jpg";
                         }
                         ?>

            <a href="<?php echo base_url("ProduitCtrl/affichage_produit/" . $item->idProduit); ?> "><img  src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="rounded float-left"  alt="Pas d'image disponible"></a>
            </div>
		</div>
<?php } ?>

    </div>
			</div>

		</div>
	</div>
  </body>
</html>
