<?php session_start();
$_SESSION['pseudo']=$_POST['pseudo'];
?>

<!DOCTYPE html>


    <?php

    // Vérification des identifiants
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    $requser_bis = $bdd->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo');
    $requser_bis->execute(array('pseudo' => $_POST['pseudo']));
    $requser_tres=$requser_bis->fetch();


    if ($requser_tres==0)
      {
                ?>
                  <script type="text/javascript">

                alert('Votre pseudo ne convient pas ! ');
                </script><?php
                $delai=1;
                $url='http://localhost/home_be_one/tests/connexion.php';
                header("Refresh: $delai;url=$url");
                exit();?><?php
      }

      else {

          $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo');
          $requser->execute(array('pseudo' => $_POST['pseudo']));
         $resultat = $requser->fetch();
            if(password_verify($_POST['mdp'],$resultat['mdp']))

              {
                          $_SESSION['ID']=$resultat['ID'];
                          $delai=1;
                          $url='http://localhost/home_be_one/tests/page_sui.php';
                          echo 'Veuillez patienter';
                          header("Refresh: $delai;url=$url");
                          exit();
                      //}
                  }
          else {
            ?>
                   <script type="text/javascript">

                 alert('Vos mot de passe ne correspondent pas !');
                 </script><?php
                 $delai=1;
                 $url='http://localhost/home_be_one/tests/connexion.php';
                 echo 'Veuillez patienter';
                 header("Refresh: $delai;url=$url");
                 exit();
          }
        }



                       ?>


</html>
