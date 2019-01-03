<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url()."../assets/css/commercant.css"; ?>" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<div class="container-fluid">
<br />
<br />
  <center>
        <h1>Profil de l'entreprise : <?php if(isset($entreprise)){ echo $entreprise[0]->nomEntreprise; echo ' ';} else{ echo $entreprise[0]->nomEntreprise ;}    ?> </h1>
    </center>
	<br />
	<br />
	<br />
  <div class="row">
    <div class="col-lg-3 " style="background-color:white;">
       <?php
		if ($entreprise[0]->logoEntreprise == NULL) {
			$entreprise[0]->logoEntreprise = "not_found.jpg";
		}
		?>
		<td>
			<center>
				<img src="http://localhost/cci/index.php/../assets/image/logos/<?php echo $entreprise[0]->logoEntreprise; ?>"  class="imageg"></td>

			</center>

	</div>
    <div class="col-md-3 " style="background-color:white;">
 <div class="container">
    <div class="row">
        <div class="col-md-2 col-md-3">
                    <br>
                    Numéro de siret :  
                    <br>
					<br>
                    Adresse :  
                    <br>
                    <br>
					<br>
                    
                    
                    <br>
                    Horaires d'ouverture :  
                    <br>
					<br>
                    Livraison :
                    <br>
					<br>
                    Délai Maximal :
                	<br>
					<br>
					Contact par :  
					
				</form>
				
            <br>
            <br>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
                    <br>
                    <?php echo  $entreprise[0]->numSiret; ?>
                    <br>
					<br>
                    <?php echo $entreprise[0]->adresseEntreprise; ?>
                    <br>
                    <?php  echo $entreprise[0]->codePEntreprise . "   "; ?>
                    
                    <?php echo $entreprise[0]->villeEntreprise; ?>
                    <br>
					<br>
					<br>
                    <?php echo $entreprise[0]->horairesEntreprise; ?>
                    <br>
					<br>
                    <?php 
					if ($entreprise[0]->livraisonEntreprise == 1) {
						echo "L'entreprise propose la livraison";						
					}
					else {
						echo "L'entreprise ne propose pas la livraison";
					}?>
                    <br>
					<br>
                    <?php echo "Le délai maximal est de  " . $entreprise[0]->tempsReservMax . "  Heures"; ?>
                	<br>
					<br>					
					<button type="button" href="<?php echo base_url()?>ClientCtrl/Profil" class="active">Téléphone</button>
					<button type="button" href="<?php echo base_url()?>ClientCtrl/Profil" class="active">Mail</button>
				</form>
				
            <br>
            <br>
        </div>
    </div>
</div>

    
  </div>
</div>


   
</body>
</html>