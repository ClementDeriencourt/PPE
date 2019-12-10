 <?php
 function actionTache($twig, $db){

   $form = array();
   $tache = new Tache($db);
   if(isset($_POST['btSupprimer'])){

     $cocher = $_POST['cocher'];
     $form['valide'] = true;
     foreach ( $cocher as $idTache){

       $exec=$tache->delete($idTache);
       if (!$exec){

         $form['valide'] = false;
         $form['message'] = 'Problème de suppression dans la table Tache';
       }
     }
   }
   if(isset($_GET['idTache'])){

     $exec=$tache->delete($_GET['idTache']);
     if (!$exec){

       $form['valide'] = false;
       $form['message'] = 'Problème de suppression dans la table Tache';
     }
     else{

       $form['valide'] = true;
       $form['message'] = 'Tache supprimé avec succès';
     }
   }
   $liste = $tache->select();
   echo $twig->render('tache.html.twig', array('form'=>$form,'liste'=>$liste));
 }
################################################################################
function actionTacheAjout($twig, $db){

  $form = array();
  $tache = new Tache($db);
  if (isset($_POST['btTAjouter'])){

    $libelleT = $_POST['libelleT'];
    $nbheureT = $_POST['nbheureT'];
    $coutT = $_POST['coutT'];
    $form['valide'] = true;
    $form['messageTitre'] = 'Tache ajoutée';
    $form['message'] = 'Le libelle pour Tache a bien été ajouter !';
    $exec = $tache->insert($libelleT,$nbheureT,$coutT);
    if (!$exec){

      $form['valide'] = false;
      $form['messageTitre'] = 'Echec de l\'ajout';
      $form['message'] = 'Le libelle pour Tache na pas put être ajouté !';
    }
  }
  $liste = $tache->select();
  echo $twig->render('tache-ajout.html.twig', array('form'=>$form,'liste'=>$liste));
}
################################################################################
function actionTacheModif($twig, $db){

  $form = array();
  if(isset($_GET['idTache'])){

    $tache = new Tache($db);
    $uneTache = $tache->selectById($_GET['idTache']);
    if ($uneTache!=null){$form['contact'] = $uneTache;}
    else{$form['message'] = 'libelle incorrect';}
  }
  else{

    if (isset($_POST['btModifier'])){

      $tache = new Tache($db);
      $libelleT = $_POST['libelleT'];
    $nbheureT = $_POST['nbheureT'];
    $CoutT = $_POST['CoutT'];
      $id = $_Post['idTache'];
      $form['valide'] = true;
      $form['message'] = 'Modification réussie';
      $exec=$tache->update($libelleT,$nbheureT,$CoutT);
      if(!$exec){

        $form['valide'] = false;
        $form['message'] = 'Échec de la modification';
      }
    }
  }
  $liste = $tache->select();
  echo $twig->render('tache-modif.html.twig', array('form'=>$form,'liste'=>$liste));
 }
 ?>
