<?php
class BonReduc extends CI_Model{

    protected $table ='bonreduc';
    public function __construct() {
        parent::__construct();
    }

    public function selectAll(){
        $this->load->database();
        return $this->db->select('*')
            ->from('bonreduc')
            ->get()
            ->result();
    }

    public function selectById($id) {
        $this->load->database();
        return $this->db->select('*')
            ->from('bonreduc')
            ->where('idBon', $id)
            ->get()
            ->result();

    }
    public function selectByEntreprise($numSiret){
        $this->load->database();
        return $this->db->select('*')
            ->from('bonreduc')
            ->where('numSiret', $numSiret)
            ->get()
            ->result();
    }

    public function search($str){
        $this->load->database();
        return $this->db->select('*')
            ->from('produit')
            ->like('nomProduit',$str)
            ->get()
            ->result();
    }
    public function selectProduit($mail){
        $this->load->database();
        return $this->db->select('*')
            ->from('Produit')
            ->join('entreprise','entreprise.numSiret = produit.numSiret')
            ->join('faire_partie','faire_partie.numSiret = entreprise.numSiret')
            ->join('commercant', 'commercant.idCommercant = faire_partie.idCommercant')
            ->where('commercant.mailCommercant',$mail)
            ->get()
            ->result();
    }

    public function delete($id){
        $this->load->database();
        return $this->db->where('idBon',$id)
            ->delete($this->table);
    }

    public function update($id, $data) {
        $this->load->database();
        var_dump($data);
        $this->db->set('libelleBon', $data['libelleBon'])
            ->set('numSiret', $data['numSiret'])
            ->set('pourcentageBon', $data['pourcentageBon'])
            ->update($this->table);
    }




}
?>