<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommercantCtrl extends CI_Controller {

	
	public function index()
	{       
        $this->load->helper('url');
        $this->load->view('commercant/profil');               
	}

    public function profil($id)
    {
        $data['commercant'] = $this->commercant->selectById($id);
        $this->load->model('Commercant');
        $this->load->helper('url');
        $this->load->view('commercant/profil',$data);
    }
        
        
    public function inscription(){		
		$this->load->helper('form');
		$this->load->view('commercant/inscription');   	
	}

}
