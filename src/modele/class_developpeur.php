<?php

class developpeur{
   
 private $db;
    private $insert;
    private $select;
    private $update;

    public function __construct($db) {
        $this->db = $db;
        $this->select = $db->prepare("select idDev, nomDev, prenomDev, adresseDev, telDev, grade from developpeur");
        $this->insert = $db->prepare("insert into developpeur (nomDev, prenomDev, adresseDev, telDev, grade) values (:nomDev, :prenomDev, :adresseDev, :telDev, :grade)");
        $this->update = $db->prepare("update developpeur set nomDev=:nomDev, prenomDev=:prenomDev, adresseDev=:adresseDev, telDev=:telDev, grade=:grade where idDev=:idDev");
    }

      public function insert($nomDev, $prenomDev, $adresseDev, $telDev, $grade) {
        $r = true;
        $this->insert->execute(array(':nomDev'=>$nomDev, ':prenomDev'=>$prenomDev, ':adresseDev'=>$adresseDev, ':telDev'=>$telDev, ':grade'=>$grade));
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }
       

    public function select() {
        $liste = $this->select->execute();
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();
    }

    public function update($nomDev, $prenomDev, $adresseDev, $telDev, $grade) {
        $r = true;
        $this->update->execute(array(':nomDev'=>$nomDev, ':prenomDev'=>$prenomDev, ':adresseDev'=>$adresseDev, ':telDev'=>$telDev, ':grade'=>$grade));
        if ($this->update->errorCode() != 0) {
            print_r($this->update->errorInfo());
            $r = false;
        }
        return $r;
    }

}

?>
