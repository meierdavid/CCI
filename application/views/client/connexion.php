
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
            <h2 class="text-center"> CCI Hérault - Bienvenue cher Client !</h2>

            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
            <!-- renvoie tous les messages d'erreur, une chaine vide sinon -->
            <?php echo form_open('ClientCtrl/connexion'); ?>

                <br></br>
                    <div class="text-center">
                    <h4>Entrez votre Pseudo d'Utilisateur et votre mot de passe :</h4>
                    </div>

                    <br></br>

                    <div class="form-group">
                        <label class="control-label">Pseudo</label>
                        <input type="text" class="form-control" name="mailClient" value="" size="30" required/>
                            <h6 style="color:red;"</h6>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" value="" size="30" required/>
                    </div>

                    <div class="text-center">
            <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value=" Connexion " /></div>
            </div>


                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
            <br></br>
            <br></br>

            <div class="text-center">
            <a class="btn btn-primary" href="<?php echo base_url()?>PageCtrl/ConnexionCommercant" role="button">Commercant ? Cliquez ici !</a>
            </div>

            <br></br>

            <div class="text-center">
            <a class="btn btn-primary" href="<?php echo base_url()?>PageCtrl/ConnexionAdmin" role="button">Administrateur ? Cliquez ici !</a>
            </div>

            <br></br>

             <div class="text-center">
            <a class="btn btn-primary" href="<?php echo base_url()?>PageCtrl/choix_inscription" role="button">Vous êtes pas inscrit ? Cliquez ici !</a>
            </div>

            </div>
        </div>
    </div>
</div>
