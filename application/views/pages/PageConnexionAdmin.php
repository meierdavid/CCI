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
            <h2 class="text-center"> CCI Hérault - Bienvenue cher Admin !</h2>
            
            <?php // formulaire de connexion Admin ?> 

            <form role="form" method="post" action="<?=base_url('administrateurCtrl/connexion')?>">
                <br></br>
                    <div class="text-center">
                    <h4>Entrez votre Pseudo d'Administrateur et votre mot de passe :</h4>
                    </div>
                    
                    <br></br>

                    <div class="form-group">
                        <label name="mail" class="control-label">Mail</label>
                        <input type="text" class="form-control" name="mail" value="" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>
                    
                    <div class="form-group">
                        <label name="mdp" class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" value="" size="30" required/>
                    </div>    
                    
                 
                    
                    <div class="text-center">
                        <input class="btn btn-primary btn-success btn-block" type="submit" value="Connexion" /></div>
                    <div class="text-center">
                        <br>
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br></br>
            <br></br>

            <div class="text-center">
            <a class="btn btn-primary" href="index" role="button">Accueil</a>
            </div>

            <br></br>

            

            </div>
        </div>
    </div>
</div>