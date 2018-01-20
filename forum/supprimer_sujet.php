<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index_lol.css">

    <title>Supprimer un sujet</title>
  </head>
    <body>

      <form method="post" action="">


            <td>
              <?php
              echo'<select name="choix_id">';

                try
                {
                 $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
                }
                catch (Exception $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }

                $req_sujet = $bdd->query('SELECT * FROM forum_sujet');

                while ($sujet = $req_sujet->fetch())
                {
                  ?>
                  <option value="<?php echo $sujet['id']; ?>"> <!--La valeur à envoyer à la bdd est le nom de la pièce-->
                    <?php echo $sujet['titre']; ?>
                    <?php echo $sujet['id']; ?>
                  </option>
                  <?php
                }
             echo '</select>';
             ?>
            </td>
    </tr>
    <input type="submit" name="envoyer" value="valider">


  </body>
</html>

<?php

if (isset($_POST['envoyer']) AND !empty($_POST['envoyer']=='valider'))
{
          try
          {
          $bdd = new PDO('mysql:host=localhost; dbname=test', 'root', '');
          }
          catch (Exception $e)
          {
          die('Erreur : ' . $e->getMessage());
          }
          //supprime message

            $req_sujet_correspondre = $bdd->prepare('DELETE FROM forum_reponse  WHERE correspondance_sujet=? ');
            $req_sujet_correspondre->execute(array($_POST['choix_id']));
            $req_sujet_correspondre->closeCursor();

            //supprimer sujet

            $req_reponse=$bdd->prepare('DELETE FROM forum_sujet WHERE id=?');
            $req_reponse->execute(array($_POST['choix_id']));
            $req_reponse->closeCursor();



            $delai=2;
            $url='index.php';?>
            <script type="text/javascript">
            alert("Sujet supprimé !");
            </script>
            <?php
            header("Refresh: $delai;url=$url");


}
else {
  $erreur="Veuillez remplir le formulaire";
}
?>



        <br /><br />
        <!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
        <a href="index.php">Retour à l'accueil</a>
    </body>
</html>
