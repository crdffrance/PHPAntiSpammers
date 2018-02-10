<?php

////////////////////////////////////////
// Encodage du fichier : UTF-8
// Utilisation des tabulations : Oui
// 1 tabulation = 4 caract�res
// Fins de lignes = LF (Unix)
////////////////////////////////////////

///////////////////////////////
// LICENCE
/////////////////////////////// 
// 
// PHPAntiSpammers is a PHP program with which you can publish any project
// or sources files of any type supported you want.
//
// International Copyright � 2000 - 2010 CRDF All Rights Reserved.
//
// Contact @ http://www.crdf.fr - clients@crdf.fr
// 
// PHPAntiSpammers is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// 
// PHPAntiSpammers is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with PHPAntiSpammers; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
// 
///////////////////////////////

/**
 * PHPAntiSpammers - Application PHP Anti-Spam
 *
 * @author G. Jocelyn
 * @copyright CRDF France
 * @license GNU GPL (http://www.gnu.org/copyleft/gpl.html)
 * @link http://www.crdf.fr
 * @name PHPAntiSpammers
 * @since 17/08/2008
 * @version 3.0.2
 */

// ///////////////////////////////////////////////////////////////////////////////////
// Ce fichier contient l'e-mail � envoyer � l'exp�diteur pour lui indiquer que
// son message a �t� consid�r� comme un SPAM. Reportez-vous au fichier de
// configuration. Personnalisez librement ces param�tres.
// ///////////////////////////////////////////////////////////////////////////////////

/* ***************************************************************************************************** */
//Configuration des HEADERS de l'e-amil pour le retourner � l'envoyeur

$header = "MIME-Version: 1.0\r\n";
$header .= "From: CRDF PHP Anti Spammers <clients-".rand()."@crdf.fr>\r\n";

/* ***************************************************************************************************** */
//Configuration du sujet � envoyer de l'e-amil pour le retour � l'envoyeur
//Note : Vous pouvez �galement indiquer les variables contenues dans l'application (voir l'exemple ci-dessous).

if(empty($SubjectMsg))
{
	$SubjectMessageSpamDetect = "RE: [pas d'objet]";
} else
{
	$SubjectMessageSpamDetect = "RE: " . $SubjectMsg;
}

/* ***************************************************************************************************** */
//Mise en forme et traitement des raisons de d�tection par le filtre anti-spam

$NomFiltreDeclencherArrayTab = explode(";", $NomFiltreDeclencher);

foreach ($NomFiltreDeclencherArrayTab as $ValueNomFiltreDecl)
{
	if(strlen($ValueNomFiltreDecl) > 2)
	{
		if(count($NomFiltreDeclencherArrayTab) > 0)
		{
			$AffiResultFiltreDeclencher .= "- " . $ValueNomFiltreDecl . "." . "\n";
		} else
		{
			$AffiResultFiltreDeclencher .= "- " . $ValueNomFiltreDecl . ".";
		}
		$IMefFiltreD++;
	}
}

/* ***************************************************************************************************** */
//Configuration du message � envoyer � l'exp�diteur
//Note : Vous pouvez �galement indiquer les variables contenues dans l'application (voir l'exemple ci-dessous).

$MessageSpamDetec = "---------------------------------------------------------------------
CECI EST UNE REPONSE AUTOMATIQUE, MERCI DE NE PAS Y REPONDRE
---------------------------------------------------------------------

(English version below)

Bonjour,
			
Suite � votre email, nous sommes dans le regret de vous informer que votre message a �t� consid�r� comme un courrier ind�sirable par PHP Anti Spammers (solution de protection anti-spam).
Le message ne pourra pas �tre lu. Pour que ce message soit lu, merci de bien vouloir corriger les �l�ments (voir ci-dessous) qui ont �t� consid�r�s comme du SPAM et de renvoyer votre email.

Vous trouverez ci-dessous les �l�ments qui ont �t� consid�r�s comme du courrier ind�sirable.

Raison de la d�tection : $AffiResultFiltreDeclencher
Niveau de d�tection : $LevellSpam.
Action faite sur votre email : $InfoTraitMsg

Informations sur l'email envoy� :

Message ID : ".imap_uid($StreamPHPAntiSpammers, $UidMsg).".
Serveur SMTP : $MatchesEnTeteSTLS ($NameResolveFAI).
Emetteur : $FromEmail.
Objet : $SubjectMessageSpamDetect.

Cordialement,
Le service client,

Service commercial : commercial@crdf.fr
Service technique : webmaster@crdf.fr
Service client : clients@crdf.fr
T�l. CRDF : 01 83 64 00 03 (prix d'un appel local).

---------------------------------------------------------------------
This is an automated response, do not please reply
---------------------------------------------------------------------

Dear Sir or Madam,

Following your email, we are in the regret to inform you that your message was regarded as undesirable mail by PHP Anti Spammers (solution of protection anti-spam).
The message could not be read. So that this message is read, thanks for agreeing to correct the elements (see below) which were regarded as SPAM and to return your email. 

You will find below the elements which were regarded as undesirable mail.

Reason of detection: $AffiResultFiltreDeclencher
Level of detection: $LevellSpam.
Action do on your email: $InfoTraitMsg

Message ID: ".imap_uid($StreamPHPAntiSpammers, $UidMsg).".
Server SMTP: $MatchesEnTeteSTLS ($NameResolveFAI).
Transmitter: $FromEmail.
Subject: $SubjectMessageSpamDetect.

Regards,
CRDF Anti-Spam Service,

PHP Anti Spammers : Solution de protection anti-spam par CRDF - Solution of protection anti-spam by CRDF - http://www.crdf.fr";

/* ***************************************************************************************************** */
//Envoi de l'e-mail pour le retour � l'envoyeur avec TEST de l'envoie

if(!mail($FromEmail, $SubjectMessageSpamDetect, $MessageSpamDetec, $header))
{
	trigger_error("L'e-mail de retour � l'exp�diteur n'a pas �t� envoy�. Veuillez v�rifier que PHP puisse envoyer des emails depuis votre serveur avec la fonction mail(). Vous pouvez �galement d�sactiver cette fonction depuis le fichier de configuration de l'application.");
}

/* ***************************************************************************************************** */
//Destruction des diff�rentes variables par mesure de pr�caution

unset($FromEmail, $SubjectMessageSpamDetect, $MessageSpamDetec, $header);

/* ***************************************************************************************************** */

?>