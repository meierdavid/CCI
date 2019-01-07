<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="<?php echo base_url()."../template/css/Connexion.css"; ?>" rel="stylesheet" type="text/css" media="all" />

<!------ Include the above in your HEAD tag ---------->

	<div class="container login-container">
            <div class="row">
			<div class="col-md-6 login-form-3">
			
			<br><a style=margin:15px href="<?php echo base_url()?>ClientCtrl/connexion"><input class="btnAccueil" type="submit" value="Retour Accueil" /></a><br>
				<div class="text-center">

                    <br><h3>Vous êtes Administrateur</h3>
                    <?php 
					$this->load->helper('form');
					echo form_open('AdministrateurCtrl/connexion'); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Votre adresse email" value="" name="mailAdministrateur" size="30" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Votre mot de passe" value="" name="mdpAdministrateur" size="30" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Se connecter" />
                        </div>
                        <div class="form-group">

                            <a href="#" class="ForgetPwd" value="Login">Mot de passe oublié</a>
                        </div>
                    </form>
					<div class="text-center">
                            <a href="<?php echo base_url()?>AdministrateurCtrl/inscription" role="button" ><input type="submit" class="btnNew" value="[Nouvel Admin]" /><a><br><br>
					</div>
                </div>
            </div>
        </div>
</div>