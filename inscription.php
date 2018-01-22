<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="css.css" />
    <title>Home Be One</title>
  </head>

  <body class="body">

    <!-- HEADER -->
    <div class="topnav" id="myTopnav">

      <!-- MENU HORIZONTAL -->
      <a href="page_ini.php">Home Be One</a>
      <a href="catalogue.php">Catalogue</a>

    </div>

    <div class="account">

      <!-- ACCES AU COMPTE -->
      <a href="connexion.php">Se Connecter</a>
      <a class="active" href="inscription.php">S'inscrire</a>

    </div>

    <!-- SIGN UP -->
    <div class="modal1">

      <form method="POST" class="modal_content" action="">

        <div class="content">

          <label>Nom</label>
          <input type="text" placeholder="Entrer votre Nom" name="nom" required>

          <label>Prénom</label>
          <input type="text" placeholder="Entrer votre Prénom" name="prenom" required>

          <label>Clé</label>
          <input type="text" placeholder="Entrer votre Clé d'inscription" name="cle" required>

          <label>Pseudo</label>
          <input type="text" placeholder="Entrer votre Pseudo" name="pseudo" required>

          <label>Email</label>
          <input type="email" placeholder="Entrer votre Email" name="mail" required>

          <label>Confirmer Email</label>
          <input type="email" placeholder="Entrer votre Email" name="mail2" required>

          <label>Mot de Passe</label>
          <input type="password" placeholder="Enter votre Mot de Passe" name="mdp" required>

          <label>Confirmer Mot de Passe</label>
          <input type="password" placeholder="Entrer votre Mot de Passe" name="mdp2" required>

          <p>En créant un compte sur Home Be One vous acceptez les <a href="#">Termes et Confidentialité</a>.</p>

          <div class="clearfix">
            <button type="submit" class="button" name="validation_inscription">S'inscrire</button>
          </div>

        </div>

      </form>

    </div>


    <!-- FOOTER -->
    <?php include("1footer.php"); ?>

  </body>

</html>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_hbo', 'root', '');



   if(isset($_POST['validation_inscription'])) {
      $nom = htmlspecialchars($_POST['nom']);
      $prenom = htmlspecialchars($_POST['prenom']);
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);
      $cle=htmlspecialchars($_POST['cle']);
      $mdp = $_POST['mdp'];
      $mdp2 = $_POST['mdp2'];
      $option = ['cost' => 12,];
      $hashpass=password_hash($_POST['mdp'],PASSWORD_BCRYPT, $option);
      if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['cle']) AND !empty($_POST['mdp']) AND !empty($_POST['nom']) AND !empty($_POST['prenom'])) {
            if($mail == $mail2) {
               if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
                  $reqmail->execute(array($mail));
                  $mailexist = $reqmail->rowCount();
                  if($mailexist == 0) {
                     if($mdp == $mdp2) {
                        $insertmbr = $bdd->prepare("INSERT INTO utilisateur(nom, prenom, cle, pseudo, mail, mdp ) VALUES(?, ?, ?, ?, ?, ?)") or die(print_r($bdd->errorInfo()));
                        $insertmbr->execute(array($nom, $prenom, $cle, $pseudo, $mail, $hashpass)) or die(print_r($bdd->errorInfo()));
                        $_SESSION['pseudo']=$_POST['pseudo'] or die(print_r($bdd->errorInfo()));

header('Location: http://localhost/home_be_one/tests/connexion.php');

                     }  else {
                        echo "Vos mots de passes ne correspondent pas !";
                     }
                  }  else {
                     echo "Adresse mail déjà utilisée !";
                  }
               }  else {
                  echo "Votre adresse mail n'est pas valide !";
               }
            }  else {
            echo "Vos adresses mail ne correspondent pas !";
         }
      } else {
         echo "Tous les champs doivent être complétés !";
      }
   } else  {
      echo ' ';
   }
?>
