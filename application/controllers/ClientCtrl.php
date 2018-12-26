<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientCtrl extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('client/profil');
	}

	public function profil()
	{
		$this->load->model('client');
		$data['client'] = $this->client->selectById(1);
		//mettre mail pour la sélection
		$this->load->helper('url');
		$this->load->view('client/profil',$data);
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
	public function view(){
		$this->load->helper('form', 'url');
		$this->load->view('template/index');
	}

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
				$this->load->view('client/lie_client');
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
						$cookie = array(
							'name'   => 'clientCookie',
							'value'  => $data['client'][0]->mailClient,
							'expire' => '3600'
						);
						$this->input->set_cookie($cookie);
						echo $this->input->cookie('clientCookie');
						$this->load->view('template/index');
					}
				}
			}
		}   }

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
		public function deconnexion(){
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('cookie');
			delete_cookie("clientCookie");
			$this->load->view('pages/deconnexion');
			$this->load->view('pages/pageconnexion');
		}

        }

			/*$this->load->library('email');

			$this->email->from('cci@yopmail.com', 'Piscine');
			$this->email->to($data['mailClient']);
			$this->email->subject('CCI Email Validation');
			$this->email->message('follow this link');

			$this->load->view('client/validationEmail');

			$this->email->send();*/
public function view(){
    $this->load->helper('form', 'url');
    $this->load->view('template/index');
}

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
            $this->load->view('client/lie_client');
            echo "<div class='alert alert-danger text-center'>Cet email n'existe pas</div>";
        }
        else{
            if ($client[0]->mdpClient != $_POST['mdp']) {
            $this->load->view('client/connexion');
            echo "<div class='alert alert-danger text-center'>Mauvais mot de passe</div>";
            }
            else{
                echo "formumaire bien remplie";
                $data['client'] = $client;
                if( $data['client'] != NULL && $_POST['mdp'] == $data['client'][0]->mdpClient ){
                    $cookie = array(
                       'name'   => 'clientCookie',
                       'value'  => $data['client'][0]->mailClient,
                       'expire' => '3600'
                    );
                    $this->input->set_cookie($cookie);
                    echo $this->input->cookie('clientCookie');
                    $this->load->view('template/index');
                }
            }
        }
}

}


    public function deconnexion(){
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->helper('cookie');
            delete_cookie("clientCookie");
            $this->load->view('pages/deconnexion');
            $this->load->view('pages/pageconnexion');
        }
	}
