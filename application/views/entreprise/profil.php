    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" style="margin-left: 200px;">
            <?php echo form_open_multipart('CommercantCtrl/modifier_entreprise');?>
                    <br>
					
					
					<?php 
						
						$list_horaires = preg_split('/ /', $entreprise[0]->horairesEntreprise,-1);
						$i=0;
						foreach ($list_horaires as $item) {
							$horaires[$i] = preg_split('/\//', $item,-1);
							$i=$i+1;
						}
						$i=0;
						$j=0;
						for ($j = 0; $j <= 6; $j++){
							$i=0;
							foreach ($horaires[$j] as $item) {
							$horaires[$j][$i] = preg_split('/-/', $item,-1);
							$i=$i+1;
						}
							
						}
					
						?>
						
						
						
                    <div class="form-group">
                        <input type="text" class="form-control" name="numSiret" value="<?php echo  $entreprise[0]->numSiret; ?>" size="30" hidden/>
                    </div>
					<div class="table-responsive">
						<td><img src="http://localhost/cci/index.php/../assets/image/logos/<?php echo $entreprise[0]->logoEntreprise; ?>"  class="img-thumbnail"></td>
					</div>
					<div class="form-group">
                        <label class="control-label">Modifier le logo de l'entreprise :</label>
                        <input type="file" class="form-control" name="logoEntreprise" value="<?php echo $entreprise[0]->logoEntreprise; ?>" size="30" accept "image/*"/>
                    </div>
					<td><p><a href="<?php echo base_url("CommercantCtrl/supprimer_logo/" . $entreprise[0]->numSiret); ?>">Supprimer le logo</a></p></td>
                    <div class="form-group">
                        <label class="control-label">Nom de L'entreprise</label>
                        <input type="text" class="form-control" name="nomEntreprise" value=" <?php echo $entreprise[0]->nomEntreprise; ?>" size="30" required/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseEntreprise" value="<?php echo $entreprise[0]->adresseEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                            <input type="text" class="form-control" name="codePEntreprise" value="<?php  echo $entreprise[0]->codePEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeEntreprise" value="<?php echo $entreprise[0]->villeEntreprise; ?>" size="30" required/>
                    </div>
                     <label class="control-label">Horaires d'ouverture</label>
                        <table width="100%" cellspacing="1" cellpadding="0" class="horaire">
                            <tbody>
                                <tr>
                                    <th>Lundi Matin</th>
                                    <td><input type="time" class="form-control" name="lundi_matin_ouverture" value=<?php echo $horaires[0][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="lundi_matin_fermeture" value=<?php echo $horaires[0][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Lundi Après-midi</th>
                                    <td><input type="time" class="form-control" name="lundi_soir_ouverture" value=<?php echo $horaires[0][1][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="lundi_soir_fermeture" value=<?php echo $horaires[0][1][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Mardi Matin</th>
                                    <td><input type="time" class="form-control" name="mardi_matin_ouverture" value=<?php echo $horaires[1][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="mardi_matin_fermeture" value=<?php echo $horaires[1][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Mardi Après-midi</th>
                                    <td><input type="time" class="form-control" name="mardi_soir_ouverture" value=<?php echo $horaires[1][1][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="mardi_soir_fermeture" value=<?php echo $horaires[1][1][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Mercredi Matin</th>
                                    <td><input type="time" class="form-control" name="mercredi_matin_ouverture" value=<?php echo $horaires[2][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="mercredi_matin_fermeture" value=<?php echo $horaires[2][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Mercredi Après-midi</th>
                                    <td><input type="time" class="form-control" name="mercredi_soir_ouverture" value=<?php echo $horaires[2][1][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="mercredi_soir_fermeture" value=<?php echo $horaires[2][1][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Jeudi Matin</th>
                                    <td><input type="time" class="form-control" name="jeudi_matin_ouverture" value=<?php echo $horaires[3][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="jeudi_matin_fermeture" value=<?php echo $horaires[3][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Jeudi Soir</th>
                                    <td><input type="time" class="form-control" name="jeudi_soir_ouverture" value=<?php echo $horaires[3][0][1]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="jeudi_soir_fermeture" value=<?php echo $horaires[3][1][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Vendredi Matin</th>
                                    <td><input type="time" class="form-control" name="vendredi_matin_ouverture" value=<?php echo $horaires[4][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="vendredi_matin_fermeture" value=<?php echo $horaires[4][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Vendredi Après-midi</th>
                                    <td><input type="time" class="form-control" name="vendredi_soir_ouverture" value=<?php echo $horaires[4][1][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="vendredi_soir_fermeture" value=<?php echo $horaires[4][1][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Samedi Matin</th>
                                    <td><input type="time" class="form-control" name="samedi_matin_ouverture" value=<?php echo $horaires[5][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="samedi_matin_fermeture" value=<?php echo $horaires[5][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Samedi Après-midi</th>
                                    <td><input type="time" class="form-control" name="samedi_soir_ouverture" value=<?php echo $horaires[5][1][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="samedi_soir_fermeture" value=<?php echo $horaires[5][1][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Dimanche Matin</th>
                                    <td><input type="time" class="form-control" name="dimanche_matin_ouverture" value=<?php echo $horaires[6][0][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="dimanche_matin_fermeture" value=<?php echo $horaires[6][0][1]?>></td>
                                </tr>
                                <tr>
                                    <th>Dimanche Après-midi</th>
                                    <td><input type="time" class="form-control" name="dimanche_soir_ouverture" value=<?php echo $horaires[6][1][0]?>></td>
                                    <td><p>à</p></td>
                                    <td><input type="time" class="form-control" name="dimanche_soir_fermeture" value=<?php echo $horaires[6][1][1]?>></td>
                                </tr>
                            </tbody></table>
                    <div class="form-group">
                        <label class="control-label">Livraison</label>
                        <input type="text" class="form-control" name="livraisonEntreprise" value="<?php echo $entreprise[0]->livraisonEntreprise; ?>" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Temps de réservation Maximum</label>
                        <input type="number" class="form-control" name="tempsReservMax" value="<?php echo $entreprise[0]->tempsReservMax; ?>" size="30" required/>
                    </div>
					<div class="form-group">
                        <label class="control-label">Adresse du site web de l'entreprise</label>
                        <input type="text" class="form-control" name="siteWebEntreprise" value="<?php echo $entreprise[0]->siteWebEntreprise; ?>" size="30" />
                    </div>
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Modifier" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br>
            <br>
            </div>
        </div>
    </div>
</div>
