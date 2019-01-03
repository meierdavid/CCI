<?php
    class commander extends CI_Model{

        protected $table ='commander';
        public function __construct() {
            parent::__construct();
        }

        public function selectAll(){
            $this->load->database();
            return $this->db->select('*')
                ->from('commander')
                ->get()
                ->result();
        }

        public function selectByIdPanier($id) {
            $this->load->database();
            return $this->db->select('*')
                ->from('commander')
                ->where('idPanier', $id)
                ->get()
                ->result();
        }

        public function insert($data) {
            $this->load->database();
            $this->db->set('idProduit', $data['idProduit'])
                ->set('idPanier', $data['idPanier'])
                ->set('quantiteProd', $data['quantiteProd'])
                ->set('livraisonCommande', $data['livraisonCommande'])
                ->insert($this->table);
        }

        public function delete($idProduit, $idPanier){
            $this->load->database();
            return $this->db->where('idProduit',$idProduit)
                ->where('idPanier',$idPanier)
                ->delete($this->table);
        }

        public function update($id, $data) {
            $this->load->database();
            $this->db->set('quantiteProd', $data['quantiteProd'])
                ->set('livraisonCommande', $data['livraisonCommande'])
                ->where('idPanier', $id)
                ->update($this->table);
        }



    }
?>
