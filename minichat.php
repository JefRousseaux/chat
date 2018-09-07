<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Mini-chat</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>
    <div class="position_formulaire">
    <form action="minichat_post.php" method="post">
        <p>
          
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="
        <?php if(isset($_SESSION['pseudosession']))
         {echo $_SESSION['pseudosession']; }  
       
         else {echo '';
         } ?>"  /> <br/>

        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />

        <input type="submit" value="Envoyer" />
    </p>
    </form>

<form action="minichat_post.php" method="post">
<p>
    <input type="submit" value="rafraichir" />
</p>
     </form>

<form action="deconnexion.php" method="post">
<p>
    <input type="submit" value="enlever le pseudo par défaut" />
</p>
     </form>
 </div>
 <table class="position_chat">
    <tr>
        <td>
<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_message, \' publié à %hh %im le %d septembre 20%y\') AS date_creation_fr FROM minichat ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
    echo '<p><strong class="nom">'.htmlspecialchars($donnees['pseudo']).'</strong> : ' . htmlspecialchars($donnees['message']) . '
    (' . htmlspecialchars($donnees['date_creation_fr']) . ') </p>';
}

$reponse->closeCursor();

?>
</td>
</tr>
</table>
    </body>
</html>
