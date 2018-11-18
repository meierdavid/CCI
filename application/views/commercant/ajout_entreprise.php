
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
            <?php echo validation_errors(); ?>

            <form method="post" action="add_entreprise">
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
                        <label class="control-label">Horaires</label>
                        <input type="datetime" class="form-control" name="horairesEntreprise" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Livraison</label>
                        <input type="checkbox"  name="livraisonEntreprise" value="" size="" required/>
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
