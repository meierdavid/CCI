<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntrepriseCtrl extends CI_Controller {

	
	public function index()
	{       
            $this->load->helper('url');
            $this->load->view('Entreprise/index');               
	}

        public function add_entreprise(){ //^paremetre mail du commercant ou cookie pour le récupérer
            $this->load->model('entreprise');		
            $this->load->helper('form');
            $this->load->view('entreprise/ajout_entreprise');
        }

}
