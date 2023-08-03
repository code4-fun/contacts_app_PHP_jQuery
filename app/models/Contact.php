<?php

class Contact {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

  public function addContact($data){
    $this->db->query('INSERT INTO contacts (name, phone) VALUES(:name, :phone)');
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':phone', $data['phone']);
    if($this->db->execute()){
      return $this->db->idInserted();
    } else {
      return false;
    }
  }

  public function getContactById($id){
    $this->db->query('SELECT * FROM contacts WHERE id = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }

  public function deleteContact($id){
    $this->db->query('DELETE FROM contacts WHERE id = :id');
    $this->db->bind(':id', $id);
    if($this->db->execute()){
      return true;
    } else {
      return false;
    }
  }

  public function getContacts(){
    $this->db->query("SELECT * FROM contacts ORDER BY id DESC");
    return $this->db->resultSet();
  }
}
