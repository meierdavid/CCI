 <div class="container">
          <div class="content mt-3">
                <div class="animated fadeIn">
                  <div>
                      <div style="margin-left: 60px" class="row">
                      <div class="col-md-12 col-md-offset-2">
                          <div class="box">
                            <h2 class="text-center"> Liste des avis</h2>
                            <div class="row">
                                <article class=" col-md-1 col-lg-1">
                                    
                                    
                                </article>
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
                                  <?php foreach ($avis as $item) { ?>
                                    <td><?php echo $item->idClient; ?></td>
                                    <td><?php echo $item->avisClient; ?></td>
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
