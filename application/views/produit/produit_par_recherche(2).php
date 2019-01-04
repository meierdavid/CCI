<link href="<?php echo base_url()."../template/css/liste_produit_client.css"; ?>" rel="stylesheet" type="text/css" media="all" />


<div class="container">
    <h3 class="h3"></br>Recherche</h3>
    <div class="row">
	</br>
	<?php foreach ($produit as $item) { ?>
		<?php
			if ($item->imageProduit == 'NULL') {
				$item->imageProduit = "not_found.jpg";
			}
		?>
        <div class="col-md-3 col-sm-6">
            <div class="product-grid7">
                <div class="product-image7">
                    <a href="#">
                        <img class="pic-1" width="150" height="150" src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>" width=5 height=150>
                    </a>
                    <ul class="social">
                        <li><a href="<?php echo base_url("ProduitCtrl/affichage_produit/" . $item->idProduit); ?>" class="fa fa-search"></a></li>
                        <li><a href="<?php echo base_url("PanierCtrl/ajout_panier/".$item->idProduit); ?>" class="fa fa-shopping-bag"></a></li>
                        <li><a href="<?php echo base_url("ProduitCtrl/liste_avis/" . $produit[0]->idProduit); ?>" class="fa fa-heart"></a></li>
                    </ul>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php echo base_url("ProduitCtrl/affichage_produit/" . $item->idProduit); ?>"><?php echo $item->nomProduit?></a></h3>
                    <div class="price"><?php
											if ($item->reducProduit !=0){
												echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100 )  . "€" ;
											}
											else {
												echo $item->prixUnitaireProduit . "€" ;
											}
											?>
                        <span><?php
											if ($item->reducProduit !=0){
												echo $item->prixUnitaireProduit . "€" ;
											}
											?>
											</span>
											</br></br>
                    </div>
                </div>
            </div>
        </div>
	<?php } ?>
        
    </div>
</div>
<hr>