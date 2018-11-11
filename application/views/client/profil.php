       <div class="container">
            <div class="content mt-3">
                <div class="animated fadeIn">

                  <div class="row">
                      <div class="col-md-12">
                          <div class="box">
                              <strong>Profil</strong>
                          	<div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">mdp</th>
                                   
                                </tr>
                              </thead>
                          <tbody>
                                <tr>
                                  
                                    <td><?php echo $client[0]->prenomClient; ?></td>
                                    <td><?php echo $client[0]->nomClient; ?></td>
                                    <td><?php echo $client[0]->mailClient; ?></td>
                                    <td><?php echo $client[0]->mdpClient; ?></td>
                                    
                                </tr>
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
											</div>
                        <br></br>
                      <br></br>
                      
                        <div class="text-center">
                        <a class="btn btn-primary" href="<?php echo base_url()?>ClientCtrl/modifierprofil" role="button">Modifier !</a>
                        </div>
                        
                        </div>
                      </div> 


                      </div> 

                      <br></br>
                      <br></br>
                      
          