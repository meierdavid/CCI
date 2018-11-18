<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntrepriseCtrl extends CI_Controller {

	
	public function index()
	{       
            $this->load->helper('url');
            $this->load->view('Entreprise/index');               
	}

        public function add_entreprise(){ //paremetre mail du commercant ou cookie pour le récupérer
            $this->load->model('entreprise');		
            $this->load->helper('form');
            $this->load->view('entreprise/ajout_entreprise');
        }
        
        public function profil($num){
                $this->load->helper('cookie');
                $this->load->helper('url');
                if($this->input->cookie('commercantCookie')!= FALSE){ // il faudra vérifier que c'est le bon commerçant qui est connecté
                    $this->load->model('entreprise');
                    $data['entreprise'] =$this->entreprise->selectById($num);
                    $this->load->view('entreprise/index',$data);
                    $this->load->view('entreprise/profil',$data);
                }
                else{
                    $this->load->view('pages/pageconnexion');
                }
        }
}
