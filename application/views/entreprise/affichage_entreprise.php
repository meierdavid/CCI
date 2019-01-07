<link href="<?php echo base_url()."../template/css/profil_entreprise.css"; ?>" rel="stylesheet" type="text/css" media="all" />
<!-- //for bootstrap working -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>

<!------ Include the above in your HEAD tag ---------->
<br/>
<br/>
<div class="container">

       
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo  $entreprise[0]->nomEntreprise; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
			  <?php
					if ($entreprise[0]->logoEntreprise == NULL) {
						$entreprise[0]->logoEntreprise = "not_found.jpg";
					}
					?>
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://localhost/cci/index.php/../assets/image/logos/<?php echo $entreprise[0]->logoEntreprise; ?>" class="img-circle img-responsive"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Numéro de Siret:</td>
                        <td><?php echo  $entreprise[0]->numSiret; ?></td>
                      </tr>
                      <tr>
                        <td>Adresse :</td>
						<?php 
						$adresse = str_replace(' ', '+', $entreprise[0]->adresseEntreprise) . "+" . str_replace(' ', '+', $entreprise[0]->codePEntreprise) . "+" . str_replace(' ', '+', $entreprise[0]->villeEntreprise)  ;
						?>
                        <td><a href = "https://www.google.fr/maps/place/<?php echo $adresse?>"><?php echo $entreprise[0]->adresseEntreprise; ?> 
							<br>
							
							<?php  echo $entreprise[0]->codePEntreprise . "   "; ?>
							<?php echo $entreprise[0]->villeEntreprise; ?>
							</a>
							</td>
                      </tr>
                      <tr>
                        <td>Horaires :</td>
                        <td><?php echo $entreprise[0]->horairesEntreprise; ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Livraison :</td>
                        <td><?php 
					if ($entreprise[0]->livraisonEntreprise == 1) {
						echo "L'entreprise propose la livraison";						
					}
					else {
						echo "L'entreprise ne propose pas la livraison";
					}?>
					</td>
                      </tr>
                        <tr>
                        <td>Délai :</td>
                        <td><?php echo "Le délai maximal est de  " . $entreprise[0]->tempsReservMax . "  Heures"; ?></td>
                      </tr>
                      <tr>
                        <td>Email :</td>
                        <td><?php 
						$this->load->model('faire_partie');
						$this->load->model('commercant');
						$idcommercant=$this->faire_partie->selectByNumSiret($entreprise[0]->numSiret);
						$commercant=$this->commercant->selectById($idcommercant[0]->idCommercant);
						echo $commercant[0]->mailCommercant
						?>	</td>
                      </tr>
                        <td>Numéro de Téléphone:</td>
                        <td><a href="tel:+"><?php 
						$this->load->model('faire_partie');
						$this->load->model('commercant');
						$idcommercant=$this->faire_partie->selectByNumSiret($entreprise[0]->numSiret);
						$commercant=$this->commercant->selectById($idcommercant[0]->idCommercant);
						echo "0" . $commercant[0]->telCommercant
						?>
                        </a></td>
                      </tr>
					  <td>Site Web :</td>
                        <td> <a href= "http://<?php echo $entreprise[0]->siteWebEntreprise;?>"><?php echo $entreprise[0]->siteWebEntreprise;?> </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 
            
          </div>
        </div>
      </div>
   