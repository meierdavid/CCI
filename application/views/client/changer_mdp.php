

<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <br>
                <h2 class="text-center"> Changer de mot de passe</h2>
                <br><br>

                <form method="post" action="changer_mdp">

                    <div class="form-group">
                        <label class="control-label">Ancien mot de passe</label>
                        <input type="password" class="form-control" name="mdpClientAncien" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdpClientNouveau" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Confirmation du Mot de passe</label>
                        <input type="password" class="form-control" name="mdpClientConf" value="" size="30" required/>
                    </div>
                    <div


                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Valider" /></div>
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