<?php
class faire_partie extends CI_Model{

  protected $table ='faire_partie';

  public function __construct(){
    parent::__construct();
  }

  public function selectAll(){
    $this->load->database();

    return $this->db->select('*')
    ->from('faire_partie')
    ->get()
    ->result();
  }

  public function selectByIdCommercant($id){

    $this->load->database();

    $this->db->select('*')
    ->from('faire_partie')
    ->where('idCommercant', $id)
    ->get()
    ->result();
  }

  public function selectByNumSiret($siret){

    $this->load->database();

    $this->db->select('*')
    ->from('faire_partie')
    ->where('numSiret', $siret)
    ->get()
    ->result();
  }

}

?>
