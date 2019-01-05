<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
body {
	font-family: "Open Sans", sans-serif;
}
h2 {
	color: #000;
	font-size: 26px;
	font-weight: 300;
	text-align: center;
	text-transform: uppercase;
	position: relative;
	margin: 30px 0 80px;
}
h2 b {
	color: #ffc000;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 4px;
	background: rgba(0, 0, 0, 0.2);
	left: 0;
	right: 0;
	bottom: -20px;
}
.carousel {
	margin: 50px auto;
	padding: 0 70px;
}
.carousel .item {
	min-height: 330px;
    text-align: center;
	overflow: hidden;
}
.carousel .item .img-box {
	height: 160px;
	width: 100%;
	position: relative;
}
.carousel .item img {	
	max-width: 100%;
	max-height: 100%;
	display: inline-block;
	position: absolute;
	bottom: 0;
	margin: 0 auto;
	left: 0;
	right: 0;
}
.carousel .item h4 {
	font-size: 18px;
	margin: 10px 0;
}
.carousel .item .btn {
	color: #333;
    border-radius: 0;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
    background: none;
    border: 1px solid #ccc;
    padding: 5px 10px;
    margin-top: 5px;
    line-height: 16px;
}
.carousel .item .btn:hover, .carousel .item .btn:focus {
	color: #fff;
	background: #000;
	border-color: #000;
	box-shadow: none;
}
.carousel .item .btn i {
	font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}
.carousel .thumb-wrapper {
	text-align: center;
}
.carousel .thumb-content {
	padding: 15px;
}
.carousel .carousel-control {
	height: 100px;
    width: 40px;
    background: none;
    margin: auto 0;
    background: rgba(0, 0, 0, 0.2);
}
.carousel .carousel-control i {
    font-size: 30px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -16px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: rgba(0, 0, 0, 0.8);
    text-shadow: none;
    font-weight: bold;
}
.carousel .item-price {
	font-size: 13px;
	padding: 2px 0;
}
.carousel .item-price strike {
	color: #FFA500;
	margin-right: 5px;
}
.carousel .item-price span {
	color: #00FF00;
	font-size: 110%;
}
.carousel .carousel-control.left i {
	margin-left: -3px;
}
.carousel .carousel-control.left i {
	margin-right: -3px;
}
.carousel .carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border-color: transparent;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}
</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Comparateur de produits</h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
		
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
					</br></br>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $produit[0]->imageProduit; ?>" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4><?php echo $produit[0]->nomProduit; ?></h4>
									<p class="item-price">
									<strike><?php
											if ($produit[0]->reducProduit !=0){
												echo $produit[0]->prixUnitaireProduit . "€" ;
											}
											?>
											</strike>
									
									<span><?php
											if ($produit[0]->reducProduit !=0){
												echo intval($produit[0]->prixUnitaireProduit) - (intval($produit[0]->prixUnitaireProduit) * intval($produit[0]->reducProduit) / 100 )  . "€" ;
											}
											else {
												echo $produit[0]->prixUnitaireProduit . "€" ;
											}
											?></span>
                        
											</br></br></p>
									<h6 align="left"><strong>Description : </strong> <?php echo $produit[0]->descriptionProduit ?></h6>
								</div>										
							</div>
						</div>
						<?php foreach($produitsProposés as $item) {?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4><?php echo $item->nomProduit; ?></h4>
									<p class="item-price">
									<strike><?php
											if ($item->reducProduit !=0){
												echo $item->prixUnitaireProduit . "€" ;
											}
											?>
											</strike>
									
									<span><?php
											if ($item->reducProduit !=0){
												echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100 )  . "€" ;
											}
											else {
												echo $item->prixUnitaireProduit . "€" ;
											}
											?></span>
                        
											</br></br></p>
									<h6 align="left"><strong>Description : </strong> <?php echo $item->descriptionProduit ?></h6>
								</div>	
								</br></br>
							</div>
						</div>	
						<?php }?>						
						
					</div>
					<div class="row">
						<div class="col-sm-3">
							<a href="<?php echo base_url("PanierCtrl/ajout_panier/".$produit[0]->idProduit); ?>" class="btn btn-primary">Ajouter au panier</a>
							</br></br>
						</div>
						<?php foreach($produitsProposés as $item) {?>
						<div class="col-sm-3">
							<a href="<?php echo base_url("PanierCtrl/ajout_panier/".$item->idProduit); ?>" class="btn btn-primary">Ajouter au panier </a>
							</br></br>
						</div>
						<?php } ?>
					</div>
				</div>
				
			</div>
		</div>
		</div>
	</div>
	
</div>
</body>
</html>                                		                            