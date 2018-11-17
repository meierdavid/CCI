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
                $this->load->model('client');
		$this->load->helper('form');

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
                /*$this->load->library('email');

                $this->email->from('cci@yopmail.com', 'Piscine');
                $this->email->to($data['mailClient']);
                $this->email->subject('CCI Email Validation');
                $this->email->message('follow this link');
                
                $this->load->view('client/validationEmail');
                
                $this->email->send();*/
                if(true){
   		$this->client->insert($data);
                }
                }          

	}
   
}
