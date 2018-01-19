<form method="post" action="">
  <input type="text" name="texte" placeholder="votre texte..">
  <input type="submit" value="envoyer" name="submit">
</form>


<?php
    if (isset($_POST['submit']))
     {
       $texte=$_POST["texte"];
       $texte1=md5($texte);
       $texte2=sha1($texte);
       if($texte)

             {
               echo "voici votre texte code en MD5: <br>".$texte1;
               echo "voici votre texte code en sha1 :<br>".$texte2;
             }
             else {
               echo "veuillez remplir la case !";
             }
     }
     echo "envoie le formulaire";
coucou tout le monde c est squeezie




 ?>
