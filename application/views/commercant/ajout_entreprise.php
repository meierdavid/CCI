
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >

              <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
              <!-- renvoie tous les messages d'erreur, une chaine vide sinon -->
              <?php echo form_open('CommercantCtrl/ajout_entreprise'); ?>

                    <div class="text-center">
                    <h4>Ajoutez votre entreprise :</h4>
                    <div class="form-group">
                        <label class="control-label">n°siret</label>
                        <input type="number" class="form-control" name="numSiret" value="<?php echo set_value('prenomEntreprise'); ?>" size="30" required/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nom de L'entreprise</label>
                        <input type="text" class="form-control" name="nomEntreprise" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseEntreprise" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                        <input type="text" class="form-control" name="codePEntreprise" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeEntreprise" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Horaires d'ouverture</label>
                        <table width="100%" cellspacing="1" cellpadding="0" class="horaire">
													<tbody><tr>
														<th>Lundi Matin</th>
														<td><input type="float" class="form-control" name="lundi_matin" value="08,00" size="5" required/></td>
                            <td><p>à</p></td>
                            <td><input type="float" class="form-control" name="lundi_matin" value="12,00" size="5" required/></td>
                          </tr>
                          <tr>
                            <th>Lundi Soir</th>
                            <td><input type="float" class="form-control" name="lundi_matin" value="13,00" size="5" required/></td>
                            <td><p>à</p></td>
                            <td><input type="float" class="form-control" name="lundi_matin" value="20,00" size="5" required/></td>
													</tr>
													<tr>
														<th>Mardi</th>
														<td>9h30 - 20h30</td>
													</tr>
													<tr>
														<th>Mercredi</th>
														<td>9h30 - 20h30</td>
													</tr>
													<tr>
														<th>Jeudi</th>
														<td>9h30 - 20h30</td>
													</tr>
													<tr>
														<th>Vendredi</th>
														<td>9h30 - 20h30</td>
													</tr>
													<tr>
														<th>Samedi</th>
														<td>9h30 - 20h30</td>
													</tr>
													<tr>
														<th>Dimanche</th>
														<td></td>
													</tr>
												</tbody></table>
                        <!-- <p>Lundi :</p>
                        <input type="number" class="form-control" name="lundi_matin" value="8" size="10" required/>
                        <input type="number" class="form-control" name="lundi_soir" value="12" size="30"/> -->
                        <!-- <textarea class="form-control" name="horairesEntreprise" required>
                        Lun**h**/**h**-**h**/**h**
                        Mar**h**/**h**-**h**/**h**
                        Mer**h**/**h**-**h**/**h**
                        Jeu**h**/**h**-**h**/**h**
                        Ven**h**/**h**-**h**/**h**
                        Sam**h**/**h**-**h**/**h**
                        Dim**h**/**h**-**h**/**h**</textarea> -->
                    </div>
                    <div class="form-group">
                        <label class="control-label">Livraison</label>
                        <input type="radio"  name="livraisonEntreprise" value="Oui" required/>Oui
                        <input type="radio"  name="livraisonEntreprise" value="Non" required/>Non
                    </div>
                    <div class="form-group">
                        <label class="control-label">Temps Maximum de Réservation en heure </label>
                        <input type="number" class="form-control" name="tempsReservMax" value="" size="30" required/>
                    </div>




                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Inscription" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br></br>
            <br></br>



            </div>
        </div>
    </div>
</div>
