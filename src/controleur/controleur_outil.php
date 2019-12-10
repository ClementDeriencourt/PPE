<?php

function actionOutil($twig, $db){
     $form = array();
    $outils = new outils($db);
    if (isset($_GET['idOutils'])) {
        $exec = $outils->delete($_GET['idOutils']);
        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Erreur de suppression.';
        } else {
            $form['valide'] = true;
            $form['message'] = 'Outils  supprimé avec succès';
        }
    }
    $liste = $outils->select();
        echo $twig->render('outils.html.twig', array('form'=>$form, 'liste' =>$liste));
}

function actionOutilAjout($twig, $db){
    $form = array();
    $outils = new outils($db);
    if (isset($_POST['btOAjouter'])) {

        $libelleO = $_POST['libelleO'];
        $versionO = $_POST['versionO'];
        
        $form['valide'] = true;

        $outils->insert($libelleO, $versionO);
    }
    echo $twig->render('outil-ajout.html.twig', array('form'=>$form));

}

function actionOutilModif($twig, $db){
    $form = array();  
    $outils = new Outils($db);
    
    if(isset($_GET['id'])){
       
        $unOutils = $outils->selectById($_GET['idOutils']);  
        
        if ($unOutils!=null){
            $form['outils'] = $unOutils;
           
            $outils = new Outils($db);
            $liste = $outils->select();
            $form['liste'] = $liste;
            
        }
        else{
            $form['message'] = 'Outils incorrect';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $outils = new Outils($db);
          $idOutils = $_POST['id'];  
          $libelleO = $_POST['libelleO'];  
          $versionO = $_POST['versionO'];
          $outils = new Outils($db);
          $exec = $equipe->update($idOutils, $libelleO, $versionO);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification de l\'outils'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Outils non précisé';
        }    
     
    }
    
    echo $twig->render('outils-modif.html.twig', array('form'=>$form));
}
?>