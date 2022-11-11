<?php
require_once './app/model/auto.model.php';
require_once './app/view/auto.view.php';



class autoController{

    private $model;
    private $view;
    private $data;
   

   
    public function __construct() {
      $this->model = new autoModel();
      $this->view = new autoView();
      $this->data = file_get_contents("php://input");
      
     
    }
    private function getData() {
      return json_decode($this->data);
  }

public function showAll($params = NULL){

  if (isset($_GET['sortby']) && isset($_GET['order'])){
      if($_GET['order'] == 'ASC'){
          if($_GET['sortby'] == 'modelo')
          $autosbyid = $this->model->orderASC();
          }
      elseif ($_GET['order'] == 'DESC'){
          if($_GET['sortby'] == 'modelo')
          $autosbyid = $this->model->orderDESC();
      }
      
  }
  else{
  $autosbyid = $this->model->getAll();
  }
  return $this->view->response($autosbyid, 200);
  
} 



public function showAutos($params = NULL) {
  $id = $params[':ID'];
  $autos  = $this->model->getAutobyid($id);
  if($autos)
  $this->view->response($autos);
  else 
  $this->view->response("El auto buscado con el id=$id no existe", 404);
}

public function addAutos($params = NULL){ 
  $autosbyid = $this->getData();  
  
  if( empty($autosbyid->id_comprador)||empty($autosbyid->autos) || empty($autosbyid->modelo)|| empty($autosbyid->color)|| empty($autosbyid->km)){
      $this->view->response("Complete los datos", 400);
  }
  else {
      $id = $this->model->insertAuto($autosbyid-> id_comprador,$autosbyid->autos, $autosbyid->modelo, $autosbyid->color,$autosbyid->km);
      $autosbyid = $this->model->getAutobyid($id);
      $this->view->response($autosbyid, 201);
  }
}
public function delete($params = NULL) {
  $id = $params[':ID'];

  $autos  = $this->model->getAutobyid($id);
if($autos){
  $this->model->deleteAutoById($id);
  $this->view->response($autos);
}
else
$this->view->response("el auto con el id=$id no existe", 404);
  }


  public function updateAutos($params = null){
    $id = $params[':ID'];
    $autos= $this->model->getAutobyid($id);
    if ($autos){
        $autos = $this->getData();
        $this->model->update($autos->id_comprador,$autos->autos,$autos->modelo,$autos->color,$autos->km,$id);
        $this->view->response("El auto con el id=$id se actualizo correctamente",200);
        }else {
        $this->view->response("El auto no existe",404);
    }
}




}
