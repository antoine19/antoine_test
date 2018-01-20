<?php
// on teste si le formulaire a été soumis
if (isset ($_POST['formulaire']) && $_POST['formulaire']=='Poster')
  {

	     if (isset($_POST['auteur']) AND isset($_POST['titre']) /*isset($_POST['message'])*/ AND !empty($_POST['auteur']) AND !empty($_POST['titre']) /*AND !empty($_POST['message'])*/)
          {
            //connexion bdd
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());

            }

            $new_auteur=$_POST['auteur'];
            $new_titre=$_POST['titre'];
          /*  $message_sujet=$_POST['message'];*/

            // préparation de la requête d'insertion (pour la table forum_sujets)
            //$sql = 'INSERT INTO forum_sujets VALUES("", "'.mysql_escape_string($_POST['auteur']).'", "'.mysql_escape_string($_POST['titre']).'", "'.$date.'")';
            $req_new_auteur_titre_date=$bdd->prepare('INSERT INTO forum_sujet(auteur_sujet,titre, date_derniere_reponse) VALUES(?,?, NOW())');
            $req_new_auteur_titre_date->execute(array($new_auteur,$new_titre)) or die(print_r($bdd->errorInfo()));
            //$req_new_auteur_titre_date->execute($_POST['titre']);

            // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
            //mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

            // on recupère l'id qui vient de s'insérer dans la table forum_sujets
            $bdd->lastInsertId();



            // on ferme la connexion à la base de données
            $req_new_auteur_titre_date->CloseCursor();

            // on redirige vers la page d'accueil
            header('Location: forum_test.php');

            // on termine le script courant
            exit;
	          }

     else {
       $erreur = 'Les variables nécessaires au script ne sont pas définies.';
           }

  }

  else {
    $erreur='Veuillez remplir et envoyer le formulaire';
       }



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index_lol.css">

    <title>Index</title>
  </head>
    <body>


            <!-- on fait pointer le formulaire vers la page traitant les données -->
            <form action="insert_sujet.php" method="POST">
            <table>
            <tr>
            <td>
            Auteur :
            </td>
            <td>
            <input type="text" name="auteur" value="<?php if (isset($_POST['auteur'])) echo htmlentities($_POST['auteur']); ?>">
            </td>
            </tr>
            <tr>
            <td>
            Titre :
            </td>
            <td>
            <input type="text" name="titre"  value="<?php if (isset($_POST['titre'])) echo htmlentities($_POST['titre']); ?>">
            </td>
            </tr>
            <?php /*<tr>
            <td>
            Message :
            </td><td>
            <textarea name="message" cols="60" rows="10"><?php if (isset($_POST['message'])) echo htmlentities($_POST['message']); ?></textarea>
            </td></tr><tr><td><td align="right"> */?>
            </td></tr></table>
            <input type="submit" name="formulaire" value="Poster">

            </form>
            <?php
            // on affiche les erreurs éventuelles
            if (isset($erreur)) echo '<br /><br />',$erreur;
            ?>
    </body>
</html>
