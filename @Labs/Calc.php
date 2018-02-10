<?
function Calcul($nombre1, $operation, $nombre2)
{
        if(is_numeric($nombre1) != TRUE || is_numeric($nombre2) != TRUE) //On vérife que les données saisies sont des nombres et seulement des nombres
        {
                $resultat = '<span style="color:red;">Veuillez saisir seulement des nombres.</span>';//Ce n'est pas seulement des nombres : on affiche un message d'erreur
        }
        else // Sinon, on effectue le calcul
        {
                $calcul = '' . $nombre1 . $operation . $nombre2 . '';//On crée une chaîne pour le calcul
                $reponse = eval("return " . $calcul . ";");//On traîte la chaîne comme un code PHP
                $resultat = $nombre1 . ' ' . $operation . ' ' . $nombre2 . ' = <u>' . $reponse . '</u>';//On initialise la variable $resultat qui sera retourée à la fin
        }
        return $resultat;//On retourne la variable $resultat : elle est soit un message d'erreur, soit le calcul!
}
?>

<html>
<head>
<title>Calculette à opération simple en PHP</title>
</head>
<body>

<div style="text-align:center;">

<h1>Calculette à opération simple en PHP</h1>

<?
if(isset($_POST['nombre1']) AND isset($_POST['nombre2']) AND isset($_POST['operation']))//On vérifie que le nombre sont bien entrés!
{
        echo '<p>' . Calcul(htmlentities($_POST['nombre1']), htmlentities($_POST['operation']), htmlentities($_POST['nombre2'])) . '</p>';//On affiche le calcul ou le message d'erreur en appelant la fonction Calcul!
}
?>

<form method="post">
<p>
<input type="text" name="nombre1" size="5" /> <select name="operation"><option value="+">+</option><option value="-">-</option><option value="*">*</option><option value="/">/</option></select> <input type="text" name="nombre2" size="5" /><br/><!-- On entre le code HTML d'un zone de saisie, d'une liste déroulante et ensuite, d'une autre zone de saisie -->
<input type="submit" value="Calculer!" /><!-- On oublie pas le bouton! -->
</p>
</form>

</div>

</body>
</html> 