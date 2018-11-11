<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageCtrl extends CI_Controller {

	
	public function index()
	
	{
                
		$this->load->helper('url');
		$this->load->view('pages/pageconnexion');
                
	}

	public function Connexion()
	
	{
		$this->load->helper('url');
		$this->load->view('pages/pageconnexion');
                
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
