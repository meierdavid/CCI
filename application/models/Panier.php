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

        public function insert($data) {
            $this->load->database();
            $this->db->set('datePanier', $data['datePanier'])
                ->set('annulationPanier', $data['annulationPanier'])
                ->set('codePromo', $data['codePromo'])
                ->set('datePanier', $data['datePanier'])
                ->set('finaliserPanier', $data['finaliserPanier'])
                ->set('idClient', $data['idClient'])
                ->set('numSiret', $data['numSiret'])
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
                ->set('numSiret', $data['numSiret'])
                ->set('paiementPanier', $data['paiementPanier'])
                ->set('prixTotPanier', $data['prixTotPanier'])
                ->set('idClient', $data['idClient'])
                ->update($this->table);
        }



    }
?>