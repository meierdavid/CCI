
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <br>
                

                <h2>Votre Profil</h2>

                    <br>
                    <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                    <?php echo form_open('ClientCtrl/modifier'); ?>
                    <div class="form-group">
                        <label class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomClient" value="<?php echo  $client[0]->prenomClient; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="nomClient" value=" <?php echo $client[0]->nomClient; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Mail</label>
                        <input type="text" class="form-control" name="mailClient" value="<?php echo $client[0]->mailClient; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdpClient" value="" size="30" required />
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Confirmez votre mot de passe</label>
                        <input type="password" class="form-control" name="mdpClient2" value="" size="30" required />
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseClient" value="<?php echo $client[0]->adresseClient; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                            <input type="text" class="form-control" name="codePClient" value="<?php  echo $client[0]->codePClient; ?>" size="30" required/>
                    </div> 
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeClient" value="<?php echo $client[0]->villeClient; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" name="telClient" value="<?php echo $client[0]->telClient; ?>" size="30" required/>
                    </div>    
                   

                    <br>
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Modifier" /></div>
                    <div class="text-center">
                        <br>
                        
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br>
            

                <br>

               
                <br>

            </div>
        </div>
    </div>
</div>
    
 