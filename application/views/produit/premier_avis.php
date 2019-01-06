<link href="<?php echo base_url()."../template/css/liste_avis.css"; ?>" rel="stylesheet" type="text/css" media="all" />

<!------ Include the above in your HEAD tag ---------->

<div class="container">
            <div class="row">
			
                <div class="col-md-8">
                  <div class="page-header">
                    <h1><small class="pull-right"><?php 
					$this->load->model('poster_avis');
					
					?></small> Il n'y a pas encore d'avis sur ce produit </h1>
					
					
					<h4>Soyez le premier à donner votre avis :
					<a href="<?php echo base_url("ClientCtrl/ajouter_avis/") . $produit[0]->idProduit; ?>">Cliquez ici !</a>
                  </h4></div> 
                   <div class="comments-list">
                       <div class="media">
                          
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name"> <p class="pull-right"><small></small></p></h4>
                  
                              
                              
                            </div>
                          </div>
				 
                       
                   </div>
                   </div>
                    
                    
                    
                </div>
            </div>
        </div>