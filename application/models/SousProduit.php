<?php
class souspproduit extends CI_Model{
    protected $table ='sousproduit';
    public function __construct() {
        parent::__construct();
    }

    public function selectAll(){
        $this->load->database();
        return $this->db->select('*')
            ->from('sousproduit')
            ->get()
            ->result();
    }

    public function selectById($id) {
        $this->load->database();
        return $this->db->select('*')
            ->from('sousproduit')
            ->where('idSousProduit', $id)
            ->get()
            ->result();

    }

    public function insert($data) {
        //on insert les sous produits d'un produit déjà existant
        //donc dans le contrôleur, on cherche via l'id le produit
        $this->load->database();
        $this->db->set('idSousProduit', $data['idSousProduit'])
            ->set('couleurSousProduit', $data['couleurSousProduit'])
            ->set('nbDispoSousproduit', $data['nbDispoSousproduit'])
            ->set('tailleSousProduit', $data['tailleSousProduit'])
            ->insert($this->table);
    }

    public function delete($id){
        $this->load->database();
        return $this->db->where('idSousProduit',$id)
            ->delete($this->table);
    }

    public function update($id, $data) {
        $this->load->database();
        $this->db->set('couleurSousProduit', $data['couleurSousProduit'])
            ->set('nbDispoSousProduit', $data['nbDispoSousProduit'])
            ->set('tailleSousProduit', $data['tailleSousProduit'])
            ->update($this->table);
    }

}
?>