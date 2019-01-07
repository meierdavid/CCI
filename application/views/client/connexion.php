<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="<?php echo base_url()."../template/css/Connexion.css"; ?>" rel="stylesheet" type="text/css" media="all" />

<!------ Include the above in your HEAD tag ---------->

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Vous êtes Client</h3>
                    <?php echo form_open('ClientCtrl/connexion'); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" name="mailClient" placeholder="Votre adresse email" value="" size="30" required /> 
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Votre mot de passe" value="" name="mdp" size="30" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Se connecter" />
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Mot de passe oublié</a>
                        </div>
                    </form>
					<div class="text-center">
                            <a href="<?php echo base_url()?>ClientCtrl/inscription" role="button" ><input type="submit" class="btnNew" value="Vous êtes nouveaux ?" /><a>
					</div>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Vous êtes Commercant</h3>
                    <?php echo form_open('CommercantCtrl/connexion'); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Votre adresse email" value="" name="mailCommercant" size="30" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Votre mot de passe" value="" name="mdp" size="30" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Se connecter" />
                        </div>
                        <div class="form-group">

                            <a href="#" class="ForgetPwd" value="Login">Mot de passe oublié</a>
                        </div>
                    </form>
					<div class="text-center">
                            <a href="<?php echo base_url()?>CommercantCtrl/inscription" role="button" ><input type="submit" class="btnNew" value="Vous êtes nouveaux ?" /><a>
					</div>
                </div>
            </div>
			<div class="text-center">
			                            <a href="<?php echo base_url()?>PageCtrl/ConnexionAdmin" role="button" ><input type="submit" class="btnNew" value="Vous êtes Administrateur ?" /><a>
			</div>
        </div>