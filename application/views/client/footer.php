
<!-- footer -->
<div class="footer">
	<div class="footer_agile_inner_info_w3l">
		<div class="col-md-3 footer-left">
			<h2><a href="index.html"><span>H</span>érrault E-Commerce</a></h2>
			<p>Crée par la CCI Hérault</p>
                        <br><br>
                        <p> Avec : </p>
                        <img src="<?php echo base_url("../assets/image/polygo.svg"); ?>" alt="" width="80%" height="20%"/>
		</div>
		<div class="col-md-9 footer-right">
			<div class="sign-grds">
				<div class="col-md-4 sign-gd">
					<h4>Plan du <span>site</span> </h4>
					<ul>
						<li><a href="index.html">Accueil</a></li>
						<li><a href="mens.html">Catégories</a></li>
						<li><a href="womens.html">Soldes</a></li>
						<li><a href="about.html">Codes de réduction</a></li>
						<li><a href="typography.html">Comparateur</a></li>
						<li><a href="contact.html">Contacts</a></li>
						<li><a href="contact.html">Aide</a></li>
					</ul>
				</div>

				<div class="col-md-5 sign-gd-two">
					<h4>Nous <span>contacter</span></h4>
					<div class="w3-address">
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Numéro de téléphone</h6>
								<p>0123456789</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Addresse email</h6>
								<p>Email :<a href="mailto:example@email.com"> cci_assistance@gmail.com</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Localisationn</h6>
								<p>Hérault, FRANCE.</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
		<p class="copy-right">&copy 2018 Herault E-Commerce. Tous droits reservés | Design par <a href="http://w3layouts.com/">W3layouts</a></p>
	</div>
</div>
<!-- //footer -->

<!-- login -->
			<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-bottom">
                                                                            <h1>Se déconnecter</h1>
									</div>
									<div class="login-right">
										<h3>Se connecter</h3>
										<form>
											<div class="sign-in">
												<h4>Email :</h4>
												<input type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">
											</div>
											<div class="sign-in">
												<h4>Mot de passe :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												<a href="#">Oublie de mot de passe?</a>
											</div>
											<div class="single-bottom">
												<input type="checkbox"  id="brand" value="">
												<label for="brand"><span></span>Se souvenir de moi</label>
											</div>
											<div class="sign-in">
												<input type="submit" value="Connexion" >
											</div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<p>En vous connectant vous acceptez les <a href="#">thermes et conditions</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- //login -->
<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

<!-- js -->
<script type="text/javascript" src="<?php echo base_url()."../template/js/jquery-2.1.4.min.js"; ?>"></script>
<!-- //js -->
<script src="<?php echo base_url()."../template/js/modernizr.custom.js"; ?>"></script>
	<!-- Custom-JavaScript-File-Links -->
	<!-- cart-js -->
	<script src="<?php echo base_url()."../template/js/minicart.min.js"; ?>"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>

	<!-- //cart-js -->
<!-- script for responsive tabs -->
<script src="<?php echo base_url()."../template/js/easy-responsive-tabs.js"; ?>"></script>
<script>
	$(document).ready(function () {
	$('#horizontalTab').easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion
	width: 'auto', //auto or any width like 600px
	fit: true,   // 100% fit in a container
	closed: 'accordion', // Start closed if in accordion view
	activate: function(event) { // Callback function if tab is switched
	var $tab = $(this);
	var $info = $('#tabInfo');
	var $name = $('span', $info);
	$name.text($tab.text());
	$info.show();
	}
	});
	$('#verticalTab').easyResponsiveTabs({
	type: 'vertical',
	width: 'auto',
	fit: true
	});
	});
</script>
<!-- //script for responsive tabs -->
<!-- stats -->
	<script src="<?php echo base_url()."../template/js/jquery.waypoints.min.js"; ?>"></script>
	<script src="<?php echo base_url()."../template/js/jquery.countup.js"; ?>></script>
	<script>
		$('.counter').countUp();
	</script>
<!-- //stats -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url()."../template/js/jquery.easing.min.js"; ?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			

			});
	</script>
<!-- //here ends scrolling icon -->


<!-- for bootstrap working -->
<script type="text/javascript" src="<?php echo base_url()."../template/js/bootstrap.js"; ?>"></script>
</body>
</html>
