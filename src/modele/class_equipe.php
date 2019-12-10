<?php

class Equipe{
    
    private $db;
    private $insert;
    private $select;
    private $delete;
    private $update;
    private $selectById;
    private $selectByIdResponsable;

    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into equipe(libelleEquipe, idResponsable) values (:libelleEquipe, :idResponsable)");    
        $this->select = $db->prepare("select * from equipe e, developpeur d where e.idResponsable = d.idDev");
        $this->delete = $db->prepare("delete from equipe where idEquipe=:idEquipe");
        $this->update = $db->prepare("update equipe set libelleEquipe=:libelleEquipe, idResponsable=:idResponsable where idEquipe=:id"); 
        $this->selectById = $db->prepare("select idEquipe, libelleEquipe, idResponsable from equipe where idEquipe=:idEquipe order by libelleEquipe");
        $this->selectByIdResponsable = $db->prepare("select id, libelleEquipe, idResponsable from equipe where idResponsable=:idResponsable");
    }
    
    public function insert($libelle, $idResponsable){
        $r = true;
        if($idResponsable=="non"){
          $idResponsable=null;  
        }
      
        $this->insert->bindValue(':idResponsable', $idResponsable,PDO::PARAM_INT);  
        
        $this->insert->bindValue(':libelleEquipe', $libelle,PDO::PARAM_STR); 
        $this->insert->execute();
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
    public function selectByIdResponsable($idResponsable){
        $this->selectByIdResponsable->execute(array(':idResponsable'=>$idResponsable));
        if ($this->selectByIdResponsable->errorCode()!=0){
             print_r($this->selectByIdResponsable->errorInfo());  
        }
        return $this->selectByIdResponsable->fetchAll();
    }
    
    public function update($id, $libelle, $idResponsable){
        $r = true;
        if($idResponsable=="non"){
          $idResponsable=null;  
        }
        $this->update->execute(array(':id'=>$id, ':libelleEquipe'=>$libelle, ':idResponsable'=>$idResponsable));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function selectById($id){ 
        $this->selectById->execute(array(':idEquipe'=>$id)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectById->fetch(); 
    }
    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    
}

?>



