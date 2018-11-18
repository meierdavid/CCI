<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrateurCtrl extends CI_Controller {


  public function index()

  {
    $this->load->helper('url');
    $this->load->view('administrateur/profil');
  }

  public function profil($mail)
  {
    $data['administrateur'] = $this->administrateur->selectById($mail);
    $this->load->model('administrateur');
    $this->load->helper('url');
    $this->load->view('administrateur/profil',$data);
  }

  public function inscription(){
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->model('administrateur');

		$this->form_validation->set_rules('prenomAdministrateur', 'Prénom', 'alpha_dash');
		$this->form_validation->set_rules('nomAdministrateur', 'Nom', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('mailAdministrateur', 'Email', 'valid_email');
		$this->form_validation->set_rules('codePAdministrateur', 'Code postale', 'integer');
		$this->form_validation->set_rules('villeAdministrateur', 'Ville', 'alpha_dash');
		$this->form_validation->set_rules('telAdministrateur', 'Numéro de téléphone', 'integer');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('administrateur/inscription.php');
		}
		else
		{
      if (null != $this->administrateur->selectByMail($_POST['mailAdministrateur'])){
				$this->load->view('administrateurt/inscription.php');
				echo "<div class='alert alert-danger text-center'>Cet email n'est pas disponible</div>";
			}
			else if($_POST['mdpAdministrateur'] == $_POST['mdpAdministrateur2'] ){
				echo "formumaire bien remplie";
				$data=array(
					"prenomAdministrateur"=> htmlspecialchars($_POST['prenomAdministrateur']),
					"nomAdministrateur"=> htmlspecialchars($_POST['nomAdministrateur']),
					"mailAdministrateur" => htmlspecialchars($_POST['mailAdministrateur']),
					"mdpAdministrateur" => htmlspecialchars($_POST['mdpAdministrateur']),
					"adresseAdministrateur"=> htmlspecialchars($_POST['adresseAdministrateur']),
					"codePAdministrateur"=> htmlspecialchars($_POST['codePAdministrateur']),
					"villeAdministrateur" => htmlspecialchars($_POST['villeAdministrateur']),
					"telAdministrateur" => htmlspecialchars($_POST['telAdministrateur']),
				);
				$this->administrateur->insert($data);
			}
			else {
				$this->load->view('administrateur/inscription.php');
				echo '<div class="alert alert-danger text-center">La confirmation de Mot de passe ne correspond pas au premier</div>';
			}
		}
	}

  public function connexion(){
    $this->load->model('administrateur');
    $this->load->helper('form');
    //$this->load->view('administrateur/inscription');

    $data['administrateur'] = $this->administrateur->selectByMail($_POST['mail']);

    if( $data['administrateur'] != NULL){
      $this->load->view('pages/page_index');
    }
  }
}
