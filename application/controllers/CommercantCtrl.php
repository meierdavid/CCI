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
    
    public function check_connexion(){
       
        if(isset($_POST['mail']) && isset($_POST['mdp']) ){
            $this->load->model('commercant');
            $data['commercant'] = $this->commercant->selectByMail($_POST['mail']);
            
            if( $data['commercant'] != NULL && $_POST['mdp'] == $data['commercant'][0]->mdpCommercant ){
                $this->load->view('commercant/index',$data);
            }
            else{
                //$erreur="erreur mauvais mot de passe ou mauvaise adresse mail";
                //$data['error']=$erreur;
                $this->load->view('commercant/connexion');
                // erreur mauvais mdp ou mauvaise adresse mail
            }
        }
        else{
            // erreur 
        }
    }
    
    public function connexion(){
        $this->load->helper('url');
        $this->load->view('commercant/connexion');
        
    }
        
    public function validation_inscription(){
        $this->load->model('commercant');		
        $this->load->helper('form');
        if(isset($_POST['mdpCommercant']) && $_POST['mdpCommercant']==$_POST['mdpCommercant2']){
                $data=array(
                            "prenomCommercant"=> htmlspecialchars($_POST['prenomCommercant']),
                            "nomCommercant"=> htmlspecialchars($_POST['nomCommercant']),
                            "mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
                            "mdpCommercant" => htmlspecialchars($_POST['mdpCommercant']),
                            "adresseCommercant"=> htmlspecialchars($_POST['adresseCommercant']),
                            "codePCommercant"=> htmlspecialchars($_POST['codePCommercant']),
                            "villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
                            "telCommercant" => htmlspecialchars($_POST['telCommercant']),);  
                $this->commercant->insert($data); 
                $this->load->view('commercant/validation_inscription');
        }
        else{
             $this->load->view('commercant/inscription');
        }
        
    }
    public function inscription(){
        $this->load->model('commercant');		
        $this->load->helper('form');
        $this->load->view('commercant/inscription');
      
	}

}
