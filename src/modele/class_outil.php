<?php

class outils{
    
    private $db;
    private $select;
    private $insert;
    private $update;
    private $selectById;
    
    public function __construct($db){
        $this->db = $db;  
        $this->select = $db->prepare("select idOutils, libelleO, versionO from outils");
         $this->insert = $db->prepare("insert into outils(libelleO, versionO) values (:libelleO, :versionO)");    
        $this->update = $db->prepare("update outils set libelleO=:libelleO , versionO=:versionO where id=:idOutils");
        $this->selectById = $db->prepare("select idOutils, libelleO, versionO from outils where idOutils=:idOutils");
    }
      
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
    public function selectById($id){
        $this->selectById->execute(array(':idOutils'=>$idOutils));
        if ($this->selectById->errorCode()!=0){
             print_r($this->selectById->errorInfo());  
        }
        return $this->selectById->fetch();
    }
    
    public function insert($libelleO, $versionO){
        $r = true;
        $this->insert->execute(array(':libelleO'=>$libelleO,':versionO'=>$versionO));
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function update($idOutils,$libelleO,$versionO){
        $r = true;
        $this->update->execute(array(':idOutils'=>$idOutils, ':libelleO'=>$libelleO, ':versionO'=>$versionO));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
}

?>

