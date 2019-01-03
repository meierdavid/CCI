<div class="container">
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="text-center">
                <div style="margin-left: 0px" class="row">
                    <div class="col-md-12 col-md-offset-2">
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
                                                  <th scope="col">Description</th>
                                                  <th scope="col">Catégorie</th>
                                                  <th scope="col">Prix</th>
                                                  <th scope="col">Réduction</th>
                                                  <th scope="col">Prix final</th>
                                                  <th scope="col">Couleur</th>
                                                  <th scope="col">Quantité</th>
                                                  <th scope="col">Livraison</th>
                                                  <th scope="col">Supprimer</th>
                                                  <th scope="col">Modifier</th>

                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <?php foreach ($produits as $item) { ?>
                                                      <?php
                                                      if ($item->imageProduit == NULL) {
                                                          $item->imageProduit = "not_found.jpg";
                                                      }
                                                      ?>
                                                      <td><img src="http://localhost/cci/index.php/../assets/image/produits/<?php echo $item->imageProduit; ?>"  class="img-thumbnail"></td>
                                                      <td><?php echo $item->nomProduit; ?></td>
                                                      <td><?php echo $item->descriptionProduit; ?></td>
                                                      <td><?php echo $item->categorieProduit; ?></td>
                                                      <td><?php echo $item->prixUnitaireProduit; ?>€</td>
                                                      <td><?php echo $item->reducProduit; ?>%</td>
                                                      <td><?php echo intval($item->prixUnitaireProduit) - (intval($item->prixUnitaireProduit) * intval($item->reducProduit) / 100); ?>€</td>
                                                      <td><?php echo $item->couleurProduit; ?></td>
                                                      <td><?php echo $commander[0]->quantiteProd; ?></td>
                                                      <td><?php if ($commander[0]->livraisonCommande == 1){
                                                        echo "Oui";
                                                      }
                                                      else echo  "Non"?></td>
                                                      <td><p><a href="<?php echo base_url("PanierCtrl/supprimer_produit/" . $item->idProduit); ?>">Supprimer le produit</a></p></td>
                                                      <td><p><a href="<?php echo base_url("PanierCtrl/detail_produit/" . $item->idProduit); ?>">Modifier le produit</a></p></td>

                                                  </tr>
                                                      <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br></br>
            <br></br>


        </div>
    </div>
