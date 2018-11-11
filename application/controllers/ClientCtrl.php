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
		$this->load->helper('form');
		$this->load->view('client/inscription');		
	}

}
