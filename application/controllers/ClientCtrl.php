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
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->model('client');

		$this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
		$this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
		$this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
		$this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
		$this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');
		//$this->form_validation->set_rules('mailClient', 'Email', 'is_unique[client.mailClient]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('client/inscription.php');
		}
		else
		{
			if($_POST['mdpClient'] == $_POST['mdpClient2'] ){
				echo "formumaire bien remplie";
				$data=array(
					"prenomClient"=> htmlspecialchars($_POST['prenomClient']),
					"nomClient"=> htmlspecialchars($_POST['nomClient']),
					"mailClient" => htmlspecialchars($_POST['mailClient']),
					"mdpClient" => htmlspecialchars($_POST['mdpClient']),
					"adresseClient"=> htmlspecialchars($_POST['adresseClient']),
					"codePClient"=> htmlspecialchars($_POST['codePClient']),
					"villeClient" => htmlspecialchars($_POST['villeClient']),
					"telClient" => htmlspecialchars($_POST['telClient']),
					"pointClient" => htmlspecialchars(0),
				);
				$this->client->insert($data);
			}
			else {
				$this->load->view('client/inscription.php');
				echo '<div class="alert alert-danger text-center">La confirmation de Mot de passe ne correspond pas au premier</div>';
			}
		}

			/*$this->load->library('email');

			$this->email->from('cci@yopmail.com', 'Piscine');
			$this->email->to($data['mailClient']);
			$this->email->subject('CCI Email Validation');
			$this->email->message('follow this link');

			$this->load->view('client/validationEmail');

			$this->email->send();*/
	}

}
