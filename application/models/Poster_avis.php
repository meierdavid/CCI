<?php
class poster_avis extends CI_Model{

  protected $table ='poster_avis';

  public function __construct(){
    parent::__construct();
  }

  public function selectAll(){
    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->get()
    ->result();
  }

  public function selectByIdClient($id){
    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->where('idClient', $id)
    ->get()
    ->result();
  }

  public function selectByIdProduit($id){

    $this->load->database();

    return $this->db->select('*')
    ->from('poster_avis')
    ->where('idProduit', $id)
    ->get()
    ->result();
  }

  public function insert($data) {

  $this->load->database();

  $this->db->set('idClient', $data['idClient'])
        ->set('idProduit', $data['idProduit'])
		->set('avisClient', $data['avisClient'])
		->insert($this->table);
  }
  
  
  public function delete($idClient,$idProduit) {
	$this->load->database();
	$this->db->delete('poster_avis', array('idClient' => $idClient , 'idProduit' => $idProduit));
  }

  
  
}

?>
