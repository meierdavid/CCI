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
						<td>
						<?php 
						$list_horaires = preg_split('/ /', $entreprise[0]->horairesEntreprise,-1);
						$i=0;
						foreach ($list_horaires as $item) {
							$horaires[$i] = preg_split('/\//', $item,-1);
							$i=$i+1;
						}
						$i=0;
						foreach($horaires as $item) {
							if ($item[0] == '-'){
								$horaires[$i][0]='Fermé';
							}
							if ($item[1] == '-'){
								$horaires[$i][1]='Fermé';
							}
							$i=$i+1;
						}
						
						
						echo "<div class='text-center'><strong>Lundi : </strong></div>" . $horaires[0][0];					
						echo "<br> " . $horaires[0][1] . "<br><br>";
						echo "<div class='text-center'><strong>Mardi : </strong></div>" . $horaires[1][0];
						echo "<br> " . $horaires[1][1] . "<br><br>";
						echo "<div class='text-center'><strong>Mercredi : </strong></div>" . $horaires[2][0];
						echo "<br> " . $horaires[2][1] . "<br><br>";
						echo "<div class='text-center'><strong>Jeudi : </strong></div>" . $horaires[3][0];
						echo "<br> " . $horaires[3][1] . "<br><br>";
						echo "<div class='text-center'><strong>Vendredi : </strong></div>" . $horaires[4][0];
						echo "<br> " . $horaires[4][1] . "<br><br>";
						echo "<div class='text-center'><strong>Samedi : </strong></div>" . $horaires[5][0];
						echo "<br> " . $horaires[5][1] . "<br><br>";
						echo "<div class='text-center'><strong>Dimanche : </strong></div>" . $horaires[6][0];
						echo "<br> " . $horaires[6][1] . "<br><br>";
						?>
						<td>
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
                        <td><a href="mailto:<?php 
						$this->load->model('faire_partie');
						$this->load->model('commercant');
						$idcommercant=$this->faire_partie->selectByNumSiret($entreprise[0]->numSiret);
						$commercant=$this->commercant->selectById($idcommercant[0]->idCommercant);
						echo $commercant[0]->mailCommercant
						?>"><?php 
						
						echo $commercant[0]->mailCommercant
						?>	</td>
                      </tr>
                        <td>Numéro de Téléphone:</td>
                        <td><a href="tel:0<?php 
						$this->load->model('faire_partie');
						$this->load->model('commercant');
						$idcommercant=$this->faire_partie->selectByNumSiret($entreprise[0]->numSiret);
						$commercant=$this->commercant->selectById($idcommercant[0]->idCommercant);
						echo "0" . $commercant[0]->telCommercant
						?>">
						<?php 
						
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
   