<link href="<?php echo base_url()."../template/css/liste_produit_client.css"; ?>" rel="stylesheet" type="text/css" media="all" />


<div class="container">
<div class="text-center">
    <h1></br>Liste des Entreprises</h1>
</div>
    <div class="row">
	</br> </br>
	<?php foreach ($entreprises_header as $item) { ?>
		<?php
			if ($item->logoEntreprise == 'NULL') {
				$item->logoEntreprise = "not_found.jpg";
			}
		?>
        <div class="col-md-3 col-sm-6">
            <div class="product-grid7">
                <div class="product-image7">
                    
                        <img class="pic-1" width="150" height="150" src="http://localhost/cci/index.php/../assets/image/logos/<?php echo $item->logoEntreprise; ?>" width=5 height=150>
                    
                    <ul class="social">
                        <li><a href="<?php echo base_url("EntrepriseCtrl/affichage_entreprise/" . $item->numSiret); ?>" class="fa fa-search"></a></li>
                    </ul>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php echo base_url("EntrepriseCtrl/affichage_entreprise/" . $item->numSiret); ?>"><?php echo $item->nomEntreprise?></a></h3>
                </div>
            </div>
        </div>
	<?php } ?>
        
    </div>
</div>
<hr>