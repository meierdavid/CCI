<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div>
                <div class="row">
                    
                        <div class="box">
                            <h2><?php echo $produit[0]->categorieProduit; ?></h2>
                            
                                <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
												<th scope="col"></th>
												<th scope="col"></th>
												<th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php $i = 0 ; 
											var_dump($i);
											?>
											var_dump($i);
                                            <tr>
                                                <?php foreach ($produit as $item) { ?>
												<?php if ($i%3 == 0) { ?>
													<td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="rounded float-left"  alt="Responsive image"></td>
                                                <?php } ?>
												
												<?php if ($i%3 == 1) { ?>
													<td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="rounded mx-auto d-block"  alt="Responsive image"></td>
                                                <?php } ?>
												
												<?php if ($i%3 == 2) { ?>
													<td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="rounded float-right"  alt="Responsive image"></td>
                                                <?php } ?>
												<?php $i=$i+1 ;?>
												
												
												<!--<td><p><a href="<?php echo base_url("ProduitCtrl/detail_produit/".$item->idProduit );?>">Details du produit</a></p></td> 
												<td><p><a href="<?php echo base_url("ProduitCtrl/supprimer_produit/".$item->idProduit );?>">Ajouter au pannier</a></p></td>
												<td><p><a href="<?php echo base_url("ProduitCtrl/liste_avis/" . $item->idProduit); ?>">Voir les avis</a></p></td>
                                                -->
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                </div>
                       
                        </div>
                    
                </div>
            </div>

            <br></br>
            <br></br>


        </div>
    </div>
</div>