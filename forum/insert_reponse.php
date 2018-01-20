
<?php
// on teste si le formulaire a été soumis
if (isset ($_POST['formulaire_reponse']) && $_POST['formulaire_reponse']=='Poster')
 {

    if (isset($_POST['auteur']) AND isset($_POST['message']) AND isset($_GET['numero_du_sujet']) AND !empty($_POST['auteur']) AND !empty($_POST['message']))
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

           $new_auteur_reponse=$_POST['auteur'];
           $new_reponse=$_POST['message'];
           $id_sujet=$_GET['numero_du_sujet'];
           // préparation de la requête d'insertion (table forum_reponses)
           //or die affiche erreur de ma requete
            $insert_reponse=$bdd->prepare('INSERT INTO forum_reponse(auteur, message, correspondance_sujet, date_message) VALUES(?,?,?,NOW())') or die(print_r($bdd->errorInfo()));
            $insert_reponse->execute(array($new_auteur_reponse,$new_reponse,$id_sujet)) or die(print_r($bdd->errorInfo()));



           $new_date_msg=$bdd->prepare('UPDATE forum_sujet SET date_derniere_reponse= NOW() WHERE id="'.$_GET['id_sujet_a_lire']);



           $insert_reponse->CloseCursor();

           // on redirige vers la page de lecture du sujet en cours
           header('Location: lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet']);

           // on termine le script courant
           exit;
         }

      else {
        $erreur='Veuillez remplir les champs !';
          }
    }
else {
        $erreur='Veuillez remplir et envoyer le formulaire';
      }  ?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index_lol.css">
    <title>Insérer une réponse</title>
  </head>
    <body>

            <!-- on fait pointer le formulaire vers la page traitant les données -->
            <!-- trim enleve  espace debut/fin de chaine et htmlentities convertit tout en html -->
            <form action="insert_reponse.php?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>" method="POST">
            <table>
            <tr>
            <td>
            Auteur :
            </td>
            <td>
            <input type="text" name="auteur"  value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
            </td></tr><tr><td>
            Message :
            </td><td>
            <textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
            </td>
            </tr>
            <tr>
            <td><td align="right">
            <input type="submit" name="formulaire_reponse" value="Poster">
            </td>
           </tr>
            </table>
            </form>
            <?php
            if (isset($erreur)) echo '<br /><br />',$erreur;
            ?>
    </body>
  </html>
