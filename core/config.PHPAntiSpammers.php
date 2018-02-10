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

/* ***************************************************************************************************** */
//Configuration g�n�rale de l'application "PHPAntiSpammers"

// -- Adresse du serveur de messagerie (par exemple : imap.domaine.tld)

$PHPAntiSpammers['ServerAdress'] = "imap.domaine.tld";

// -- Protocole utilis� pour la connexion au serveur de messagerie (par exemple : imap ou pop3)

$PHPAntiSpammers['ServerProtocol'] = "imap";

// -- Port du serveur de messagerie (par exemple : 993)

$PHPAntiSpammers['ServerPort'] = 993;

// -- La connexion au serveur de messagerie utilise-t-elle une connexion s�curis�e ? Vous pouvez utiliser le protocole SSL et TLS.
// -- true = oui
// -- false = non

$PHPAntiSpammers['ServerUseSSLProtocol'] = true;

// -- Adresse email du compte � v�rifier (par exemple : email@domaine.tld)

$PHPAntiSpammers['EmailUser'] = "email@domaine.tld";

// -- Nom d'utilisateur pour connexion au serveur de messagerie (par exemple : email@domaine.tld)

$PHPAntiSpammers['ServerUser'] = "email@domaine.tld";

// -- Mot de passe pour connexion au serveur de messagerie

$PHPAntiSpammers['ServerPassword'] = "";

// -- D�calage horaire par d�faut de toutes les fonctions date/heure
// -- Fuseaux horaires support�s : http://fr3.php.net/manual/fr/timezones.php

date_default_timezone_set("Europe/Paris");

// -- Clef MAJ des mises � jour.
// -- Afin de pouvoir obtenir les derni�res mises � jour des bases anti-spam de PHP Anti Spammers.
// -- Vous devez obtenir une clef MAJ (enti�rement gratuit, rendez-vous sur www.crdf.fr) et l'entrer ci-dessous afin de pouvoir obtenir ces mises � jour.
// -- Conseil : Sans les mises � jour de bases anti-spam, il ne sera plus r�ellement tr�s efficace ;).

$PHPAntiSpammers['KeyMAJ'] = "enteryourmajkeyhere";

// -- D�finition de la version de l'application PHP Anti Spammers.
// -- Cette constante permet simplement d'indiquer au service de mise � jour la version de l'application.
// -- Merci de bien vouloir ne pas modifier ce param�tre afin de pouvoir vous pr�venir en cas de mise � jour de PHP Anti Spammers

$PHPAntiSpammers['__PHPAntiSpammers_Version_Core__'] = "3.0.2";

/* ***************************************************************************************************** */
//Configuration des actions � ex�cuter lors de la d�tection d'un SPAM par PHPAntiSpammers

// -- Que faire lors de la d�tection d'un spam par PHPAntiSpammers ?

// -- move = d�placer le message dans le dossier de votre choix (recommand�)
// -- delete = supprimer le message
// -- ignore = ignorer (il ne sert � rien alors d'installer PHPAntiSpammers ;) !)

$PHPAntiSpammers['ActionDetectSpam'] = "move";

// -- Si vous avez choisi l'option "move" ci-dessus, vous devez mettre le dossier ou d�placer les SPAM d�tect�s par PHPAntiSpammers
// -- Note : Merci de bien vouloir consulter votre messagerie pour cr�er des dossiers et v�rifier que le dossier existe.
// -- Par exemple : 'INBOX.Spam' car dossier principal 'INBOX'. 'Spam' est un sous-dossier � 'INBOX'.

$PHPAntiSpammers['SpamDetectFolderMove'] = "INBOX.Spam";

// -- Envoyer un e-mail � l'envoyeur pour le pr�venir que son message a �t� consid�r� comme un SPAM
// -- Note : si vous activez cette option, vous pouvez modifier l'e-mail envoy� dans le fichier 'core/email_answer.PHPAntiSpammers.php'.
// -- true = oui
// -- false = non

$PHPAntiSpammers['SpamDetectSendEmail'] = true;

/* ***************************************************************************************************** */
//Configuration des filtres anti-spam de l'application
// -- true = filtre activ�
// -- false = filtre d�sactiv�

// -- Activation du filtre : "sujets suspects"

$PHPAntiSpammers['ConfigFiltre']['EnableSubjectSuspect'] = true;

// -- Activation du filtre : "mots suspects dans le sujet"

$PHPAntiSpammers['ConfigFiltre']['EnableMotsSubject'] = true;

// -- Activation du filtre : "expressions r�guli�res � v�rifier dans le sujet des mails"

$PHPAntiSpammers['ConfigFiltre']['EnableSubjectRegex'] = true;

// -- Activation du filtre : "mots de l'�metteur suspect"

$PHPAntiSpammers['ConfigFiltre']['EnableNameReptEmet'] = true;

// -- Activation du filtre : "noms de domaine ou adresses e-mail suspects (exp�diteur)"

$PHPAntiSpammers['ConfigFiltre']['EnableDoaminOrEmail'] = true;

// -- Activation du filtre : "codes pays suspects dans le nom de domaine de l'exp�diteur"

$PHPAntiSpammers['ConfigFiltre']['EnableExtDomain'] = true;

// -- Activation du filtre : "Liste des fournisseurs d'acc�s Internet suspects"

$PHPAntiSpammers['ConfigFiltre']['EnableFAISMTP'] = true;

// -- Activation du filtre : "Liste des adresses IP suspectes"

$PHPAntiSpammers['ConfigFiltre']['EnableIPSMTP'] = true;

// -- Activation du filtre : "mots suspects dans le nom des fichiers (pi�ces jointes)"

$PHPAntiSpammers['ConfigFiltre']['EnableFileName'] = true;

// -- Activation du filtre : "extensions de noms de fichiers (pi�ces jointes) suspectes"

$PHPAntiSpammers['ConfigFiltre']['EnableFileExt'] = true;

// -- Activation du filtre : "v�rification des messages automatiques"

$PHPAntiSpammers['ConfigFiltre']['EnableMsgAuto'] = true;

// -- Activation du filtre : "v�rification de la validit� de la date"

$PHPAntiSpammers['ConfigFiltre']['EnableValdDate'] = true;

// -- Activation du filtre : "v�rification de l'exp�diteur du message"
// -- Explication : votre adresse de messagerie est 'email@domaine.tld'. Si le spammeur envoie un e-mail avec l'adresse e-mail 'email@domaine.tld'.
// -- alors celui-ci activera ce filtre et le message sera consid�r� comme un SPAM.
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.

$PHPAntiSpammers['ConfigFiltre']['EnableWhoExp'] = true;

// -- Activation du filtre : "v�rification de la validit� domaine de l'exp�diteur du message"

$PHPAntiSpammers['ConfigFiltre']['EnableDomainTest'] = true;

// -- Activer la v�rification par les serveurs RBL (serveur de liste noire communautaire)
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.

$PHPAntiSpammers['ConfigFiltre']['EnableRBL'] = true;

// -- Activation du filtre : "emp�cher les pi�ces jointes dans les e-mails"

$PHPAntiSpammers['ConfigFiltre']['EnableAttachmentNotAuth'] = false;

// -- Activation du filtre : "v�rifier que le serveur distant puisse recevoir des emails"

$PHPAntiSpammers['ConfigFiltre']['EnableVefServerReceiveEmail'] = false;

/* ***************************************************************************************************** */
//Configuration des indices de spammicit� pour chacun des filtres

// -- La configuration de spmmacit� de chaque filtres vous permet de jouer sur la s�v�rit� des diff�rents filtres.
// -- Ceci permet de jouer sur la s�v�rit� de l'analyse par PHP Anti Spammers.
// -- Plus d'indice de spammicit� est �lev�, plus la probabilit� que l'email soit un spam est �lev�.

// -- //// ATTENTION ////
// -- La configuration des indices de spammicit� est r�serv�e aux experts. La modification par un novice de ces diff�rents param�tres peut
// -- jouer sur le taux de d�tection des spams par PHP Anti Spammers.

// -- Indice de spammicit� du filtre : "sujets suspects"
// -- Param�tre recommand� : 100.

$PHPAntiSpammers['SpamRate']['SubjectSuspect'] = 100;

// -- Indice de spammicit� du filtre : "noms de domaine ou adresses e-mail suspects (exp�diteur)"
// -- Param�tre recommand� : 500.

$PHPAntiSpammers['SpamRate']['DoaminOrEmail'] = 500;

// -- Indice de spammicit� du filtre : "codes pays suspects dans le nom de domaine de l'exp�diteur"
// -- Param�tre recommand� : 200.

$PHPAntiSpammers['SpamRate']['ExtDomain'] = 200;

// -- Indice de spammicit� du filtre : "Liste des fournisseurs d'acc�s Internet suspects"
// -- Param�tre recommand� : 800.

$PHPAntiSpammers['SpamRate']['FAISMTP'] = 800;

// -- Indice de spammicit� du filtre : "Liste des adresses IP suspectes"
// -- Param�tre recommand� : 800.

$PHPAntiSpammers['SpamRate']['IPSMTP'] = 800;

// -- Indice de spammicit� du filtre : "mots suspects dans le nom des fichiers (pi�ces jointes)"
// -- Param�tre recommand� : 200.

$PHPAntiSpammers['SpamRate']['FileName'] = 200;

// -- Indice de spammicit� du filtre : "extensions de noms de fichiers (pi�ces jointes) suspectes"
// -- Param�tre recommand� : 200.

$PHPAntiSpammers['SpamRate']['FileExt'] = 200;

// -- Indice de spammicit� du filtre : "v�rification des messages automatiques"
// -- Param�tre recommand� : 800.

$PHPAntiSpammers['SpamRate']['MsgAuto'] = 800;

// -- Indice de spammicit� du filtre : "v�rification de la validit� de la date"
// -- Param�tre recommand� : 800.

$PHPAntiSpammers['SpamRate']['ValdDate'] = 800;

// -- Indice de spammicit� du filtre : "v�rification de l'exp�diteur du message"
// -- Param�tre recommand� : 400.

$PHPAntiSpammers['SpamRate']['WhoExp'] = 400;

// -- Indice de spammicit� du filtre : "v�rification de la validit� domaine de l'exp�diteur du message"
// -- Param�tre recommand� : 400.

$PHPAntiSpammers['SpamRate']['DomainTest'] = 400;

// -- Indice de spammicit� du filtre : "emp�cher les pi�ces jointes dans les e-mails"
// -- Param�tre recommand� : 1000.

$PHPAntiSpammers['SpamRate']['AttachmentNotAuth'] = 1000;

// -- Indice de spammicit� du filtre : "v�rifier que le serveur distant puisse recevoir des emails"
// -- Param�tre recommand� : 400.

$PHPAntiSpammers['SpamRate']['VefServerReceiveEmail'] = 400;

/* ***************************************************************************************************** */
//Configuration du filtre de v�rification des serveurs RBL

// -- La variable $PHPAntiSpammers['ConfigFiltre']['EnableRBL'] doit �tre sur TRUE pour pouvoir utiliser ces serveurs.
// -- Note : Les serveurs qui sont configur�s par d�faut sont les plus connus et donc les plus fiables.
// -- Merci de bien vouloir faire ATTENTION aux serveurs que vous avez ajout�s.

$PHPAntiSpammers['ConfigFiltre']['ListRBL'] = array("cbl.abuseat.org",
													"list.dsbl.org",
													"dnsbl.njabl.org",
													"sbl.spamhaus.org",
													"bl.spamcop.net",
													"dnsbl.sorbs.net",
													"bsb.spamlookup.net",
													"spam.dnsbl.sorbs.net",
													"b.barracudacentral.org",
													"psbl.surriel.com",
													"ix.dnsbl.manitu.net",
													"dul.dnsbl.sorbs.net",
													"t1.dnsbl.net.au",
													"sbl-xbl.spamhaus.org",
													"combined.rbl.msrbl.net"
													);

// -- Merci de bien vouloir indiquer l'indice de spammicit� que PHP Anti Spammers doit attribuer aux adresses IP SMTP distantes qui sont
// -- dans les listes noires des serveurs DNSBL/RBL.
// -- Param�tre recommand� : 50.

$PHPAntiSpammers['ConfigFiltre']['NbOfDetectInResultSP'] = 50;

/* ***************************************************************************************************** */
//Configuration de la technologie 'CRDF Analyzes Contents Message' d'analyse du contenu des messages

// -- PHPAntiSpammers doit-il analyser le contenu des messages avec la technlogie d'analyse 'CRDF Analyzes Contents Message' ?
// -- true = oui (analyse du contenu activ�)
// -- false = non (analyse du contenu d�sactiv�)

$PHPAntiSpammers['CRDFAnalyzesContentsMessage']['Enable'] = true;

// -- Activer l'analyse intelligente par les mots clefs contenus dans les r�gles de filtrage (sujets, regex, messages, ...).
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.
// -- true = filtre activ�
// -- false = filtre d�sactiv�

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['EnableAnalyzesWordsKeys'] = true;

// -- Activer l'analyse intelligente par les mots clefs contenus dans '$filtreSujetMot'.
// -- true = filtre activ�
// -- false = filtre d�sactiv�

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['filtreSujetMotEnable'] = true;

// -- Activer l'analyse intelligente par les regexs contenus dans '$filtreCorpsRegex'.
// -- true = filtre activ�
// -- false = filtre d�sactiv�

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['filtreCorpsRegexEnable'] = true;

// -- Si cette option est activ�, tous les emails qui ne contiennent aucun mot seront automatiquements consid�r�s par PHP Anti Spammers comme un
// -- courrier ind�sirable. Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.
// -- true = filtre activ�
// -- false = filtre d�sactiv�

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['EmptyMessageDetect'] = true;

/* ***************************************************************************************************** */
//Configuration du filtre de v�rification des messages et des pi�ces jointes par un anti-virus

// -- PHPAntiSpammers doit-il analyser les messages et les pi�ces jointes contenus dans l'email avec un anti-virus ?
// -- Note : si un objet malveillant est d�tect� dans l'email, il sera consid�r� comme un courrier ind�sirable.
// -- Par d�faut, nous utilisons l'anti-virus libre ClamAV. Nous vous conseillons vivement de l'utiliser.
// -- true = oui (analyse activ�)
// -- false = non (analyse d�sactiv�)

$PHPAntiSpammers['AntiVirusAnalyze']['Enable'] = true;

// -- Si l'analyse est activ�e, indiquez le chemin du binaire afin de pouvoir ex�cuter la commande d'analyse de l'anti-virus.
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.
// -- Si vous ne savez pas quoi faire, NE MODIFIEZ PAS CE PARAMETRE.
// -- Param�tre par d�faut : "/usr/bin/clamscan --no-summary -i" (nous utililons l'anti-virus libre ClamAV) (sous bash : which clamscan).

$PHPAntiSpammers['AntiVirusAnalyze']['FolderCMDName'] = "/usr/bin/clamscan --no-summary -i";

/* ***************************************************************************************************** */
//Configuration de la CRDF Blacklist Community (partage communautaire des adresses IP des spammeurs)

// -- AVERTISSEMENT : MERCI DE BIEN VOULOIR LIRE LES INFORMATIONS CI-DESSOUS :
// -- CRDF Blacklist Community est une base de donn�es communautaire contenant les adresses IP utilis�es par les spammeurs.
// -- Cette base de donn�es est constament mise � jour gr�ce � la communaut� des utilisateurs de PHP Anti Spammers.
// -- Les adresses IP des emails qui sont consid�r�s comme du spam seront automatiquement transmises aux serveurs de CRDF France.
// -- En activant cette option, je comprends et j'accepte que PHP Anti Spammers envoie des donn�es (uniquement les adresses IP) aux serveurs de CRDF France.
// -- CRDF France peut utiliser les donn�es transmises (adresses IP) dans le but des les int�gr�s aux bases anti-spam de PHP Anti Spammers.

// -- PHP Anti Spammers doit-il activer la CRDF Blacklist Community ?
// -- Une clef MAJ est indispensable pour utiliser la CRDF Blacklist Community.
// -- true = oui (CRDF Blacklist Community activ�)
// -- false = non (CRDF Blacklist Community d�sactiv�)

$PHPAntiSpammers['CRDFBlacklistCommunity']['Enable'] = true;

// -- Si la CRDF Blacklist Community est activ�, PHP Anti Spammers doit-il utiliser une connexion s�curis�e (SSL ou TLS) ?
// -- true = oui (connexion SSL/TLS activ�)
// -- false = non (connexion SSL/TLS d�sactiv�)
// -- Param�tre recommand� : true.

$PHPAntiSpammers['CRDFBlacklistCommunity']['SSLTLS'] = true;

/* ***************************************************************************************************** */
//Configuration de l'analyse des e-mails

// -- Faut-il analyser deux fois le m�me message ? Ce param�tre joue sur la stabilit� et l'optimisation de l'application.
// -- true = oui
// -- false = non (fortement recommand� pour une optimasation de l'application)

$PHPAntiSpammers['ConfigAnalyse']['TooManyAnalEmail'] = false;

/* ***************************************************************************************************** */
//Configuration des listes blanches pour emp�cher l'ex�cution de l'application anti-spam sur ces messages

// -- Les emails re�us par ces noms de domaine ne seront pas analys�s.

$PHPAntiSpammers['IgnoreDomai'] = array("crdf.fr",
										"crdf.es"
										);

// -- Liste blanche d'exp�diteurs (adresse e-mail compl�te ou nom de domaine pr�c�d� de @).

$PHPAntiSpammers['WhiteLi'] = array("clients@crdf.fr",
									"abuse@crdf.fr"
									);

/* ***************************************************************************************************** */

?>