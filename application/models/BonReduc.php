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

    public function selectByLibelle($libelle) {
        $this->load->database();
        return $this->db->select('*')
            ->from('bonreduc')
            ->where('libelleBon', $libelle)
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
    public function selectBonReduc($mail){
        $this->load->database();
        return $this->db->select('*')
            ->from('BonReduc')
            ->join('entreprise','entreprise.numSiret = bonreduc.numSiret')
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
        $this->db->set('libelleBon', $data['libelleBon'])
            ->set('numSiret', $data['numSiret'])
            ->set('pourcentageBon', $data['pourcentageBon'])
			->set('descriptionBon', $data['descriptionBon'])
            ->update($this->table);
    }


    public function insert($data) {
        $this->load->database();
        $this->db->set('libelleBon', $data['libelleBon'])
            ->set('pourcentageBon', $data['pourcentageBon'])
            ->set('numSiret', $data['numSiret'])
			->set('descriptionBon', $data['descriptionBon'])
            ->insert($this->table);
    }


}
?>
