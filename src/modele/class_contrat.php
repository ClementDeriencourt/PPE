<?php

class contrat{

  private $db;
  private $insert;
  private $update;
  private $select;
  private $selectById;
  private $delete;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO `contrat`(`totalContrat`, `facture`, `dateSignature`) VALUES (:totalContrat,:facture,:dateSignature)");
        $this->select = $db->prepare("SELECT `idContrat`, `totalContrat`, `facture`, `dateSignature` FROM `contrat`");
        $this->selectById = $db->prepare("SELECT `totalContrat`, `facture`, `dateSignature` FROM `contrat` WHERE `idContrat`=:idContrat");
        $this->update = $db->prepare("UPDATE `contrat` SET `totalContrat`=:totalContrat,`facture`=:facture,`dateSignature`=:dateSignature WHERE `idContrat`=:idContrat");
        $this->delete = $db->prepare("DELETE FROM `contrat` WHERE idContrat=:idContrat");
        }
        
    public function insert($totalContrat, $facture, $dateSignature){
        $r = true;
        $this->insert->execute(array(':totalContrat'=>$totalContrat, ':facture'=>$facture, ':dateSignature'=>$dateSignature));
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

    public function selectById($idContrat){

      $this->selectById->execute(array(':idContrat'=>$idContrat));
      if ($this->selectById->errorCode()!=0){

        print_r($this->selectById->errorInfo());
      }
      return $this->selectById->fetch();
    }

    public function update($idContrat,$totalContrat,$facture,$dateSignature){
        $r = true;
        $this->update->execute(array(':idContrat'=>$idContrat, ':totalContrat'=>$totalContrat, ':facture'=>$facture, ':dateSignature'=>$dateSignature));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());
             $r=false;
        }
        return $r;
    }

    public function delete($idContrat){
        $r = true;
        $this->delete->execute(array(':idContrat'=>$idContrat));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());
             $r=false;
        }
        return $r;
    }

}

?>
