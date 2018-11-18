 <div class="container">
          <div class="content mt-3">
                <div class="animated fadeIn">
                  <div>
                      <div style="margin-left: 200px" class="row">
                      <div class="col-md-12 col-md-offset-2">
                          <div class="box">
                              <h2>Liste des Entreprises</h2>
                           <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">NumSiret</th>
                                    <th scope="col">nomEntreprise</th>
                                    <th scope="col">adresseEntreprise</th>
                                    <th scope="col">codePEntreprise</th>
                                    <th scope="col">VilleEntreprise</th>
                                    <th scope="col">horairesEntreprise</th>
                                    <th scope="col">livraisonEntreprise</th>
                                    <th scope="col">tempsReservMax</th>


                                </tr>
                            </thead>
                          <tbody>
                                <tr>
                                  <?php foreach ($entreprises as $item) { ?>
                                    <td><?php echo $item->numSiret; ?></td>
                                    <td><?php echo $item->nomEntreprise; ?></td>
                                    <td><?php echo $item->adresseEntreprise; ?></td>
                                    <td><?php echo $item->codePEntreprise; ?></td>
                                    <td><?php echo $item->villeEntreprise; ?></td>
                                    <td><?php echo $item->horairesEntreprise; ?></td>
                                    <td><?php echo $item->livraisonEntreprise; ?></td>
                                    <td><?php echo $item->tempsReservMax; ?></td>
                                  </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
														</div>
                            </div>
                          </div>
                          </div>
                        </div>

                  <br></br>
                      <br></br>

                     
                      </div>
                      </div> 
