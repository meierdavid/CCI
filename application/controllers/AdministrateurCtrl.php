<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrateurCtrl extends CI_Controller {


  public function index()

  {
    $this->load->helper('url');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->view('administrateur/index');
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
		$this->load->helper('form', 'url');
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->model('administrateur');
		$this->form_validation->set_rules('mailAdministrateur', 'Email', 'required');
                
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('administrateur/connexion');
		} else {
			$administrateur = $this->administrateur->selectByMail($_POST['mailAdministrateur']);
			//l'administrateur qui essaye de se connecter
                        
			if ($administrateur == null) {
				$this->load->view('administrateur/connexion');
				echo "<div class='alert alert-danger text-center'>Cet email n'existe pas</div>";
			}
			else{
				if ($administrateur[0]->mdpAdministrateur != $_POST['mdpAdministrateur']) {
					$this->load->view('administrateur/connexion');
					
					"<div class='alert alert-danger text-center'>Mauvais mot de passe</div>";
				}
				else{
					echo "formumaire bien remplie";
					$data['administrateur'] = $administrateur;
					if( $data['administrateur'] != NULL && $_POST['mdpAdministrateur'] == $data['administrateur'][0]->mdpAdministrateur ){
						$cookie = array(
							'name'   => 'administrateurCookie',
							'value'  => $data['administrateur'][0]->mailAdministrateur,
							'expire' => '3600'
						);
						$this->input->set_cookie($cookie);
						echo $this->input->cookie('administrateurCookie');
						$this->load->view('administrateur/index');
					}
				}
			}
		}   
        }
          
    public function deconnexion(){
            $this->load->helper('url');
            $this->load->helper('cookie');
            $this->load->helper('form');
            delete_cookie("administrateurCookie");
            $this->load->view('pages/deconnexion');
            $this->load->view('pages/pageconnexion');
        }
        
    public function ajout_administrateur(){
            // faire envoi de mail
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model('administrateur');
        $this->load->view('administrateur/index');

		$this->form_validation->set_rules('prenomAdministrateur', 'Prénom', 'alpha_dash');
		$this->form_validation->set_rules('nomAdministrateur', 'Nom', 'alpha_numeric_spaces');
		$this->form_validation->set_rules('mailAdministrateur', 'Email', 'valid_email');
		$this->form_validation->set_rules('codePAdministrateur', 'Code postale', 'integer');
		$this->form_validation->set_rules('villeAdministrateur', 'Ville', 'alpha_dash');
		$this->form_validation->set_rules('telAdministrateur', 'Numéro de téléphone', 'integer');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('administrateur/ajout_administrateur');
		} else {
			if (null != $this->administrateur->selectByMail($_POST['mailAdministrateur'])) {
				$data['message']="erreur : cet email n'est pas disponible";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('administrateur/ajout_administrateur');
			} else if ($_POST['mdpAdministrateur'] == $_POST['mdpAdministrateur2']) {
				$data = array(
					"prenomAdministrateur" => htmlspecialchars($_POST['prenomAdministrateur']),
					"nomAdministrateur" => htmlspecialchars($_POST['nomAdministrateur']),
					"mailAdministrateur" => htmlspecialchars($_POST['mailAdministrateur']),
					"mdpAdministrateur" => htmlspecialchars($_POST['mdpAdministrateur']),
					"adresseAdministrateur" => htmlspecialchars($_POST['adresseAdministrateur']),
					"codePAdministrateur" => htmlspecialchars($_POST['codePAdministrateur']),
					"villeAdministrateur" => htmlspecialchars($_POST['villeAdministrateur']),
					"telAdministrateur" => htmlspecialchars($_POST['telAdministrateur']),
				);
				$this->administrateur->insert($data);
				$this->load->view('administrateur/index');
			} else {
				$data['message']="erreur : la confirmation de Mot de passe ne correspond pas au premier";
				$this->load->view('errors/erreur_formulaire', $data);
				$this->load->view('administrateur/ajout_administrateur');
			}
		}
        }
        
    public function changer_mdp(){
            $this->load->helper('cookie');
            $this->load->model('administrateur');
            $this->load->helper('url');
            $this->load->library('form_validation');
            var_dump($_COOKIE);
            if(isset($_COOKIE['administrateurCookie'])){
                    $varid= $this->input->cookie('administrateurCookie');
                    $data['administrateur'] = $this->administrateur->selectByMail($varid);
                    
		if(isset($_POST['ancienMdp']) && ($_POST['ancienMdp'] == $data['administrateur'][0]->mdpAdministrateur) ){ // + tester Bon Ancien mot de passe
			if($_POST['mdpAdministrateur'] == $_POST['mdpAdministrateur2']){
				$newMdp = $_POST['mdpAdministrateur'];
				$this->administrateur->updateMdp($varid,$newMdp);
				delete_cookie("administrateurCookie");
				$this->load->view('administrateur/index');
			}
			else{
				$this->load->view('administrateur/index',$data);
				$this->load->view('administrateur/changer_mdp',$data);
			}
		}
		else{
			$this->load->view('administrateur/index',$data);
			$this->load->view('administrateur/changer_mdp',$data);
		}
            }
            else{
                $this->load->view('administrateur/connexion');
            }
        }
		
		
		
    public function ajout_entreprise(){
			
    }
        
		
		
    public function ajout_commercant(){
			$this->load->model('commercant');
			$this->load->helper('form','url');
			$this->load->library('form_validation');
			$this->load->view('administrateur/index');
			$this->form_validation->set_rules('prenomCommercant', 'Prénom', 'alpha_dash');
			$this->form_validation->set_rules('nomCommercant', 'Nom', 'alpha_numeric_spaces');
			$this->form_validation->set_rules('mailCommercant', 'Email', 'valid_email');
			$this->form_validation->set_rules('codePCommercant', 'Code postale', 'integer');
			$this->form_validation->set_rules('villeCommercant', 'Ville', 'alpha_dash');
			$this->form_validation->set_rules('telCommercant', 'Numéro de téléphone', 'integer');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('administrateur/ajout_commercant');
			}
			else
			{
				if (null != $this->commercant->selectByMail($_POST['mailCommercant'])){
					$data['message']="erreur : cet email n'est pas disponible";
					$this->load->view('errors/erreur_formulaire', $data);
					$this->load->view('administrateur/ajout_commercant');
				}
				else if($_POST['mdpCommercant'] == $_POST['mdpCommercant2'] ){
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
					$this->load->view('administrateur/confirmation_ajout_commercant');
					$this->load->view('administrateur/index');
				}
				else {
					$data['message']="erreur : la confirmation de Mot de passe ne correspond pas au premier";
					$this->load->view('errors/erreur_formulaire', $data);
					$this->load->view('administrateur/ajout_commercant');
				}
			}
        }
        
    public function liste_commercant(){
		$this->load->helper('cookie');
		$this->load->model('commercant');
		$this->load->model('administrateur');
		if($this->input->cookie('administrateurCookie') != null){
			$varid = $this->input->cookie('administrateurCookie');
			$data['commercant'] = $this->commercant->selectAll($varid);
						var_dump($data["commercant"]);
			if( $data['commercant'] != NULL){
				$this->load->view('administrateur/index',$data);
				$this->load->view('administrateur/liste_commercant',$data);
			}
			else{
				$this->ajout_commercant();
			}
		}
		else{
			$this->load->view('commercant/connexion');
		}
	}
	
        
	public function supprimer_produit($id){
		$this->load->model('produit');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->view('administrateur/index');
		$this->produit->delete($id);
		echo "produit Supprimé";
		$this->liste_produit();
    }
        

	public function supprimer_client($id){
		$this->load->model('client');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->view('administrateur/index');
		$this->client->delete($id);
		echo "client Supprimé";
		
    }
	
	
	public function supprimer_commercant($id){
		$this->load->database();
		$this->load->model('commercant');
		$this->load->model('faire_partie');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->view('administrateur/index');
		$this->faire_partie->deleteById($id);
		$this->commercant->delete($id);
		echo "commercant Supprimé";
    }
	
	
	public function supprimer_entreprise($id){
		$this->load->database();
		$this->load->model('entreprise');
		$this->load->model('faire_partie');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->view('administrateur/index');
		$this->faire_partie->deleteByNumSiret($id);
		$this->entreprise->delete($id);
		echo "Entreprise Supprimé";
    }
	
          
          
}
