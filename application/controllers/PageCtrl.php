<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageCtrl extends CI_Controller {

	
	public function index()
	
	{
                
		$this->load->helper('url');
		$this->load->view('pages/pageconnexion');
                
	}
        public function Accueil()
        {
            $this->load->helper('url');
            $this->load->view('pages/pageaccueil');
        }
	public function Connexion()
	
	{
		$this->load->helper('url');
		$this->load->view('pages/pageconnexion');
                $this->load->model('client');
                $data['client'] = $this->client->selectByMail($_GET['mailClient']);
                var_dump($data['client']);
                die;
                if( $data['client' != NULL]){
                    $this->load-view('pages/pageaccueil');
                } 
                else{
                    $this->load-view('pages/pageaccueil');
                }
                
	}
    
        public function ConnexionAdmin()
	
	{
		$this->load->helper('url');
		$this->load->view('pages/pageconnexionadmin');
	}

	public function ConnexionSellers()

	{
		$this->load->helper('url');
		$this->load->view('pages/pageconnexionsellers');
	}

}
