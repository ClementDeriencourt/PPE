<?php

function actionEquipe($twig, $db){
    $form = array(); 
    $equipe = new Equipe($db);
    
    if(isset($_GET['idEquipe'])){
        $exec=$equipe->delete($_GET['idEquipe']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table équipe';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Equipe supprimée avec succès';
     }
    
    $liste = $equipe->select();

    echo $twig->render('equipe.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionEquipeAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputLibelle = $_POST['inputLibelle'];
      $inputIdResponsable = $_POST['inputIdResponsable']; 
      $form['valide'] = true;
      $equipe = new Equipe($db); 
      
      $exec = $equipe->insert($inputLibelle, $inputIdResponsable);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table équipe ';  
      }
    }
    else{
        $developpeur = new developpeur($db);
        $liste = $developpeur->select();
        $form['liste'] = $liste;
    }
 
    echo $twig->render('equipe-ajout.html.twig', array('form'=>$form)); 
}

function actionEquipeModif($twig, $db){
    $form = array();  
    $equipe = new Equipe($db);
    
    if(isset($_GET['id'])){
       
        $uneEquipe = $equipe->selectById($_GET['id']);  
        
        if ($uneEquipe!=null){
            $form['equipe'] = $uneEquipe;
           
            $equipe = new Equipe($db);
            $liste = $equipe->select();
            $form['liste'] = $liste;
            
        }
        else{
            $form['message'] = 'Equipe incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $equipe = new Equipe($db);
          $idEquipe = $_POST['id'];  
          $libelleEquipe = $_POST['libelleEquipe'];  
          $idResponsable = $_POST['inputIdResponsable'];
          $equipe = new Equipe($db);
          $exec = $equipe->update($idEquipe, $libelleEquipe, $idResponsable);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification de l\'équipe'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Responsable non précisé';
        }    
     
    }
    
    echo $twig->render('equipe-modif.html.twig', array('form'=>$form));
}


// WebService
function actionEquipeWS($twig, $db){
   $equipe = new Equipe($db);
   $json = json_encode($liste = $equipe->select()); 
   echo $json; 
}

