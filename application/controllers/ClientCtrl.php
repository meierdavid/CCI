<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientCtrl extends CI_Controller {
        // cette view sera utilisé pour afficher l'index du client quand le principe des cookies
        // fonctionnera. On l'appellera directement dans connection
	public function index()
	{   
	    $this->load->helper('form', 'url');
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->model('client');
                var_dump($_COOKIE['clientCookie']);
                if(isset($_COOKIE['clientCookie'])){
                    $this->load->view('client/header');
                    $this->load->view('client/accueil');
                    $this->load->view('client/footer');
                }
                else{
                    $this->load->view('pages/deconnexion');
                }
	}

	public function modifier(){
	    $this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model('client');

		$this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
		$this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
		$this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
		$this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
		$this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');
                if(isset($_COOKIE['clientCookie'])){
                    $varmail= $this->input->cookie('clientCookie');
                    $data['client'] = $this->client->selectByMail($varmail);
                    $mdp = $data['client'][0]->mdpClient;
                    $id = $data['client'][0]->idClient;
                    if ($this->form_validation->run() == FALSE) {
			            $this->load->view('client/profil');
                    } else {
			if ($varmail != $_POST['mailClient']) {
				$data['message']="erreur : Vous ne pouvez pas changer votre adresse mail";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('client/inscription');
			} else if ($_POST['mdpClient'] == $_POST['mdpClient2'] && $mdp == $_POST['mdpClient']) {
                                $data = array(
					"prenomClient" => htmlspecialchars($_POST['prenomClient']),
					"nomClient" => htmlspecialchars($_POST['nomClient']),
					"mailClient" => htmlspecialchars($_POST['mailClient']),
					"mdpClient" => htmlspecialchars($_POST['mdpClient']),
					"adresseClient" => htmlspecialchars($_POST['adresseClient']),
					"codePClient" => htmlspecialchars($_POST['codePClient']),
					"villeClient" => htmlspecialchars($_POST['villeClient']),
					"telClient" => htmlspecialchars($_POST['telClient']),
					"pointClient" => htmlspecialchars(0),
				);
                                
				$this->client->update($id,$data);
                                $data['client']= $this->client->selectByMail($varmail);
				$this->load->view('client/header');
                                $this->load->view('client/profil',$data);
                                $this->load->view('client/footer');
			} else {
				$data['message']="erreur : la confirmation de Mot de passe ne correspond pas au premier";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('client/header');
                                $this->load->view('client/profil',$data);
                                $this->load->view('client/footer');
			}
		}
            }
            else{
                $this->load->view('pages/deconnexion');
            }
        }
	public function profil()
	{
		$this->load->model('client');
		$this->load->helper('form', 'url');
		$this->load->helper('cookie');
		$this->load->library('form_validation');
                if(isset($_COOKIE['clientCookie'])){
                    $varmail= $this->input->cookie('clientCookie');
                    
                    if(isset($varmail)){
                        $data['client'] = $this->client->selectByMail($varmail);
                        var_dump($_COOKIE['clientCookie']);
                        $this->load->view('client/header');
                        $this->load->view('client/profil',$data);
                        $this->load->view('client/footer');
                    }
                }
                else{
                    var_dump($_COOKIE);
                }
		
		// modifie le profil à l'envoi du formulaire
	}

	public function inscription(){
		// faire envoi de mail
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model('client');

		$this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
		$this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
		$this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
		$this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
		$this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('client/inscription');
		} else {
			if (null != $this->client->selectByMail($_POST['mailClient'])) {
				$data['message']="erreur : cet email n'est pas disponible";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('client/inscription');
			} else if ($_POST['mdpClient'] == $_POST['mdpClient2']) {
				$data = array(
					"prenomClient" => htmlspecialchars($_POST['prenomClient']),
					"nomClient" => htmlspecialchars($_POST['nomClient']),
					"mailClient" => htmlspecialchars($_POST['mailClient']),
					"mdpClient" => htmlspecialchars($_POST['mdpClient']),
					"adresseClient" => htmlspecialchars($_POST['adresseClient']),
					"codePClient" => htmlspecialchars($_POST['codePClient']),
					"villeClient" => htmlspecialchars($_POST['villeClient']),
					"telClient" => htmlspecialchars($_POST['telClient']),
					"pointClient" => htmlspecialchars(0),
				);
				$this->client->insert($data);
				$this->load->view('pages/pageConnexion');
			} else {
				$data['message']="erreur : la confirmation de Mot de passe ne correspond pas au premier";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('client/inscription');
			}
		}
	}

	/*$this->load->library('email');

	$this->email->from('cci@yopmail.com', 'Piscine');
	$this->email->to($data['mailClient']);
	$this->email->subject('CCI Email Validation');
	$this->email->message('follow this link');

	$this->load->view('client/validationEmail');

	$this->email->send();*/


	public function connexion(){
		$this->load->helper('form', 'url');
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->model('client');
		$this->form_validation->set_rules('mailClient', 'Email', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('client/connexion');
		} else {
			$client = $this->client->selectByMail($_POST['mailClient']);
			//le client qui essaye de se connecter
                        
			if ($client == null) {
				$data['message']="erreur : cet email n'existe pas";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('client/connexion');
			}
			else{
				if ($client[0]->mdpClient != $_POST['mdp']) {
					$data['message']="erreur : mauvais mot de passe";
					$this->load->view('errors/erreur_formulaire', $data);
					$this->load->view('client/connexion');
				}
				else{
					$data['client'] = $client;
					if( $data['client'] != NULL && $_POST['mdp'] == $data['client'][0]->mdpClient ){
						setcookie('clientCookie',$data['client'][0]->mailClient,time()+36000);
                                                $this->load->view('client/header');
                                                $this->load->view('client/accueil');
                                                $this->load->view('client/footer');
                                            
					}
				}
			}
		}
}

		public function check_connexion(){
			$this->load->helper('cookie');
			$this->load->helper('form', 'url');
			if(isset($_POST['mail']) && isset($_POST['mdp']) ){
				$this->load->model('client');
				$data['client'] = $this->client->selectByMail($_POST['mail']);

				if( $data['client'] != NULL && $_POST['mdp'] == $data['client'][0]->mdpClient ){
					$cookie = array(
						'name'   => 'clientCookie',
						'value'  => $data['client'][0]->mailClient,
						'expire' => '3600'
					);
					$this->input->set_cookie($cookie);

					echo $this->input->cookie('clientCookie');

				}
				else{
					$data['message']="erreur : mauvais mot de passe ou mauvaise adresse mail";
					$this->load->view('errors/erreur_formulaire', $data);
					$this->load->view('client/connexion');
				}
			}
			else{
				// erreur
			}
		}

		/*
		 *
		public function changer_mdp(){
        $this->load->model('client');
        $this->load->helper('url');
        $this->load->library('form_validation');
        if(isset($_COOKIE['clientCookie'])){
            $varid= $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varid);
            if(isset($_POST['mdpclientAncien']) && ($_POST['mdpclientAncien'] == $data['client'][0]->mdpClient) ){
                if($_POST['mdpClientNouveau'] == $_POST['mdpClientConf']){
                    $newMdp = $_POST['mdpClientNouveau'];
                    $this->client->updateMdp($varid,$newMdp);
                    delete_cookie("clientCookie");
                    $this->load->view('client/connexion');
                }
                else{
                    $this->load->view('client/index',$data);
                    $this->load->view('client/changer_mdp',$data);
                }
            }
            else{
                $this->load->view('client/index',$data);
                $this->load->view('client/changer_mdp',$data);
            }
        }
        else{
            $this->load->view('client/connexion');
        }
    }
		 */

    public function changer_mdp(){
        $this->load->model('client');
        $this->load->helper('url');
        $this->load->library('form_validation');

        if(isset($_COOKIE['clientCookie'])){
            $varid= $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varid);
            if(isset($_POST['mdpClientAncien']) && ($_POST['mdpClientAncien'] == $data['client'][0]->mdpClient) ){
                if($_POST['mdpClientNouveau'] == $_POST['mdpClientConf']){
                    $newMdp = $_POST['mdpClientNouveau'];
                    $this->client->updateMdp($varid,$newMdp);
                    setcookie("clientCookie","",time()-36000);
                    $this->load->view('client/connexion');
                }
                else{
                    $this->load->view('client/header');
                    $this->load->view('client/changer_mdp',$data);
                    $this->load->view('client/footer');
                }
            }
            else{
                $this->load->view('client/header');
                $this->load->view('client/changer_mdp',$data);
                $this->load->view('client/footer');
            }
        }
        else{
            $this->load->view('client/accueil');
        }
    }

		public function deconnexion(){
                        $this->load->helper('form', 'url');
			$this->load->helper('cookie');
			setcookie("clientCookie","",time()-36000);
			$this->load->view('pages/deconnexion');
			$this->connexion();
		}
}