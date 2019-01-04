 <div class="container">
          <div class="content mt-3">
                <div class="animated fadeIn">
                  <div>
                      
                          <div class="box">
                            <h2 class="text-center"> Liste des avis</h2>
                            <div class="row">
                           
                           <article class=" col-md-11 col-lg-11">
                           <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Identifiant Client</th>
									<th scope="col">Note</th>
                                    <th scope="col">Avis</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                          <tbody>
                                <tr>
                                  <?php foreach ($avis as $item) { ?>
                                    <td><?php echo $item->idClient; ?></td>
									 <td><?php echo $item->noteClient . "/10"; ?></td>
                                    <td><?php echo $item->avisClient; ?></td>
                                    <?php if($client[0]->idClient == $item->idClient){?>
                                    <td><a href="<?php echo base_url("ClientCtrl/modifier_avis/").$produit[0]->idProduit; ?>">Modifiez votre avis</a></td>
                                    <?php } ?>

                                  </tr>
                                  <?php } ?>
                                
                                </tbody>
                              </table>
                           </div>
                                <?php if($client[0]->idClient != $item->idClient){?>
                               <a href="<?php echo base_url("ClientCtrl/ajouter_avis/").$produit[0]->idProduit; ?>">Donnez votre avis</a>
                                <?php } ?>
                           </article>
                                
                            </div>
                            </div>
                         
                         
                        </div>

                  <br></br>
                      <br></br>

                     
                      </div>
                      </div> 
 </div>
