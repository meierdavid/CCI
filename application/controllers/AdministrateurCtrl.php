<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrateurCtrl extends CI_Controller {

  public function index() {
    $this->load->helper('url');
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->view('administrateur/index');
  }

  public function profil($mail) {
    $data['administrateur'] = $this->administrateur->selectById($mail);
    $this->load->model('administrateur');
    $this->load->helper('url');
    $this->load->view('administrateur/profil', $data);
  }

  public function inscription() {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('administrateur');

    $this->form_validation->set_rules('prenomAdministrateur', 'Prénom', 'alpha_dash');
    $this->form_validation->set_rules('nomAdministrateur', 'Nom', 'alpha_numeric_spaces');
    $this->form_validation->set_rules('mailAdministrateur', 'Email', 'valid_email');
    $this->form_validation->set_rules('codePAdministrateur', 'Code postale', 'integer');
    $this->form_validation->set_rules('villeAdministrateur', 'Ville', 'alpha_dash');
    $this->form_validation->set_rules('telAdministrateur', 'Numéro de téléphone', 'integer');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('administrateur/inscription.php');
    } else {
      if (null != $this->administrateur->selectByMail($_POST['mailAdministrateur'])) {
        $data['message'] = "erreur : cet email n'est pas disponible";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateurt/inscription');
      } else if ($_POST['mdpAdministrateur'] == $_POST['mdpAdministrateur2']) {
        $data = array(
          "prenomAdministrateur" => htmlspecialchars($_POST['prenomAdministrateur']),
          "nomAdministrateur" => htmlspecialchars($_POST['nomAdministrateur']),
          "mailAdministrateur" => htmlspecialchars($_POST['mailAdministrateur']),
          "mdpAdministrateur" => htmlspecialchars(crypt($_POST['mdpAdministrateur'],'md5')),
          "adresseAdministrateur" => htmlspecialchars($_POST['adresseAdministrateur']),
          "codePAdministrateur" => htmlspecialchars($_POST['codePAdministrateur']),
          "villeAdministrateur" => htmlspecialchars($_POST['villeAdministrateur']),
          "telAdministrateur" => htmlspecialchars($_POST['telAdministrateur']),
        );
        $this->administrateur->insert($data);
        $data['message'] = "Vous avez été inscrit en tant qu'administrateur";
        $this->load->view('errors/validation_formulaire', $data);
      } else {
        $data['message'] = "erreur : La confirmation de Mot de passe ne correspond pas au premier";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/inscription');
      }
    }
  }
  

  public function connexion() {
    $this->load->helper('form', 'url');
    $this->load->helper('cookie');
    $this->load->library('form_validation');
    $this->load->model('administrateur');
    $this->form_validation->set_rules('mailAdministrateur', 'Email', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('administrateur/connexion');
    } else {
      $administrateur = $this->administrateur->selectByMail($_POST['mailAdministrateur']);
      //l'administrateur qui essaye de se connecter

      if ($administrateur == null) {
        $data['message'] = "erreur : Cet email n'existe pas";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/connexion');
      } else {
        if (!password_verify($_POST['mdpAdministrateur'], $administrateur[0]->mdpAdministrateur)) {
          $data['message'] = "erreur : Mauvais mot de passe";
          $this->load->view('errors/erreur_formulaire', $data);
          $this->load->view('administrateur/connexion');
        } else {
          $data['administrateur'] = $administrateur;
          if ($data['administrateur'] != NULL && password_verify($_POST['mdpAdministrateur'], $administrateur[0]->mdpAdministrateur)) {
            $cookie = array(
              'name' => 'administrateurCookie',
              'value' => $data['administrateur'][0]->mailAdministrateur,
              'expire' => '3600'
            );
            $this->input->set_cookie($cookie);
            echo $this->input->cookie('administrateurCookie');
            $this->load->view('administrateur/index');
          }
        }
      }
    }
  }

  public function deconnexion() {
    $this->load->helper('url');
    $this->load->helper('cookie', 'form');
    delete_cookie("administrateurCookie");
    $data['message'] = "Vous avez été déconnecté avec succès";
    $this->load->view('errors/validation_formulaire', $data);
    $this->load->view('administrateur/connexion');
  }

  public function ajout_administrateur() {
    // faire envoi de mail
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('administrateur');
    
    $this->load->view('administrateur/index');

    $this->form_validation->set_rules('prenomAdministrateur', 'Prénom', 'alpha_dash');
    $this->form_validation->set_rules('nomAdministrateur', 'Nom', 'alpha_numeric_spaces');
    $this->form_validation->set_rules('mailAdministrateur', 'Email', 'valid_email');
    $this->form_validation->set_rules('codePAdministrateur', 'Code postale', 'integer');
    $this->form_validation->set_rules('villeAdministrateur', 'Ville', 'alpha_dash');
    $this->form_validation->set_rules('telAdministrateur', 'Numéro de téléphone', 'integer');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('administrateur/ajout_administrateur');
    } else {
      if (null != $this->administrateur->selectByMail($_POST['mailAdministrateur'])) {
        $data['message'] = "erreur : cet email n'est pas disponible";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/ajout_administrateur');
      } else if ($_POST['mdpAdministrateur'] == $_POST['mdpAdministrateur2']) {
        $data = array(
          "prenomAdministrateur" => htmlspecialchars($_POST['prenomAdministrateur']),
          "nomAdministrateur" => htmlspecialchars($_POST['nomAdministrateur']),
          "mailAdministrateur" => htmlspecialchars($_POST['mailAdministrateur']),
          "mdpAdministrateur" => htmlspecialchars(crypt($_POST['mdpAdministrateur'],'md5')),
          "adresseAdministrateur" => htmlspecialchars($_POST['adresseAdministrateur']),
          "codePAdministrateur" => htmlspecialchars($_POST['codePAdministrateur']),
          "villeAdministrateur" => htmlspecialchars($_POST['villeAdministrateur']),
          "telAdministrateur" => htmlspecialchars($_POST['telAdministrateur']),
        );
        $this->administrateur->insert($data);
        $data['message'] = "L'administrateur a bien été ajouté";
        $this->load->view('errors/validation_formulaire', $data);
      } else {
        $data['message'] = "erreur : la confirmation de Mot de passe ne correspond pas au premier";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/ajout_administrateur');
      }
    }
  }

  public function changer_mdp() {
    $this->load->helper('cookie');
    $this->load->model('administrateur');
    $this->load->helper('url');
    $this->load->library('form_validation');

    if (isset($_COOKIE['administrateurCookie'])) {
      $varid = $this->input->cookie('administrateurCookie');
      $data['administrateur'] = $this->administrateur->selectByMail($varid);

      if (isset($_POST['ancienMdp'])) {
        if (password_verify($_POST['ancienMdp'], $data['administrateur'][0]->mdpAdministrateur)){
          if ($_POST['mdpAdministrateur'] == $_POST['mdpAdministrateur2']) {
            $newMdp = crypt($_POST['mdpAdministrateur'],'md5');
            $this->administrateur->updateMdp($varid, $newMdp);
            delete_cookie("administrateurCookie");

            $cookie = array(
              'name' => 'administrateurCookie',
              'value' => $data['administrateur'][0]->mailAdministrateur,
              'expire' => '3600'
            );
            $this->input->set_cookie($cookie);
            echo $this->input->cookie('administrateurCookie');


            $data['message'] = "Le mot de passe a bien été modifié";
            $this->load->view('errors/validation_formulaire', $data);
            $this->load->view('administrateur/index');
          }
          else {
            $data['message'] = "erreur : La confirmation de mot de passe ne correspond pas au premier";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('administrateur/index', $data);
            $this->load->view('administrateur/changer_mdp', $data);
          }
        }
        else {
          $data['message'] = "erreur : L'ancien mot de passe n'est pas conforme";
          $this->load->view('errors/erreur_formulaire', $data);
          $this->load->view('administrateur/index', $data);
          $this->load->view('administrateur/changer_mdp', $data);
        }
      }
      else {
        $this->load->view('administrateur/index');
        $this->load->view('administrateur/changer_mdp');
      }
    }
    else {
      $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
      $this->load->view('errors/erreur_formulaire', $data);
      $this->load->view('administrateur/connexion');
    }
  }

  public function ajout_entreprise() {

  }

  public function ajout_commercant() {
    $this->load->model('commercant');
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->view('administrateur/index');
    $this->form_validation->set_rules('prenomCommercant', 'Prénom', 'alpha_dash');
    $this->form_validation->set_rules('nomCommercant', 'Nom', 'alpha_numeric_spaces');
    $this->form_validation->set_rules('mailCommercant', 'Email', 'valid_email');
    $this->form_validation->set_rules('codePCommercant', 'Code postale', 'integer');
    $this->form_validation->set_rules('villeCommercant', 'Ville', 'alpha_dash');
    $this->form_validation->set_rules('telCommercant', 'Numéro de téléphone', 'integer');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('administrateur/ajout_commercant');
    } else {
      if (null != $this->commercant->selectByMail($_POST['mailCommercant'])) {
        $data['message'] = "erreur : cet email n'est pas disponible";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/ajout_commercant');
      } else if ($_POST['mdpCommercant'] == $_POST['mdpCommercant2']) {
        $data = array(
          "prenomCommercant" => htmlspecialchars($_POST['prenomCommercant']),
          "nomCommercant" => htmlspecialchars($_POST['nomCommercant']),
          "mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
          "mdpCommercant" => htmlspecialchars(crypt($_POST['mdpCommercant'],'md5')),
          "adresseCommercant" => htmlspecialchars($_POST['adresseCommercant']),
          "codePCommercant" => htmlspecialchars($_POST['codePCommercant']),
          "villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
          "telCommercant" => htmlspecialchars($_POST['telCommercant']),
        );
        $this->commercant->insert($data);
        $this->load->view('administrateur/confirmation_ajout_commercant');
      } else {
        $data['message'] = "erreur : la confirmation de Mot de passe ne correspond pas au premier";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/ajout_commercant');
      }
    }
  }

  public function liste_commercant() {
    $this->load->helper('cookie');
    $this->load->model('commercant');
    $this->load->model('administrateur');
    if ($this->input->cookie('administrateurCookie') != null) {
      $varid = $this->input->cookie('administrateurCookie');
      $data['commercant'] = $this->commercant->selectAll($varid);
      if ($data['commercant'] != NULL) {
        $this->load->view('administrateur/index', $data);
        $this->load->view('administrateur/liste_commercant', $data);
      } else {
        $this->ajout_commercant();
      }
    } else {
      $this->load->view('administrateur/connexion');
    }
  }




  public function liste_client() {
    $this->load->helper('cookie');
    $this->load->model('client');
    $this->load->model('administrateur');
    if ($this->input->cookie('administrateurCookie') != null) {
      $varid = $this->input->cookie('administrateurCookie');
      $data['client'] = $this->client->selectAll();
      $this->load->view('administrateur/index', $data);
      $this->load->view('administrateur/liste_client', $data);
    } else {
      $this->load->view('administrateur/connexion');
    }
  }


  public function supprimer_avis($idProduit,$idClient){
    $this->load->model('poster_avis');
    $this->poster_avis->delete($idClient,$idProduit);
    $this->load->view('administrateur/index');
  }


  public function supprimer_produit($id) {
    $this->load->model('produit');
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->view('administrateur/index');
    $this->produit->delete($id);
    echo "produit Supprimé";
    $this->liste_produit();
  }

  public function supprimer_client($id) {
    $this->load->model('client');
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->view('administrateur/index');
    $this->poster_avis->deleteByidClient($id);
    $this->client->delete($id);
    echo "client Supprimé";
  }

  public function supprimer_commercant($id) {
    $this->load->database();
    $this->load->model('commercant');
    $this->load->model('faire_partie');
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->view('administrateur/index');
    $this->faire_partie->deleteById($id);
    $this->commercant->delete($id);
    echo "commercant Supprimé";
  }

  public function supprimer_entreprise($id) {
    $this->load->database();
    $this->load->model('entreprise');
    $this->load->model('faire_partie');
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->view('administrateur/index');
    $this->faire_partie->deleteByNumSiret($id);
    $this->entreprise->delete($id);
    echo "Entreprise Supprimé";
  }

  public function profil_client($id){
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('client');

    $data['client'] = $this->client->selectById($id);
    $this->load->view('administrateur/index');
    $this->load->view('administrateur/profil_client', $data);

  }
  
   public function profil_commercant($id){
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('commercant');

    $data['commercant'] = $this->commercant->selectById($id);
    $this->load->view('administrateur/index');
    $this->load->view('administrateur/profil_commercant', $data);

  }

  public function modifier_client() {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('client');
    $this->form_validation->set_rules('prenomClient', 'Prénom', 'alpha_dash');
    $this->form_validation->set_rules('nomClient', 'Nom', 'alpha_numeric_spaces');
    $this->form_validation->set_rules('mailClient', 'Email', 'valid_email');
    $this->form_validation->set_rules('codePClient', 'Code postale', 'integer');
    $this->form_validation->set_rules('villeClient', 'Ville', 'alpha_dash');
    $this->form_validation->set_rules('telClient', 'Numéro de téléphone', 'integer');
    $this->form_validation->set_rules('pointClient', 'Point de fidelité', 'integer');
    $data['client'] = $this->client->selectById($_POST['idClient']);
    $data['administrateur'] = $this->administrateur->selectByMail($_COOKIE['administrateurCookie']);
    $mdp = $data['administrateur'][0]->mdpAdministrateur;
    $id = $data['client'][0]->idClient;
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('administrateur/index');
      $data['client'] = $this->client->selectAll();
      $this->load->view('administrateur/liste_client',$data);
    }
    else {
      if ($_POST['mdpClient'] == $_POST['mdpClient2']) {
        $data = array(
          "prenomClient" => htmlspecialchars($_POST['prenomClient']),
          "nomClient" => htmlspecialchars($_POST['nomClient']),
          "mailClient" => htmlspecialchars($_POST['mailClient']),
          "mdpClient" => htmlspecialchars(crypt($_POST['mdpClient'],'md5')),
          "adresseClient" => htmlspecialchars($_POST['adresseClient']),
          "codePClient" => htmlspecialchars($_POST['codePClient']),
          "villeClient" => htmlspecialchars($_POST['villeClient']),
          "telClient" => htmlspecialchars($_POST['telClient']),
          "pointClient" => htmlspecialchars($_POST['pointClient']),
        );

        $this->client->update($id, $data);
        $this->load->view('administrateur/index');
        $data['client'] = $this->client->selectAll();
        $this->load->view('administrateur/liste_client',$data);
      } else {
        $data['message'] = "erreur : la confirmation de Mot de passe ne correspond pas au premier";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/liste_client');
      }
    }

  }
  
 

  public function modifier_commercant() {
    $this->load->helper('form', 'url');
    $this->load->library('form_validation');
    $this->load->model('commercant');
    $this->form_validation->set_rules('prenomCommercant', 'Prénom', 'alpha_dash');
    $this->form_validation->set_rules('nomCommercant', 'Nom', 'alpha_numeric_spaces');
    $this->form_validation->set_rules('mailCommercant', 'Email', 'valid_email');
    $this->form_validation->set_rules('codePCommercant', 'Code postale', 'integer');
    $this->form_validation->set_rules('villeCommercant', 'Ville', 'alpha_dash');
    $this->form_validation->set_rules('telCommercant', 'Numéro de téléphone', 'integer');
    $data['commercant'] = $this->commercant->selectById($_POST['idCommercant']);
    $data['administrateur'] = $this->administrateur->selectByMail($_COOKIE['administrateurCookie']);
    $mdp = $data['administrateur'][0]->mdpAdministrateur;
    $id = $data['commercant'][0]->idCommercant;
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('administrateur/index');
      $data['commercant'] = $this->commercant->selectAll();
      $this->load->view('administrateur/liste_commercant',$data);
    }
    else {
      if ($_POST['mdpCommercant'] == $_POST['mdpCommercant2']) {
        $data = array(
          "prenomCommercant" => htmlspecialchars($_POST['prenomCommercant']),
          "nomCommercant" => htmlspecialchars($_POST['nomCommercant']),
          "mailCommercant" => htmlspecialchars($_POST['mailCommercant']),
          "mdpCommercant" => htmlspecialchars(crypt($_POST['mdpCommercant'],'md5')),
          "adresseCommercant" => htmlspecialchars($_POST['adresseCommercant']),
          "codePCommercant" => htmlspecialchars($_POST['codePCommercant']),
          "villeCommercant" => htmlspecialchars($_POST['villeCommercant']),
          "telCommercant" => htmlspecialchars($_POST['telCommercant']),
        );

        $this->commercant->update($id, $data);
        $this->load->view('administrateur/index');
        $data['commercant'] = $this->commercant->selectAll();
        $this->load->view('administrateur/liste_commercant',$data);
      } else {
        $data['message'] = "erreur : la confirmation de Mot de passe ne correspond pas au premier";
        $this->load->view('errors/erreur_formulaire', $data);
        $this->load->view('administrateur/liste_commercant');
      }
    }

  }
}
