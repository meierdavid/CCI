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
        $this->load->model('commercant');		
		$this->load->helper('form');
		$this->load->view('commercant/inscription');
        if(isset($_GET['mdpCommercant']) && $_GET['mdpCommercant']==$_GET['mdpCommercant2']){
                $data=array(
                            "prenomCommercant"=> htmlspecialchars($_GET['prenomCommercant']),
                            "nomCommercant"=> htmlspecialchars($_GET['nomCommercant']),
                            "mailCommercant" => htmlspecialchars($_GET['mailCommercant']),
                            "mdpCommercant" => htmlspecialchars($_GET['mdpCommercant']),
                            "adresseCommercant"=> htmlspecialchars($_GET['adresseCommercant']),
                            "codePCommercant"=> htmlspecialchars($_GET['codePCommercant']),
                            "villeCommercant" => htmlspecialchars($_GET['villeCommercant']),
                            "telCommercant" => htmlspecialchars($_GET['telCommercant']),);  
                $this->commercant->insert($data); 
        }  	
	}

}
