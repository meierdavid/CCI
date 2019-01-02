
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
            <h2 class="text-center"> CCI Hérault - Bienvenue cher Consommateur !</h2>

            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
            <!-- renvoie tous les messages d'erreur, une chaine vide sinon -->
            <?php echo form_open('ClientCtrl/inscription'); ?>

                <br></br>
                    <div class="text-center">
                    <h4>Entrez vos coordonnées :</h4>
                    </div>

                    <br></br>

                    <div class="form-group">
                        <label class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomClient" value="" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="nomClient" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="mail" class="form-control" name="mailClient" value="" size="30" required valid_email/>
                            <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdpClient" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Confirmation du Mot de passe</label>
                        <input type="password" class="form-control" name="mdpClient2" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseClient" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                        <input type="text" class="form-control" name="codePClient" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeClient" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" name="telClient" value="" size="30" required/>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="conditionsUtilisation" required/> Je m'engage à respecter les <a href="<?php echo base_url("ClientCtrl/condition_utilisation/");?>">conditions d'utilisation</a> de ce site
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
