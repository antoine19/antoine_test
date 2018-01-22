<?php session_start(); ?>

<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="css.css" />
    <title>Home Be One</title>
  </head>

  <body class="body">

    <div class="topnav" id="myTopnav">

      <!-- MENU HORIZONTAL -->
      <a href="page_sui.php">Home Be One</a>
      <a class="active" href="gerer_domicile.php">Gérer Mon Domicile</a>
      <a href="gerer_consommation.php">Gérer Ma Consommation</a>

    </div>

    <div class="account">

      <!-- ACCES AU COMPTE -->
      <a class="sign" href="deconnexion.php">Se Déconnecter</a>
      <a class="sign" href="my_account.php">Mon Compte</a>

    </div>

    <div>

      <fieldset class="block0">
      <legend>Supprimer Pièce</legend>

      <div class="modal1">

        <form method="POST" class="modal_content" action="">

          <div class="content">

            <label>Quelle pièce souhaitez-vous supprimer?</label>
            <?php
            echo'<select name="choix_pieces">';

              try
              {
               $bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo;charset=utf8', 'root', '');
              }
              catch (Exception $e)
              {
                      die('Erreur : ' . $e->getMessage());
              }

              $req_piece = $bdd->prepare('SELECT nom FROM piece WHERE ID_user=?');
              $req_piece->execute(array($_SESSION['ID']));
              while ($piece= $req_piece->fetch())
              {
                ?>
                <option value="<?php echo $piece['nom']; ?>"> <!--La valeur à envoyer à la bdd est le nom de la pieces-->
                  <?php echo $piece['nom']; ?>
                </option>
                <?php
              }

           echo '</select>';
           ?>

            <p>Attention, si vous supprimez une pièce les capteurs qui y sont associés seront supprimés!</p>

            <div class="clearfix">
              <button type="submit" class="button" name="sup_piece">Supprimer</button>
            </div>

      </fieldset>

    </div>

<?php include('2footer.php');?>

  </body>

</html>

<?php

if (isset($_POST['sup_piece']))
{
          try
          {
          $bdd = new PDO('mysql:host=localhost; dbname=bdd_hbo', 'root', '');
          }
          catch (Exception $e)
          {
          die('Erreur : ' . $e->getMessage());
          }
            $piece_supprime=$_POST['choix_pieces'];
            $pseudo_id=$_SESSION['ID'];
            $sup_piece=$bdd->prepare('DELETE FROM piece WHERE ID_user=? AND nom=?')  or die(print_r($bdd->errorInfo()));
            $sup_piece->execute(array($pseudo_id,$piece_supprime)) or die(print_r($bdd->errorInfo()));

              $capteur_supprime=$_SESSION['ID'];
              $sup_capteurs=$bdd->prepare('DELETE FROM capteurs WHERE ID_user=? AND piece=?')  or die(print_r($bdd->errorInfo()));
              $sup_capteurs->execute(array($capteur_supprime,$piece_supprime)) or die(print_r($bdd->errorInfo()));
              ?>
              <script type="text/javascript">alert("Pièce Supprimée");</script>
              <?php
            $delai=1;
            $url='http://localhost/home_be_one/tests/gerer_domicile.php';
            header("Refresh: $delai;url=$url");
}
else {
  echo"Veuillez remplir le formulaire";
}

 ?>
