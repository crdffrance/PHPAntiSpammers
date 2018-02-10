<?php

// Après soumission du formulaire on contrôle le champ message
if (!preg_match('#(?:bonjour|bonsoir|cordialement|salut|hello|hi|merci)#Ui', 
$message)) {
   echo 
'<p>Votre message devrait contenir une formule de politesse telle que :' .
' bonjour, bonsoir, cordialement, salut ou hello... au pire merci !</p>';
} else {
   // L'envoi de l'email ici
}
?>

