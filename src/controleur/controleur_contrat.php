<?php

function actionContrat($twig, $db){

   $form = array();
   $contrat = new Contrat($db);
   if(isset($_POST['btSupprimer'])){

     $cocher = $_POST['cocher'];
     $form['valide'] = true;
     foreach ( $cocher as $idContrat){

       $exec=$contrat->delete($idContrat);
       if (!$exec){

         $form['valide'] = false;
         $form['message'] = 'Problème de suppression dans la table Contrat';
       }
     }
   }
   if(isset($_GET['idContrat'])){

     $exec=$contrat->delete($_GET['idContrat']);
     if (!$exec){

       $form['valide'] = false;
       $form['message'] = 'Problème de suppression dans la table Contrat';
     }
     else{

       $form['valide'] = true;
       $form['message'] = 'Contrat supprimé avec succès';
     }
      
   
   
  
   }
   $liste = $contrat->select();
  echo $twig->render('contrat.html.twig', array('form'=>$form,'liste'=>$liste));
   
}

function actionContratAjout($twig, $db) {
    $form = array();
    $contrat = new contrat($db);
    if (isset($_POST['btAjouter'])) {

        $totalContrat = $_POST['totalContrat'];
        $facture = $_POST['facture'];
        $dateSignature = $_POST['dateSignature'];
       

        $form['valide'] = true;

        $contrat->insert($totalContrat, $facture, $dateSignature);
    }
    echo $twig->render('contrat-ajout.html.twig', array('form' => $form));
}

function actionContratModif($twig, $db){
    $form = array();  
    $contrat = new Contrat($db);
    
    if(isset($_GET['id'])){
       
        $unContrat = $contrat->selectById($_GET['id']);  
        
        if ($unContrat!=null){
            $form['contrat'] = $unContrat;
           
            $contrat = new Contrat($db);
            $liste = $contrat->select();
            $form['liste'] = $liste;
            
        }
        else{
            $form['message'] = 'Contrat incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $contrat = new Contrat($db);
          $idContrat = $_POST['id'];  
          $totalContrat = $_POST['totalContrat'];  
          $facture = $_POST['facture'];
          $dateSignature = $_POST['dateSignature'];
          $contrat = new Contrat($db);
          $exec = $contrat->update($idContrat, $totalContrat, $facture, $dateSignature);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification du contrat'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Contrat non précisé';
        }    
     
    }
    
    echo $twig->render('contrat-modif.html.twig', array('form'=>$form));
}

     ?>