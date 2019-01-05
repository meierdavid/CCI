<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PanierCtrl extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->view('client/accueil');
    }

    public function finaliser($idPanier) {
        $this->load->model('panier');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        if (isset($_COOKIE['clientCookie'])) {
            $data['client'] = $this->client->selectByMail($this->input->cookie('clientCookie'));
            //acheter !
            $this->load->view('client/header', $data);
            $this->load->view('client/adresse', $data);
            $this->load->view('client/footer');
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function liste_panier() {
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('panier');
        $this->load->model('commander');
        $this->load->model('produit');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        if (isset($_COOKIE['clientCookie'])) {
            $varid = $this->input->cookie('clientCookie');

            $data['client'] = $this->client->selectByMail($varid);
            $data['panier'] = $this->panier->selectByIdClient($data['client'][0]->idClient);

            if ($data['panier'] != NULL) {
                $data['commander'] = $this->commander->selectByIdPanier($data['panier'][0]->idPanier);
                $data['produits'] = $this->panier->selectProduits($data['panier'][0]->idPanier);

                $this->load->view('client/header', $data);
                $this->load->view('panier/liste_panier', $data);
                $this->load->view('client/footer');
            } else {
                $data['message'] = "erreur : Vous n'avez pas de produits dans votre panier";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/header', $data);
                $this->load->view('client/accueil');
                $this->load->view('client/footer');
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function ajout_panier($idProduit) {
        $this->load->model('panier');
        $this->load->model('produit');
        $this->load->model('commander');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        $this->form_validation->set_rules('quantite', 'quantité souhaitée', 'is_natural');

        if (isset($_COOKIE['clientCookie'])) {
            $varmail = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varmail);
            $idClient = $data['client'][0]->idClient;

            $data['produit'] = $this->produit->selectById($idProduit);
            $data['entreprise'] = $this->entreprise->selectById($data['produit'][0]->numSiret);

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('client/header', $data);
                $this->load->view('panier/ajout_panier', $data);
                $this->load->view('client/footer');
            } else {
                if ($this->panier->checkId($idProduit, $idClient) == Null) {
                    if ($data['produit'][0]->nbDispoProduit >= $_POST['quantite']) {
                        $prix = $this->produit->prix_a_afficher($idProduit) * $_POST['quantite'];
                        $date = date("d-m-y H:i:s");

                        $data['panier'] = $this->panier->selectByIdClient($idClient);

                        if ($data['panier'] == null) { //panier inexistant : on le créé
                            $data = array(
                                "datePanier" => htmlspecialchars($date),
                                "annulationPanier" => htmlspecialchars(0),
                                "codePromo" => htmlspecialchars(0),
                                "paiementPanier" => htmlspecialchars(0),
                                "finaliserPanier" => htmlspecialchars(0),
                                "idClient" => htmlspecialchars($idClient),
                                "prixTotPanier" => htmlspecialchars($prix),
                            );
                            $this->panier->insert($data);
                        } else { //panier déjà existant : MAJ
                            $prix = $this->produit->prix_a_afficher($idProduit) * $_POST['quantite'];
                            $prix = $prix + $data['panier'][0]->prixTotPanier;
                            $idPanier = $data['panier'][0]->idPanier;

                            $data = array(
                                "annulationPanier" => htmlspecialchars(0),
                                "codePromo" => htmlspecialchars(0),
                                "datePanier" => htmlspecialchars($date),
                                "finaliserPanier" => htmlspecialchars(0),
                                "paiementPanier" => htmlspecialchars(0),
                                "prixTotPanier" => htmlspecialchars($prix),
                            );
                            $this->panier->update($idPanier, $data);
                        }
                        //Insertion dans table Commander
                        $data['panier'] = $this->panier->selectByIdClient($idClient);
                        $idPanier = $data['panier'][0]->idPanier;

                        if ($_POST['livraison'] == 'Oui') {
                            $livraison = 1;
                        } else {
                            $livraison = 0;
                        }

                        $data = array(
                            "idProduit" => htmlspecialchars($idProduit),
                            "idPanier" => htmlspecialchars($idPanier),
                            "quantiteProd" => htmlspecialchars($_POST['quantite']),
                            "livraisonCommande" => htmlspecialchars($livraison),
                        );
                        $this->commander->insert($data);

                        $data['message'] = "Le produit a bien été ajouté au panier";
                        $this->load->view('errors/validation_formulaire', $data);
                        $this->liste_panier();
                    } else {
                        $data['message'] = "Il n'y a pas assez d'articles disponibles";
                        $this->load->view('errors/erreur_formulaire', $data);
                        $this->liste_panier();
                    }
                } else {
                    $data['message'] = "Ce produit est déjà dans votre panier";
                    $this->load->view('errors/erreur_formulaire', $data);
                    $this->liste_panier();
                }
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function supprimer_produit_panier($idProduit) {
        $this->load->model('panier');
        $this->load->model('commander');
        $this->load->model('produit');
        $this->load->helper('form', 'url');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        if (isset($_COOKIE['clientCookie'])) {
            $varmail = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varmail);
            $idClient = $data['client'][0]->idClient;
            $data['panier'] = $this->panier->selectByIdClient($idClient);
            if ($data['panier'] != null) {
                $idPanier = $data['panier'][0]->idPanier;
                $data['commander'] = $this->commander->selectByIdPanier($idPanier);
                $data['produit'] = $this->produit->selectById($data['commander'][0]->idProduit);


                $date = date("d-m-y H:i:s");
                $prixPanier = $data['panier'][0]->prixTotPanier;
                $prixProduit = $this->produit->prix_a_afficher($idProduit) * $data['commander'][0]->quantiteProd;
                $prix = $prixPanier - $prixProduit;

                $data = array(
                    "annulationPanier" => htmlspecialchars(0),
                    "codePromo" => htmlspecialchars(0),
                    "datePanier" => htmlspecialchars($date),
                    "finaliserPanier" => htmlspecialchars(0),
                    "paiementPanier" => htmlspecialchars(0),
                    "prixTotPanier" => htmlspecialchars($prix),
                );

                $this->panier->update($idPanier, $data);
                $this->commander->delete($idProduit, $idPanier);

                if ($this->commander->selectByIdPanier($idPanier) == null) { //il n'y a plus d'article dans le panier
                    $this->supprimer_panier($idPanier);
                } else {
                    $data['message'] = "Ce produit a été supprimer de votre panier avec succès";
                    $this->load->view('errors/validation_formulaire', $data);
                    $this->liste_panier();
                }
            } else {
                $data['message'] = "erreur : Votre panier n'existe pas";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/header', $data);
                $this->load->view('client/accueil');
                $this->load->view('client/footer');
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function supprimer_panier($id) {
        $this->load->model('panier');
        $this->load->model('commander');
        $this->load->helper('form', 'url');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        $cookie = $this->input->cookie('clientCookie');
        $data['client'] = $this->client->SelectByMail($cookie);
        if (isset($_COOKIE['clientCookie'])) {
            //suppression dans Commander
            $this->commander->deletePanier($id);
            $date = date("d-m-y H:i:s");
            //suppression dans Panier
            $data = array(
                "annulationPanier" => htmlspecialchars(0),
                "codePromo" => htmlspecialchars(0),
                "datePanier" => htmlspecialchars($date),
                "finaliserPanier" => htmlspecialchars(0),
                "paiementPanier" => htmlspecialchars(0),
                "prixTotPanier" => htmlspecialchars(0),
            );
            $this->panier->update($id, $data);
            $varmail = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varmail);
            $data['message'] = "Votre panier a été vidé avec succès";
            $this->load->view('errors/validation_formulaire', $data);
            $this->load->view('client/header', $data);
            $this->load->view('client/accueil');
            $this->load->view('client/footer');
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function modifier($idProduit) {
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        $this->load->model('commander');
        $this->load->model('produit');
        $this->load->model('panier');

        $this->form_validation->set_rules('quantite', 'quantité souhaitée', 'is_natural');

        if (isset($_COOKIE['clientCookie'])) {
            $varmail = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varmail);
            $idClient = $data['client'][0]->idClient;

            $data['panier'] = $this->panier->selectByIdClient($idClient);
            $idPanier = $data['panier'][0]->idPanier;
            $data['produit'] = $this->produit->selectById($idProduit);
            $data['commander'] = $this->commander->selectByIds($idPanier, $idProduit);
            $quantiteInitiale = $data['commander'][0]->quantiteProd;
            $data['entreprise'] = $this->entreprise->selectById($data['produit'][0]->numSiret);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('client/header', $data);
                $this->load->view('panier/detail_panier', $data);
                $this->load->view('client/footer');
            } else {
                if ($data['produit'][0]->nbDispoProduit >= $_POST['quantite']) {
                    $prixInitial = $this->produit->prix_a_afficher($idProduit) * $quantiteInitiale;
                    $prixNouveau = $this->produit->prix_a_afficher($idProduit) * $_POST['quantite'];
                    $prix = $data['panier'][0]->prixTotPanier - $prixInitial + $prixNouveau;
                    $date = date("d-m-y H:i:s");

                    $idPanier = $data['panier'][0]->idPanier;

                    $data = array(
                        "annulationPanier" => htmlspecialchars(0),
                        "codePromo" => htmlspecialchars(0),
                        "datePanier" => htmlspecialchars($date),
                        "finaliserPanier" => htmlspecialchars(0),
                        "paiementPanier" => htmlspecialchars(0),
                        "prixTotPanier" => htmlspecialchars($prix),
                    );
                    $this->panier->update($idPanier, $data);

                    $data['panier'] = $this->panier->selectByIdClient($idClient);
                    $idPanier = $data['panier'][0]->idPanier;

                    if ($_POST['livraison'] == 'Oui') {
                        $livraison = 1;
                    } else {
                        $livraison = 0;
                    }

                    $data = array(
                        "quantiteProd" => htmlspecialchars($_POST['quantite']),
                        "livraisonCommande" => htmlspecialchars($livraison),
                    );
                    $this->commander->update($idPanier, $idProduit, $data);

                    $data['message'] = "Le produit a bien été modifié";
                    $this->load->view('errors/validation_formulaire', $data);
                    $this->liste_panier();
                } else {
                    $data['message'] = "Il n'y a pas assez d'articles disponibles";
                    $this->load->view('errors/erreur_formulaire', $data);
                    $this->liste_panier();
                }
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function confirmation() {
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('panier');
        $this->load->model('commander');
        $this->load->model('produit');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();
        if (isset($_COOKIE['clientCookie'])) {
            $varid = $this->input->cookie('clientCookie');

            $data['client'] = $this->client->selectByMail($varid);
            $data['panier'] = $this->panier->selectByIdClient($data['client'][0]->idClient);

            if ($data['panier'] != NULL) {
                $data['commander'] = $this->commander->selectByIdPanier($data['panier'][0]->idPanier);
                $data['produits'] = $this->panier->selectProduits($data['panier'][0]->idPanier);

                $this->load->view('client/header', $data);
                $this->load->view('panier/confirmation_panier', $data);
                $this->load->view('client/footer');
            } else {
                $data['message'] = "erreur : Vous n'avez pas de produits dans votre panier";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/header', $data);
                $this->load->view('client/accueil');
                $this->load->view('client/footer');
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function payement() {
        $this->load->model('panier');
        $this->load->model('produit');
        $this->load->model('commander');
        $this->load->model('client');
        $this->load->helper('form', 'url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('entreprise');
        $data['entreprises_header'] = $this->entreprise->selectAll();


        if (isset($_COOKIE['clientCookie'])) {
            $varmail = $this->input->cookie('clientCookie');
            $data['client'] = $this->client->selectByMail($varmail);
            $idClient = $data['client'][0]->idClient;
            $data['panier'] = $this->panier->selectByIdClient($idClient);
            if ($data['panier'][0]->prixTotPanier < $data['client'][0]->creditClient) {
                $nouveauSoldeClient = $data['client'][0]->creditClient - $data['panier'][0]->prixTotPanier;
                $this->client->updateCredit($idClient, $nouveauSoldeClient);
                //modifie le panier en cours
                //générer chaine de caractère aléatoire et enregistrer dans le panier
                $chaine = $this->genererChaineAleatoire();
                
                $date = date("d-m-y H:i:s");
                $idPanier = $data['panier'][0]->idPanier;
                $data = array(
                    "datePanier" => htmlspecialchars($date),
                    "paiementPanier" => htmlspecialchars(1),
                    "chainePanier" => htmlspecialchars($chaine)
                );
                $this->panier->updatePaye($idPanier, $data);
                
                // retirer la quantite dispo du produit 

                $data['panier'] = $this->panier->selectByIdClient($idClient);
                $data['commander'] = $this->commander->selectByIdPanier($data['panier'][0]->idPanier);
                $data['produits'] = $this->panier->selectProduits($data['panier'][0]->idPanier);
                $i = 0;
                foreach ($data['commander'] as $item) {
                    $nouvelleQuantite = $data['produits'][$i]->nbDispoProduit - $item->quantiteProd;
                    $this->produit->updateQuantite($item->idProduit, $nouvelleQuantite);
                    $i = $i + 1;
                }
                //ajouter les points de fidélité
                $data['client'] = $this->client->selectByMail($varmail);
                $nouveauPoint = $data['client'][0]->pointClient + ($data['panier'][0]->prixTotPanier / 10);
                $this->client->updatePoint($idClient, $nouveauPoint);
                
                //créer un nouveau panier
                $data = array(
                    "datePanier" => htmlspecialchars($date),
                    "annulationPanier" => htmlspecialchars(0),
                    "codePromo" => htmlspecialchars(0),
                    "paiementPanier" => htmlspecialchars(0),
                    "finaliserPanier" => htmlspecialchars(0),
                    "idClient" => htmlspecialchars($idClient),
                    "prixTotPanier" => htmlspecialchars(0),
                );
                $this->panier->insert($data);
                $data['entreprises_header'] = $this->entreprise->selectAll();
                $data['client'] = $this->client->selectByMail($varmail);
                $data['message'] = "Votre paiement à bien été accepté";
                $this->load->view('errors/validation_formulaire', $data);
                $this->load->view('client/header', $data);
                $this->load->view('client/accueil');
                $this->load->view('client/footer');
            } else {
                $data['message'] = "erreur : Veuillez réapprovisionner votre compte";
                $this->load->view('errors/erreur_formulaire', $data);
                $this->load->view('client/header', $data);
                $this->load->view('client/profil', $data);
                $this->load->view('client/footer');
            }
        } else {
            $data['message'] = "erreur : Votre session a expiré, veuillez vous reconnecter";
            $this->load->view('errors/erreur_formulaire', $data);
            $this->load->view('client/connexion');
        }
    }

    public function genererChaineAleatoire() {
        $longueur = 10;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++) {
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        return $chaineAleatoire;
    }

}
