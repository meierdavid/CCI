<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th class="text-center">Prix</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
				<?php $i=0;
				$this->load->model('entreprise');
				   foreach ($produits as $item) {
					  $entreprise=$this->entreprise->selectById($item->numSiret);
					  if ($item->imageProduit == NULL) {
						  $item->imageProduit = "not_found.jpg";
					  }
					
					  ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 style="margin-left: 15px; margin-top: 0px;" class="media-heading"><a href="#"><?php echo $item->nomProduit ;?></a></h4>
                                <h5 style="margin-left: 15px; margin-top: 0px;" class="media-heading"> by <a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$item->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a></h5>
                                <span style="margin-left: 15px; margin-top: 0px;">Quantité restante : </span><span class="text-success"><strong><?php echo "  ".$item->nbDispoProduit . "  "; ?></strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                       <h5><?php echo $commander[$i]->quantiteProd; ?></h5>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100); ?>€</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo (intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100))*$commander[$i]->quantiteProd; ?>€</strong></td>
                        <td class="col-sm-1 col-md-1">
						<a href="<?php echo base_url("PanierCtrl/supprimer_produit_panier/" . $item->idProduit); ?>">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" ></span> Supprimer
                        </button></a></td>
						<td class="action">
						<a href="<?php echo base_url("PanierCtrl/modifier/" . $item->idProduit); ?>">
                        <button type="button" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil"  ></span> Modifier
                        </button></a></td>
                    </tr>
					<?php $i=$i+1;?>
				   <?php } ?>
                    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Sous-Total</h5></td>
                        <td class="text-right"><h5><strong><?php echo $panier[0]->prixTotPanier . " €" ?></strong></h5></td>
                    </tr>
                    
					
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Code Promo :</h5></td>
						<?php echo form_open('bonReducCtrl/utiliser_bonReduc/'); ?>
                        <td class="text-right"><h5><input type="text" class="form-control" name="couleurProduit" value=" " size="30" required/></h5></td>
                    </tr>
					
					<tr>
                 
                        <td><h5>Nombre de points client : </h5></td>
                        <td><h5><strong><?php echo $client[0]->pointClient . "</strong>" ?></h5></td>
                        <td>   </td>
						<td>   
						<a href="#">
                        <button type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-eur"></span> Utiliser mes points
                        </button></a>
						</td>
                        <td> </td>
                    </tr>
					
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong><?php echo $panier[0]->prixTotPanier . " €" ?></strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
						<a href="<?php echo base_url("PanierCtrl/supprimer_panier/".$panier[0]->idPanier); ?>">
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-erase"></span> Supprimer le panier
                        </button></a></td>
                        <td>
                        <button type="button" class="btn btn-success">
                            Acheter <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>