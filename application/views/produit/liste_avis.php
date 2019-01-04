<link href="<?php echo base_url()."../template/css/liste_avis.css"; ?>" rel="stylesheet" type="text/css" media="all" />

<!------ Include the above in your HEAD tag ---------->

<div class="container">
            <div class="row">
			
                <div class="col-md-8">
                  <div class="page-header">
                    <h1><small class="pull-right"><?php 
					$this->load->model('poster_avis');
					echo ("Il y a <strong>" . $this->poster_avis->nombre_avis($avis[0]->idProduit)) . "</strong> Avis";
					
					?></small> Avis </h1>
                  </div> 
                   <div class="comments-list">
				   <?php foreach ($avis as $item) { ?>
                       <div class="media">
                          
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name"><?php 
						  $this->load->model('client');
						  $client=$this->client->selectById($item->idClient);
						echo $client[0]->prenomClient . "  " . $client[0]->nomClient ?> <p class="pull-right"><small><?php echo "Note: " .  $item->noteClient . " / 10"?></small></p></h4>
                              <?php echo $item->avisClient?>
                              
                              </br></br>
                            </div>
                          </div>
				   <?php } ?>
                       
                   </div>
                    
                    
                    
                </div>
            </div>
        </div>