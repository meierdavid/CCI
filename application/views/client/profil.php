<link href="<?php echo base_url()."../template/css/Profil_utilisateur.css"; ?>" rel="stylesheet" type="text/css" media="all" />
<script src="<?php echo base_url()."../template/js/Profil_utilisateur.js"; ?>"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo  $client[0]->prenomClient . " " . $client[0]->nomClient; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://localhost/cci/index.php/../assets/image/logos/user_pic.jpg" class="img-circle img-responsive"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Email :</td>
                        <td><a href="mailto:<?php echo $client[0]->mailClient; ?>"><?php echo $client[0]->mailClient; ?></td>
                      </tr>
                      <tr>
                        <td>Adresse:</td>
                        <td><?php echo $client[0]->adresseClient ?></td>
                      </tr>
                      <tr>
                        <td>Code Postal</td>
                        <td><?php  echo $client[0]->codePClient; ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Ville</td>
                        <td><?php echo $client[0]->villeClient; ?></td>
                      </tr>
                        <tr>
                        <td>Téléphone</td>
                        <td><a href="tel:0<?php echo "0" . $client[0]->telClient; ?>"><?php echo "0" . $client[0]->telClient; ?></td></a>
                      </tr>
                      <tr>
                        <td>Points de fidélité</td>
                        <td><?php echo $client[0]->pointClient ?></td>
                      </tr>
                        <td>Votre Crédit</td>
                        <td><?php echo $client[0]->creditClient ?></td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                  
              </div>
			  
			
			  <div class="text-center" style="margin:10px">
                  <br><br><br><a href="<?php echo base_url()?>ClientCtrl/changer_mdp" class="btn btn-primary">Changer Mot de Passe</a>
			  </div>
			 
			  
			 
			  <div class="text-center" style="margin:10px">
                  <a href="<?php echo base_url()?>ClientCtrl/modification" class="btn btn-primary">Modifier Profil</a>
				</div>
			
			  
			  <div class="text-center" style="margin:10px">
				  <a href="<?php echo base_url()?>ClientCtrl/modifier_credit" class="btn btn-success">Approvisionner votre compte</a><br><br>
			  </div>

			  
			  
			  
			  
			  
			  
			  
			   </div>
            </div>
                 <div class="panel-footer">
                        <br>
                    </div>
            
          </div>
        </div>
      </div>
    </div>