<?php

class autoModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8','root','');
    }
    
    function getAll(){

    
        $query = $this->db->prepare("SELECT * FROM autos");
        $query->execute();
    
        $autosbyid = $query->fetchAll(PDO::FETCH_OBJ);

       return $autosbyid;
       
    
    }
    public function orderASC(){
        $query = $this->db->prepare("SELECT * FROM autos ORDER BY modelo ASC");
        $query->execute();
        $autosbyid = $query->fetchAll(PDO::FETCH_OBJ);
        return $autosbyid;
    }


    public function orderDESC(){
        $query = $this->db->prepare("SELECT * FROM autos ORDER BY modelo DESC");
        $query->execute();
        $autosbyid = $query->fetchAll(PDO::FETCH_OBJ);
        return $autosbyid;
    }


    public function pagination(){
        $query = $this->db->prepare("SELECT * FROM autos LIMIT 5");
        $query->execute();
        $autosbyid = $query->fetchAll(PDO::FETCH_OBJ);
        return $autosbyid;
    
    }

    
    
    public function insertAuto( $id_comprador ,$autos, $modelo, $color, $km) {
        $query = $this->db->prepare("INSERT INTO autos ( id_comprador,autos, modelo, color, km) VALUES (?,?, ?, ?, ?)");
        $query->execute([ $id_comprador,$autos, $modelo, $color, $km]);

        return $this->db->lastInsertId();
    }

    function deleteAutoById($id) {
        $query = $this->db->prepare('DELETE FROM autos WHERE id = ?');
        $query->execute([$id]);
    }

   

    function getAutobyid($id){
        
        $query = $this->db->prepare("SELECT * FROM autos WHERE id=?");
        $query->execute([$id]);
    
        $autosbyid = $query->fetchAll(PDO::FETCH_OBJ);

       return $autosbyid;
    }

   

     public function EditAuto($id,$autos,$modelo,$color,$km){
          $query = $this->db->prepare("UPDATE autos SET autos=?, modelo=?,color=?,km=? WHERE id_stock = ? ");
          $query->execute(array($id,$autos,$modelo,$color,$km));
        }

    


}

