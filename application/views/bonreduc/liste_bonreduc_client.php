<link href="<?php echo base_url()."../template/css/BonReduClient.css"; ?>" rel="stylesheet" type="text/css" media="all" />
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="box">
		<div class="row">
		<div class="table-responsive">
			<div class="text-center">
			<h2>Liste des codes de réduction :</h2>
			
		</div>
				
				 <table class="table table-striped">
				<thead>
					<tr class="bg-primary">
						<th>Description du bon</th>
						<th>Entreprise</th>
						<th>Réduction appliquée</th>
						<th> Code </th>
					</tr>
				</thead>
				<tbody> <!-- para abrir em outra aba adicionar target="_blank" -->
					<?php 
					$this->load->model("entreprise");
					
					foreach ($bonreduc as $item) { 
					$entreprise=$this->entreprise->selectById($item->numSiret);
					?>
					<tr>
						<td><?php echo $item->descriptionBon; ?>	
						<td><strong> <a href="<?php echo base_url("entrepriseCtrl/affichage_entreprise/".$item->numSiret); ?>"><?php echo $entreprise[0]->nomEntreprise; ?></a></strong></td>
						<td><?php echo $item->pourcentageBon . " % de réduction"; ?></td> 
						<td><?php echo $item->libelleBon; ?></td>
					</tr>
					<?php } ?>
					
				   </tbody> 
				  </table>
				</div>
		</div>
	</div>
</div>