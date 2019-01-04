<?php
    class panier extends CI_Model{

        protected $table ='panier';
        public function __construct() {
            parent::__construct();
        }

        public function selectAll(){
            $this->load->database();
            return $this->db->select('*')
                ->from('panier')
                ->get()
                ->result();
        }

        public function selectById($id) {
            $this->load->database();
            return $this->db->select('*')
                ->from('panier')
                ->where('idPanier', $id)
                ->get()
                ->result();
        }

        public function selectByIdClient($id) {
            $max = $this->db->select_max('idPanier')
                ->from('panier')
                ->where('idClient', $id)
                ->get()
                ->result();
            $this->load->database();
            return $this->db->select('*')
                ->from('panier')
                ->where('idPanier', $max[0]->idPanier)
                ->get()
                ->result();
        }

        public function selectProduits($id){
            $this->load->database();
            return $this->db->select('*')
                ->from('Produit')
                ->join('commander','commander.idProduit = produit.idProduit')
                ->where('idPanier', $id)
                ->get()
                ->result();
        }

        public function finaliser($id) {
            $this->load->database();
            $this->db->set('finaliserPanier', 1); // 0 ou null si non finaliser, 1 si finaliser
        }

        public function insert($data) {
            $this->load->database();
            $this->db->set('datePanier', $data['datePanier'])
                ->set('annulationPanier', $data['annulationPanier'])
                ->set('codePromo', $data['codePromo'])
                ->set('paiementPanier', $data['paiementPanier'])
                ->set('finaliserPanier', $data['finaliserPanier'])
                ->set('idClient', $data['idClient'])
                ->set('prixTotPanier', $data['prixTotPanier'])
                ->insert($this->table);
        }

        public function delete($id){
            $this->load->database();
            return $this->db->where('idPanier',$id)
                ->delete($this->table);
        }

        public function update($id, $data) {
            $this->load->database();
            $this->db->set('annulationPanier', $data['annulationPanier'])
                ->set('codePromo', $data['codePromo'])
                ->set('datePanier', $data['datePanier'])
                ->set('finaliserPanier', $data['finaliserPanier'])
                ->set('paiementPanier', $data['paiementPanier'])
                ->set('prixTotPanier', $data['prixTotPanier'])
                ->where('idPanier', $id)
                ->update($this->table);
        }
        
        public function updatepaye($id, $data){
            $this->load->database();
            $this->db       
                ->set('datePanier', $data['datePanier'])
                ->set('paiementPanier', $data['paiementPanier'])               
                ->where('idPanier', $id)
                ->update($this->table);
        }


    }
?>
