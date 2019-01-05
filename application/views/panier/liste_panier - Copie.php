<div class="container">
    <div class="content">
        <div class="animated fadeIn">
            <div class="text-center">
                
                    
                        <div class="box">
                            <h2>Votre panier</h2>
                            <div class="row">
                              <article class=" col-md-11 col-lg-11">
                                  <div class="table-responsive">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th scope="col">Image</th>
                                                  <th scope="col">Nom</th>
                                                  

                                                  <th scope="col">Prix</th>
                                                  <th scope="col">Réduction</th>
                                                  <th scope="col">Prix final</th>
                                                  
                                                  <th scope="col">Quantité</th>
                                                  <th scope="col">Livraison</th>
                                                  <th scope="col">Supprimer</th>
                                                  <th scope="col">Modifier</th>

                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <?php $i=0;
                                                   foreach ($produits as $item) {
                                                      if ($item->imageProduit == NULL) {
                                                          $item->imageProduit = "not_found.jpg";
                                                      }
                                                      ?>
                                                      <td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="img-thumbnail"></td>
                                                      <td><?php echo $item->nomProduit; ?></td>
                                                      
                                                      
                                                      <td><?php echo $item->prixUnitaireProduit; ?>€</td>
                                                      <td><?php echo $item->reducProduit; ?>%</td>
                                                      <td><?php echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100); ?>€</td>
                                                      
                                                      <td><?php echo $commander[$i]->quantiteProd; ?></td>
                                                      <td><?php if ($commander[$i]->livraisonCommande == 1){
                                                        echo "Oui";
                                                      }
                                                      else echo  "Non"?></td>
                                                      <td><p><a href="<?php echo base_url("PanierCtrl/supprimer_produit_panier/" . $item->idProduit); ?>">Supprimer le produit</a></p></td>
                                                      <td><p><a href="<?php echo base_url("PanierCtrl/modifier/" . $item->idProduit); ?>">Modifier le produit</a></p></td>

                                                  </tr>
                                                      <?php $i=$i+1;
                                                    } ?>
                                          </tbody>
                                      </table>
                                      <div>
                                          <?php echo form_open('bonReducCtrl/utiliser_bonReduc/'); ?>
                                            <div class="text-center">
                                              <label class="control-label">Saisir votre code promo: </label>
                                              <input type="text" class="form-control" name="couleurProduit" value=" " size="30" required/>                   
                                            </div>
                                          <br>
                                            <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Valider"/></div>
                                          </form>
                                      </div>
                                      <div class="text-center">
                                        <label class="control-label">prix total du panier </label>
                                        <input type="text" disabled="disabled" class="form-control" name="prixTotal" step="any" value="<?php echo $panier[0]->prixTotPanier ?>" size="10"/>
                                      </div>
                                      <p><a href="<?php echo base_url("PanierCtrl/supprimer_panier/".$panier[0]->idPanier); ?>">Supprimer le panier</a></p>
                                      <p><a href="<?php echo base_url("PanierCtrl/finaliser/".$panier[0]->idPanier); ?>">Acheter</a></p>
                                  </div>
                              </article>
                            </div>
                        </div>
                   
            </div>

            <br></br>
            <br></br>


        </div>
    </div>
</div>