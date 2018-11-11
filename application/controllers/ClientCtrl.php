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
        }
        
           public function modifierprofil()
        {
            // formulaire pour mofdifer les données du client à faire
            // modification de la bdd avec la fct Update
        }
        
        
        public function inscription(){
                $this->load->model('client');
		$this->load->helper('form');
<<<<<<< HEAD
		$this->load->view('client/inscription');		
=======
		$this->load->view('client/inscription');
                if(isset($_GET['mdpClient']) && $_GET['mdpClient']==$_GET['mdpClient2']){
                $data=array(
                            "prenomClient"=> htmlspecialchars($_GET['prenomClient']),
                            "nomClient"=> htmlspecialchars($_GET['nomClient']),
                            "mailClient" => htmlspecialchars($_GET['mailClient']),
                            "mdpClient" => htmlspecialchars($_GET['mdpClient']),
                            "adresseClient"=> htmlspecialchars($_GET['adresseClient']),
                            "codePClient"=> htmlspecialchars($_GET['codePClient']),
                            "villeClient" => htmlspecialchars($_GET['villeClient']),
                            "telClient" => htmlspecialchars($_GET['telClient']),
                            "pointClient" => htmlspecialchars(0),
			);	
   		$this->client->insert($data);
           
                }          
>>>>>>> 9ac67fdc47309d8ed587e0e7c15cc41b09a7942c
	}
   
}
