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
      <legend>Messages</legend>



            <?php
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());

            }


          $req_suj=$bdd->prepare('SELECT * FROM forum_sujet WHERE id=?');
          $req_suj->execute(array($_GET['id_sujet_a_lire']));
          $req=$req_suj->fetch();

                      if (empty($_GET['id_sujet_a_lire']) OR $_GET['id_sujet_a_lire']!=$req['id'])
                      {

                        echo' Aucun sujet identifie / Aucun sujet pour cette ID !';

                      }
                    else {

                      ?>

                        <table width="500" border="1">
                        <tr>
                        <td>
                          Auteur
                        </td>
                        <td>
                          Messages
                        </td>
                        </tr>

                         <?php

                              $req_suj->closeCursor();
                               $req_liste_msg=$bdd->query('SELECT auteur, message, date_message FROM forum_reponse WHERE correspondance_sujet =" '.$_GET['id_sujet_a_lire'].'" ORDER BY date_message');
                                while ($data=$req_liste_msg->fetch())
                                  {
                                            # code...// on affiche les résultats
                                      	echo '<tr>';
                                      	echo '<td>';

                                      	// on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
                                      	echo $data['auteur'];
                                      	echo '<br />';
                                      	echo $data['date_message'];

                                      	echo '</td><td>';

                                      	// on affiche le message
                                      	echo nl2br(htmlentities($data['message']));
                                      	echo '</td></tr>';
                                    }


                            	// on ferme la connection à la base de données.
                            	$req_liste_msg->closeCursor ();
                            	?>

                            	<!-- on ferme notre table html -->
                            	</table>
                            	<br /><br />
                            	<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
                            	<a href="forum_test_repondre_sujet.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>">Répondre</a>
                            	<?php

                        ?><?php
                    }
                  ?>  <br /><br />

      </fieldset>

    </div>

    <!-- FOOTER -->
    <?php include("../2footer.php"); ?>

  </body>

</html>
