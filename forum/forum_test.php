<?php session_start();?>

<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../css.css" />
    <title>Home Be One</title>
  </head>

  <body class="body">

    <div class="topnav" id="myTopnav">

      <!-- MENU HORIZONTAL -->
      <a href="../page_sui.php">Home Be One</a>
      <a class="active" href="../gerer_domicile.php">Gérer Mon Domicile</a>
      <a href="../gerer_consommation.php">Gérer Ma Consommation</a>
      <a href="forum_test.php">Forum</a>


    </div>

    <div class="account">

      <!-- ACCES AU COMPTE -->
      <a class="sign" href="../deconnexion.php">Se Déconnecter</a>
      <a class="sign" href="../my_account.php">Mon Compte</a>

    </div>

    <div class="big_block">

      <fieldset class="block0">
      <legend>Forum</legend>

      <?php //echo"bite";?>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" href="index_lol.css">

          <title>Index</title>
        </head>
          <body>

       <?php

        // Vérification des identifiants
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }?>


      <a href="forum_test_insert_sujet.php">Insérer un sujet</a>
      <?php
      $req_suj=$bdd->query('SELECT * /* id, auteur, titre DATE_FORMAT(date_derniere_reponse, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr*/ FROM forum_sujet ORDER BY date_derniere_reponse DESC');//on selectione tout les sujets et réecrit la date
      $req_count=$bdd->query ('SELECT COUNT(*) AS nbr_sujets');//retourne nbr de ligne de requete mysql
      //$req3=$req2['nbr_sujets'];
      $req_resultat_count = $req_count->fetch(); //on peut mtn exploiter le resultat avec le if
          if ($req_resultat_count['nbr_sujets'] == 0) // si y pas de sujet alors on d
              {
                  echo'il n\'y a aucun sujet !';
              }
          else {
                ?>  <table>
                  <tr>
                  <td>  Auteur   </td>
                  <td>    Titre </td>
                  <td>   Date derniere reponse  </td>
                  </tr>
                    </table>

                <?php
                while ($data=$req_suj->fetch())
                  {
                      echo '<table>';
      	             // on affiche les résultats
      	              echo '<tr>';
      	               echo '<td>';

      	                // on affiche le nom de l'auteur de sujet
      	                 echo $data['auteur_sujet'];
      	                  echo '</td>
                          <td></br>';
                          // on affiche le titre du sujet, et sur ce sujet, on insère le lien qui nous permettra de lire les différentes réponses de ce sujet
      	                   echo '<a href="./forum_test_lire_sujet.php?id_sujet_a_lire=' , $data['id'] , '">' , htmlentities(trim($data['titre'])) , '</a>';

      	                    echo '</td><td></br>';

      	                     // on affiche la date de la dernière réponse de ce sujet
              	       echo $data['date_derniere_reponse'];
                       echo'</td></tr></table>';
                               }
                    ?>

                  <?php
               }

                $req_suj->closeCursor(); ?>
              <a href="../accueil_connecte_okok.php"> Cliquer pour revenir au menu</a>
              <a href="supprimer_sujet.php">Cliquer pour supprimer un sujet</a>
      </body>
      </html>


      </fieldset>

    </div>



    <!-- FOOTER -->
    <?php include("../2footer.php"); ?>

  </body>

</html>
