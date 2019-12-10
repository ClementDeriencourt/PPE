<?php

function actionDev($twig, $db) {
    $form = array();
    $developpeur = new Developpeur($db);
    if (isset($_GET['idDev'])) {
        $exec = $developpeur->delete($_GET['idDev']);
        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Erreur de suppression.';
        } else {
            $form['valide'] = true;
            $form['message'] = 'Developpeur  supprimé avec succès';
        }
    }
    $liste = $developpeur->select();
    echo $twig->render('dev.html.twig', array('form' => $form , 'liste' => $liste));
}

function actionDevAjout($twig, $db) {
    $form = array();
    $developpeur = new developpeur($db);
    if (isset($_POST['btDAjouter'])) {

        $nomDev = $_POST['nom'];
        $prenomDev = $_POST['prenom'];
        $adresseDev = $_POST['adresse'];
        $telDev = $_POST['tel'];
        $grade = $_POST['grade'];

        $form['valide'] = true;

        $developpeur->insert($nomDev, $prenomDev, $adresseDev, $telDev, $grade);
    }
    echo $twig->render('dev-ajout.html.twig', array('form' => $form));
}

function actionDevModif($twig, $db) {
    $form = array();
    if (isset($_GET['idDev'])) {
        $developpeur = new Developpeur($db);
        $unDeveloppeur = $developpeur->select($_GET['idDev']);
        if ($unDeveloppeur != null) {
            $form['developpeur'] = $unDeveloppeur;
        } else {
            $form['message'] = 'Developpeur incorrect';
        }
    } else {
        if (isset($_POST['btModifier'])) {
            $developpeur = new Developpeur($db);
            $nomDev = $_POST['nomDev'];
            $prenomDev = $_POST['prenomDev'];
            $adresseDev = $_POST['adresseDev'];
            $telDev = $_POST['telDev'];
            $grade = $_POST['grade'];

            $exec = $developpeur->update($nomDev, $prenomDev, $adresseDev, $telDev, $grade);
            if (!$exec) {
                $form['valide'] = false;
                $form['message'] = 'Echec de la modification des données. ';
            } else {
                $form['valide'] = true;
                $form['message'] = 'Modification des données réussie. ';
            }
        }
    }
    echo $twig->render('dev-modif.html.twig', array('form' => $form));
}

?>