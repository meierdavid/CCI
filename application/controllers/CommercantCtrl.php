<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommercantCtrl extends CI_Controller {


	public function index()
	{
        if($this->input->cookie('commercantCookie') != null){
	        $this->load->helper('url');
	        $this->load->view('commercant/profil');
        }
	}

    public function profil()
    {
        $this->load->helper('cookie');
        $this->load->helper('url');

        if($this->input->cookie('commercantCookie') != Null){
            $varid= $this->input->cookie('commercantCookie'); // rentrer un mail dans votre base de données en attendant qu'on fasse les cookies
            $this->load->model('commercant');
            $data['commercant'] = $this->commercant->selectByMail($varid);
            $this->load->view('commercant/index',$data);
            $this->load->view('commercant/profil',$data);
        }
        else{
            $this->load->view('pages/pageconnexion');
        }
    }

    public function changer_mdp(){ // info commercant avec cookie
        $this->load->helper('cookie');
        $this->load->model('commercant');
        $this->load->helper('url');
        $varid= $this->input->cookie('commercantCookie');
        $data['commercant'] = $this->commercant->selectByMail($varid);

        if(isset($_POST['mdpCommercantAncien']) && ($_POST['mdpCommercantAncien'] == $data['commercant'][0]->mdpCommercant) ){ // + tester Bon Ancien mot de passe
            if($_POST['mdpCommercantNouveau'] == $_POST['mdpCommercantConf']){
                $newMdp = $_POST['mdpCommercantNouveau'];
                $this->commercant->updateMdp($varid,$newMdp);
                delete_cookie("commercantCookie");
                $this->load->view('pages/pageconnexion');
            }
            else{
                $this->load->view('commercant/index',$data);
                $this->load->view('commercant/changer_mdp',$data);
            }
        }
        else{
            $this->load->view('commercant/index',$data);
            $this->load->view('commercant/changer_mdp',$data);
        }


    }

    public function check_connexion(){
       $this->load->helper('cookie');

        if(isset($_POST['mail']) && isset($_POST['mdp']) ){
            $this->load->model('commercant');
            $data['commercant'] = $this->commercant->selectByMail($_POST['mail']);
						var_dump($data['commercant']);
						die;
            if( $data['commercant'] != NULL && $_POST['mdp'] == $data['commercant'][0]->mdpCommercant ){
                $cookie = array(
                                'name'   => 'commercantCookie',
                                'value'  => $data['commercant'][0]->mailCommercant,
                                'expire' => '3600'
                             );
                $this->input->set_cookie($cookie);

                echo $this->input->cookie('commercantCookie');

                $this->load->view('commercant/index',$data);
            }
            else{
                $erreur="erreur mauvais mot de passe ou mauvaise adresse mail";
                $data['message']=$erreur;
                $this->load->view('errors/erreur_formulaire', $data);
								$this->load->view('commercant/connexion');
                // erreur mauvais mdp ou mauvaise adresse mail
            }
        }
        else{
            // erreur
        }
    }

    public function liste_entreprise(){
        $this->load->helper('cookie');
        $this->load->model('commercant');
        $this->load->model('entreprise');
        if($this->input->cookie('commercantCookie') != null){
            $varid = $this->input->cookie('commercantCookie');
            $data['commercant'] = $this->commercant->selectByMail($varid);
            $data['entreprises'] = $this->commercant->selectEntreprise($data['commercant'][0]->idCommercant);

            if( $data['entreprises'] != NULL){
               $this->load->view('commercant/index',$data);
               $this->load->view('commercant/liste_entreprise',$data);

            }
            else{
                $this->ajout_entreprise();
            }
        }
        else{
            $this->load->view('commercant/connexion');
        }
    }

    public function ajout_entreprise() { //mettre parametre mail ou utiliser cookie
            // use insert for model entreprise paramètre $data , $idCommercant
            $this->load->helper('form','url');
            $this->load->helper('cookie');

            $this->load->library('form_validation');

            $this->load->model('entreprise');
            $this->load->model('commercant');

            $this->form_validation->set_rules('numSiret', 'n° SIRET', 'required');
            $this->form_validation->set_rules('nomEntreprise', "Nom de l'entreprise", 'alpha_numeric_spaces');
            $this->form_validation->set_rules('codePEntreprise', 'Code postale', 'integer');
            $this->form_validation->set_rules('villeEntreprise', 'Ville', 'alpha_dash');
            //	$this->form_validation->set_rules('horairesEntreprise', 'Horaires', ''); je ne sais pas comment géré ce champ
            $this->form_validation->set_rules('TempsReservMax', 'Temps maximum de réservation en heure', 'integer');

            if($this->input->cookie('commercantCookie') != null){
                    $varid= $this->input->cookie('commercantCookie');
                    $data['commercant']=$this->commercant->selectByMail($varid);
                    if ($this->form_validation->run() == FALSE)
                    {
                            $this->load->view('commercant/index',$data);
                            $this->load->view('commercant/ajout_entreprise');
                    }
                    else
                    {
                            if($this->entreprise->selectById($_POST['numSiret']) == null){


                                    $id= $data['commercant'][0]->idCommercant;

                                    $data=array(
                                            "numSiret"=> htmlspecialchars($_POST['numSiret']),
                                            "nomEntreprise"=> htmlspecialchars($_POST['nomEntreprise']),
                                            "adresseEntreprise"=> htmlspecialchars($_POST['adresseEntreprise']),
                                            "codePEntreprise"=> htmlspecialchars($_POST['codePEntreprise']),
                                            "villeEntreprise" => htmlspecialchars($_POST['villeEntreprise']),
                                            "horairesEntreprise" => htmlspecialchars($_POST['horairesEntreprise']),
                                            "livraisonEntreprise" => htmlspecialchars($_POST['livraisonEntreprise']),
                                            "tempsReservMax" => htmlspecialchars($_POST['tempsReservMax']),
                                    );

                                    $this->entreprise->insert($data,$id);
                                    $this->load->view('commercant/validation_ajout_entreprise');
                                    $this->load->view('commercant/index',$data);
                                    $data['entreprise'] =$this->entreprise->selectById($_POST['numSiret']);
                                    $this->load->view('entreprise/profil',$data);
                            }
                            else{
                                    $this->load->view('commercant/ajout_entreprise');
                                    echo '<div class="alert alert-danger text-center">Ce numéro SIRET corrspond déjà à une entreprise</div>';
                            }
                    }
            }
            else{
                    $this->load->view('pages/deconnexion');
                    $this->load->view('commercant/connexion');
            }
    }

    public function connexion(){
			$this->load->helper('form','url');
			$this->load->helper('cookie');
			$this->load->library('form_validation');
			$this->load->model('commercant');

			$this->form_validation->set_rules('mailCommercant', 'Email', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('commercant/connexion');
			}
			else
			{

				$com=$this->commercant->selectByMail($_POST['mailCommercant']);
				//le commercant qui essaye de se connecter

				if ($this->commercant->selectByMail($_POST['mailCommercant']) == null){
					$this->load->view('commercant/lie_commercant');
					echo "<div class='alert alert-danger text-center'>Cet email n'existe pas</div>";
				}
                                else{
                                    $com = $this->commercant->selectByMail($_POST['mailCommercant']);
                                    if( $com[0]->mdpCommercant != $_POST['mdp']){
																			$erreur="erreur mauvais mot de passe ou mauvaise adresse mail";
																			$data['message']=$erreur;
																			$this->load->view('errors/erreur_formulaire',$data);
																			//$this->load->view('commercant/connexion');
                                    }
                                    else{
                                            echo "formumaire bien remplie";
                                            //mettre la connexion dans les cookies
                                            //setcookie('commercantCookie',$com[0]->idCommercant,time()+3600,'/','');
                                     //	$this->load->view('commercant/index',$data);

                                    $data['commercant'] = $this->commercant->selectByMail($_POST['mailCommercant']);
                                    if( $data['commercant'] != NULL && $_POST['mdp'] == $data['commercant'][0]->mdpCommercant ){
                                                             $cookie = array(
                                                                'name'   => 'commercantCookie',
                                                                'value'  => $data['commercant'][0]->mailCommercant,
                                                                'expire' => '3600'
                                                            );
                                                     $this->input->set_cookie($cookie);
                                                     echo $this->input->cookie('commercantCookie');
                                                     $this->load->view('commercant/index',$data);
                                            }
                                    }
                                }

    }
	}

    public function deconnexion(){
        $this->load->helper('url');
        $this->load->helper('cookie');
        delete_cookie("commercantCookie");
        $this->load->view('pages/deconnexion');
        $this->load->view('pages/pageconnexion');
    }

		public function lie_commercant(){
			$this->load->model('commercant');
			$this->load->model('faire_partie');
			$this->load->helper('form','url');
			$this->load->helper('cookie');
			$this->load->library('form_validation');

			$cookie=$this->input->cookie('commercantCookie');
			$faitpartie=$this->commercant->selectById($cookie);
			//ligne de faire_partie correspondant à l'email Commercant

			$this->form_validation->set_rules('mailCommercant', 'Email', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('commercant/lie_commercant');
			}
			else
			{
				$comm=$this->commercant->selectByMail($_POST['mailCommercant']);
				//ligne commercant correspondant à cet email

				if ($comm == null){
					$this->load->view('commercant/lie_commercant');
					echo "<div class='alert alert-danger text-center'>Cet email n'existe pas</div>";
				}
				else if( $faitpartie[0] == null){
					$this->load->view('commercant/lie_commercant');
					echo '<div class="alert alert-danger text-center">Ce numéro SIRET ne corrspond pas à votre entreprise</div>';
				}
				else{
					echo "formumaire bien remplie";
					$data=array(
						"numSiret"=> htmlspecialchars($_POST['siret']),
						"idCommercant"=> htmlspecialchars($comm[0]->idCommercant)
					);
					$this->faire_partie->insert($data);
				}
			}
		}

    public function inscription(){
        $this->load->model('commercant');
        $this->load->helper('form','url');
				$this->load->library('form_validation');

				$this->form_validation->set_rules('prenomCommercant', 'Prénom', 'alpha_dash');
				$this->form_validation->set_rules('nomCommercant', 'Nom', 'alpha_numeric_spaces');
				$this->form_validation->set_rules('mailCommercant', 'Email', 'valid_email');
				$this->form_validation->set_rules('codePCommercant', 'Code postale', 'integer');
				$this->form_validation->set_rules('villeCommercant', 'Ville', 'alpha_dash');
				$this->form_validation->set_rules('telCommercant', 'Numéro de téléphone', 'integer');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('commercant/inscription');
				}
				else
				{
					if (null != $this->commercant->selectByMail($_POST['mailCommercant'])){
						$this->load->view('commercant/inscription');
						echo "<div class='alert alert-danger text-center'>Cet email n'est pas disponible</div>";
					}
					else if($_POST['mdpCommercant'] == $_POST['mdpCommercant2'] ){
						echo "formumaire bien remplie";
						$data=array(
							"prenomCommercant"=> htmlspecialchars($_POST['prenomCommercant']),
							"nomCommercant"=> htmlspecialchars($_POST['nomCommercant']),
							"mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
							"mdpCommercant" => htmlspecialchars($_POST['mdpCommercant']),
							"adresseCommercant"=> htmlspecialchars($_POST['adresseCommercant']),
							"codePCommercant"=> htmlspecialchars($_POST['codePCommercant']),
							"villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
							"telCommercant" => htmlspecialchars($_POST['telCommercant']),
							"pointCommercant" => htmlspecialchars(0),
						);
						$this->commercant->insert($data);
					}
					else {
						$this->load->view('commercant/inscription');
						echo '<div class="alert alert-danger text-center">La confirmation de Mot de passe ne correspond pas au premier</div>';
					}
				}
		}

}
