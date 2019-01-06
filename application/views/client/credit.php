
<!------ Include the above in your HEAD tag ---------->


<!--Pulling Awesome Font -->
    <div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-5">
            <div class="form-login" >
                <br>
                <br>

                <h2>Approvisionner votre compte</h2>

                    <br>
                    <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                    <?php echo form_open('ClientCtrl/modifier_credit'); ?>
                    <div class="form-group">
                        <label class="control-label">Ajouter à votre compte (en Euro)</label>
                        <input type="number" class="form-control" name="creditClient" value="" size="30" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdpClient" value="" size="30" required/>
                    </div>    
                    <div class="form-group">
                        <label class="control-label">récrivez votre mot de passe</label>
                        <input type="password" class="form-control" name="mdpClient2" value="" size="30" required/>
                    </div> 
                    <div class="text-center"><input class="btn btn-primary btn-success btn-block" type="submit" value="Ajouter" /></div>
                    
                </form>
                <br> <br>
            </div>
        </div>
    </div>
</div>
    
 