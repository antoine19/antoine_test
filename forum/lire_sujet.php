<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index_lol.css">

    <title>Lire un sujet</title>
  </head>
    <body>


<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());

}

      if (empty($_GET['id_sujet_a_lire']) )
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
          // Vérification des identifiants


          /*$bdd->query('SELECT forum_reponse.auteur, forum_sujet.prenom  FROM forum_reponse forum_sujet,  WHERE forum_reponse.id_sujet = forum_sujet.id ');*/

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
        	<a href="insert_reponse.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>">Répondre</a>
        	<?php
        }
        ?>
        <br /><br />
        <!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
        <a href="index.php">Retour à l'accueil</a>
    </body>
</html>
