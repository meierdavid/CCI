 <div class="container">
          <div class="content mt-3">
                <div class="animated fadeIn">
                  <div>
                      <div style="margin-left: 60px" class="row">
                      <div class="col-md-12 col-md-offset-2">
                          <div class="box">
                            <h4 class="text-center"> Liste des entreprises</h4>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">


                                </article>
                                <article class=" col-md-11 col-lg-11">
                           <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">NumSiret</th>
									<th scope="col">Logo</th>
                                    <th scope="col">nomEntreprise</th>
                                    <th scope="col">adresseEntreprise</th>
                                    <th scope="col">codePEntreprise</th>
                                    <th scope="col">VilleEntreprise</th>
                                    <th scope="col">horairesEntreprise</th>
                                    <th scope="col">livraisonEntreprise</th>
                                    <th scope="col">tempsReservMax</th>
									<th scope="col">Site Web</th>
									<th scope="col">Solde</th>
                                    <th scope="col">Modifier</th>


                                </tr>
                            </thead>
                          <tbody>
                                <tr>
                                  <?php foreach ($entreprises as $item) { ?>
                                    <td><?php echo $item->numSiret; ?></td>
									<?php
									if ($item->logoEntreprise == NULL) {
										$item->logoEntreprise = "not_found.jpg";
									}
									?>
									<td><img src="http://localhost/cci/index.php/../assets/image/logos/<?php echo $item->logoEntreprise; ?>"  class="img-thumbnail"></td>
                                    <td><?php echo $item->nomEntreprise; ?></td>
                                    <td><?php echo $item->adresseEntreprise; ?></td>
                                    <td><?php echo $item->codePEntreprise; ?></td>
                                    <td><?php echo $item->villeEntreprise; ?></td>
                                    <td><?php echo $item->horairesEntreprise; ?></td>
                                    <td><?php echo $item->livraisonEntreprise; ?></td>
                                    <td><?php echo $item->tempsReservMax; ?></td>
									<td><?php echo $item->siteWebEntreprise; ?></td>
									<td><?php echo $item->soldeEntreprise . "€"; ?></td>
                                    <td><p><a href="<?php echo base_url("CommercantCtrl/detail_entreprise/".$item->numSiret );?>">Modifier l'entreprise</a></p></td>
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

                  <br>
                      <br>


                      </div>
                      </div>
