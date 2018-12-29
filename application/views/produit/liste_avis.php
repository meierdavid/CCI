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
                                    <th scope="col">Avis</th>
                                </tr>
                            </thead>
                          <tbody>
                                <tr>
                                  <?php var_dump($_COOKIE);foreach ($avis as $item) { ?>
                                    <td><?php echo $item->idClient; ?></td>
                                    <td><?php echo $item->avisClient; ?></td>
                                    

                                  
                                  <?php } ?>
                                </tr>
                                </tbody>
                              </table>
                           </div>
                               <a href="<?php echo base_url("ClientCtrl/ajouter_avis/").$produit[0]->idProduit; ?>">Donnez votre avis</a>
                           </article>
                                
                            </div>
                            </div>
                         
                         
                        </div>

                  <br></br>
                      <br></br>

                     
                      </div>
                      </div> 
