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
      <a class="active" href="connexion.php">Se Connecter</a>
      <a href="inscription.php">S'inscrire</a>

    </div>

    <!-- SIGN IN -->
    <div class="modal1">

      <form method="POST" class="modal_content" action="connexion_cible.php">

        <div class="content">

          <label>Pseudo</label>
          <input type="text" placeholder="Entrer votre pseudo" name="pseudo" required>

          <label>Mot de Passe</label>
          <input type="password" placeholder="Entrer votre mot de passe" name="mdp" required>

          <p><a href="#">Pseudo ou Mot de Passe oublié?</a></p>

          <div class="clearfix">
            <button type="submit" class="button">Se Connecter</button>
          </div>

        </div>

      </form>

    </div>


    <!-- FOOTER -->
    <?php include("1footer.php"); ?>

  </body>

</html>
