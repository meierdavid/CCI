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
                $this->load->model('administrateur');
		$this->load->helper('form');
		$this->load->view('administrateur/inscription');
                if(isset($_GET['mdpAdministrateur']) && $_GET['mdpAdministrateur']==$_GET['mdpAdministrateur2']){
                $data=array(
                            "prenomAdministrateur"=> htmlspecialchars($_GET['prenomAdministrateur']),
                            "nomAdministrateur"=> htmlspecialchars($_GET['nomAdministrateur']),
                            "mailAdministrateur" => htmlspecialchars($_GET['mailAdministrateur']),
                            "mdpAdministrateur" => htmlspecialchars($_GET['mdpAdministrateur']),
                            "adresseAdministrateur"=> htmlspecialchars($_GET['adresseAdministrateur']),
                            "codePAdministrateur"=> htmlspecialchars($_GET['codePAdministrateur']),
                            "villeAdministrateur" => htmlspecialchars($_GET['villeAdministrateur']),
                            "telAdministrateur" => htmlspecialchars($_GET['telAdministrateur']),
			);	
   		$this->administrateur->insert($data);
           
                }          
	}
           public function connexion(){
                $this->load->model('administrateur');
		$this->load->helper('form');
		$this->load->view('administrateur/inscription');
 
                $data['administrateur'] = $this->administrateur->selectByMail($_GET['mailAdministrateur']);
                
                if( $data['administrateur' != NULL]){
                    $this->load-view('pages/accueil');
                }           
           }
}
