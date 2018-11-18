<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommercantCtrl extends CI_Controller {

	
	public function index()
	{       
        $this->load->helper('url');
        $this->load->view('commercant/profil');               
	}

    public function profil()
    {
        $var="davidmeier@hotmail.fr"; // rentrer un mail dans votre base de données en attendant qu'on fasse les cookies
        $this->load->model('commercant');
        $this->load->helper('url');
        $data['commercant'] = $this->commercant->selectByMail($var);
        $this->load->view('commercant/index',$data);
        $this->load->view('commercant/profil',$data);
    }
    public function changer_mdp(){ // info commercant avec cookie
        // Pas FINIT
        $this->load->model('commercant');
        $this->load->helper('url');
        if(isset($_POST['mdpCommercantAncien'])  ){ // + tester Bon Ancien mot de passe
            if($_POST['mdpCommercantNouveau'] == $_POST['mdpCommercantConf']){
                //Update Nouveau Mot de passe
            }
        }
        $data['commercant'] = $this->commercant->selectByMail(); // rentrer un mail dans votre base de données en attendant qu'on fasse les cookies
        $this->load->view('commercant/index',$data);
        $this->load->view('commercant/changer_mdp',$data);
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
    public function liste_entreprise(){ //mettre parametre mail ou utiliser cookie
        $this->load->model('commercant');
        $this->load->model('entreprise');
        $data['entreprises']=$this->commercant->selectEntreprise("davidmeier@hotmail.fr");
        if( $data['entreprises'] == NULL){
           $this->load->view('commercant/liste_entreprise',$data);
        }
        else{
            // ce commerçant n'a pas d'entreprise ( lui proposer d'en ajouter une )
        }
    }
    public function add_entreprise() { //mettre parametre mail ou utiliser cookie
        
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
    public function lie_commercant(){
        //vérifier le num de siret du commercant
        // ajouter à la table faire_partie
        $this->load->model('commercant');		
        $this->load->helper('form');
        $this->load->view('commercant/lie_commercant');
        
    }
    public function inscription(){
        $this->load->model('commercant');		
        $this->load->helper('form');
        $this->load->view('commercant/inscription');
      
	}

}
