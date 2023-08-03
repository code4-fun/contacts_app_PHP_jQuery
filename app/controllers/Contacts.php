<?php

class Contacts extends Controller{
  public function __construct(){
    $this->contactModel = $this->model('Contact');
  }

  public function index(){
    $contacts = $this->contactModel->getContacts();
    $data = [
      'contacts' => $contacts
    ];
    $this->view('index', $data);
  }

  public function add(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name' => trim($_POST['name']),
        'phone' => trim($_POST['phone'])
      ];

      if($id = $this->contactModel->addContact($data)){
        $data['id'] = $id;
        echo json_encode($data);
      }
    }
  }

  public function delete($id){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $this->contactModel->getContactById($id);
      if($this->contactModel->deleteContact($id)){
        redirect('contacts');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('contacts');
    }
  }
}
