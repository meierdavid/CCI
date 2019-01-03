
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <div class="container">
    <div class="row">
        <div  class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <br></br>
                <br></br>

                <h2>Profil du commerçant</h2>

                    <br></br>
                    <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                    <?php echo form_open('AdministrateurCtrl/modifier_commercant'); ?>
                    
                    <input type="text" class="form-control" name="idCommercant" value="<?php echo  $commercant[0]->idCommercant; ?>" size="30" required hidden/> 
                            
                    <div class="form-group">
                        <label class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomCommercant" value="<?php echo  $commercant[0]->prenomCommercant; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control" name="nomCommercant" value=" <?php echo $commercant[0]->nomCommercant; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Mail</label>
                        <input type="text" class="form-control" name="mailCommercant" value="<?php echo $commercant[0]->mailCommercant; ?>" size="30" required/> 
                            <h6 style="color:red;"</h6>
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdpCommercant" value="" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Mot de passe2</label>
                        <input type="password" class="form-control" name="mdpCommercant2" value="" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input type="text" class="form-control" name="adresseCommercant" value="<?php echo $commercant[0]->adresseCommercant; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Code postale</label>
                            <input type="text" class="form-control" name="codePCommercant" value="<?php  echo $commercant[0]->codePCommercant; ?>" size="30" required/>
                    </div> 
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input type="text" class="form-control" name="villeCommercant" value="<?php echo $commercant[0]->villeCommercant; ?>" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" name="telCommercant" value="<?php echo $commercant[0]->telCommercant; ?>" size="30" required/>
                    </div>    
                    
                    
                    
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Modifier" /></div>
                    <div class="text-center">
                        <br>
                        
                        <h1 style="color:darkslategrey; "></h1>
                    </div>
                </form>
            <br></br>
            <br></br>

                <br></br>
                <br></br>

            </div>
        </div>
    </div>
</div>
    
 

