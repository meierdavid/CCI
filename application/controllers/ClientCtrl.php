<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientCtrl extends CI_Controller {

	
	public function index()
	
	{       
            $this->load->helper('url');
            $this->load->view('client/profil');               
	}

        public function profil($mail)
        {
            $data['client'] = $this->client->selectById($mail);
            $this->load->model('client');
            $this->load->helper('url');
            $this->load->view('client/profil',$data);
        }
        
        
        public function inscription(){
                $this->load->model('client');
		$this->load->helper('form');
		$this->load->view('client/inscription');
                if($_GET['mdpClient']==$_GET['mdpClient2']){
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
	}
           public function connexion(){
                $this->load->model('client');
		$this->load->helper('form');
		$this->load->view('client/inscription');
 
                $data['client'] = $this->client->selectByMail($_GET['mailClient']);
                
                if( $data['client' != NULL]){
                    $this->load-view('pages/accueil');
                }           
           }
}
