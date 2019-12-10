<?php

class Tache{

  private $db;
  private $insert;
  private $update;
  private $select;
  private $selectById;
  private $delete;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO `tache`(`libelleT`, `nbheureT`, `coutT`) VALUES (:libelleT,:nbheureT,:coutT)");
        $this->select = $db->prepare("SELECT `idTache`, `libelleT`, `nbheureT`, `coutT` FROM `tache`");
        $this->selectById = $db->prepare("SELECT `libelleT`, `nbheureT`, `coutT` FROM `tache` WHERE `idTache`=:idTache");
        $this->update = $db->prepare("UPDATE `tache` SET `libelleT`=:libelleT,`nbheureT`=:nbheureT,`coutT`=:coutT WHERE `idTache`=:idTache");
        $this->delete = $db->prepare("DELETE FROM `tache` WHERE idTache=:idTache");
        }
        
    public function insert($libelleT,$nbheureT,$coutT){
        $r = true;
        $this->insert->execute(array(':libelleT'=>$libelleT, ':nbheureT'=>$nbheureT, ':coutT'=>$coutT));
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

    public function selectById($idTache){

      $this->selectById->execute(array(':idTache'=>$idTache));
      if ($this->selectById->errorCode()!=0){

        print_r($this->selectById->errorInfo());
      }
      return $this->selectById->fetch();
    }

    public function update($idTache,$libelleT,$nbheureT,$coutT){
        $r = true;
        $this->update->execute(array(':idTache'=>$idTache, ':libelleT'=>$libelleT, ':nbheureT'=>$nbheureT, ':coutT'=>$coutT));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());
             $r=false;
        }
        return $r;
    }

    public function delete($idTache){
        $r = true;
        $this->delete->execute(array(':idTache'=>$idTache));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());
             $r=false;
        }
        return $r;
    }

}

?>
