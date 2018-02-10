<?php

////////////////////////////////////////
// Encodage du fichier : UTF-8
// Utilisation des tabulations : Oui
// 1 tabulation = 4 caractères
// Fins de lignes = LF (Unix)
////////////////////////////////////////

///////////////////////////////
// LICENCE
/////////////////////////////// 
// 
// PHPAntiSpammers is a PHP program with which you can publish any project
// or sources files of any type supported you want.
//
// International Copyright © 2000 - 2010 CRDF All Rights Reserved.
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
//Configuration générale de l'application "PHPAntiSpammers"

// -- Adresse du serveur de messagerie (par exemple : imap.domaine.tld)

$PHPAntiSpammers['ServerAdress'] = "imap.domaine.tld";

// -- Protocole utilisé pour la connexion au serveur de messagerie (par exemple : imap ou pop3)

$PHPAntiSpammers['ServerProtocol'] = "imap";

// -- Port du serveur de messagerie (par exemple : 993)

$PHPAntiSpammers['ServerPort'] = 993;

// -- La connexion au serveur de messagerie utilise-t-elle une connexion sécurisée ? Vous pouvez utiliser le protocole SSL et TLS.
// -- true = oui
// -- false = non

$PHPAntiSpammers['ServerUseSSLProtocol'] = true;

// -- Adresse email du compte à vérifier (par exemple : email@domaine.tld)

$PHPAntiSpammers['EmailUser'] = "email@domaine.tld";

// -- Nom d'utilisateur pour connexion au serveur de messagerie (par exemple : email@domaine.tld)

$PHPAntiSpammers['ServerUser'] = "email@domaine.tld";

// -- Mot de passe pour connexion au serveur de messagerie

$PHPAntiSpammers['ServerPassword'] = "";

// -- Décalage horaire par défaut de toutes les fonctions date/heure
// -- Fuseaux horaires supportés : http://fr3.php.net/manual/fr/timezones.php

date_default_timezone_set("Europe/Paris");

// -- Clef MAJ des mises à jour.
// -- Afin de pouvoir obtenir les dernières mises à jour des bases anti-spam de PHP Anti Spammers.
// -- Vous devez obtenir une clef MAJ (entièrement gratuit, rendez-vous sur www.crdf.fr) et l'entrer ci-dessous afin de pouvoir obtenir ces mises à jour.
// -- Conseil : Sans les mises à jour de bases anti-spam, il ne sera plus réellement très efficace ;).

$PHPAntiSpammers['KeyMAJ'] = "enteryourmajkeyhere";

// -- Définition de la version de l'application PHP Anti Spammers.
// -- Cette constante permet simplement d'indiquer au service de mise à jour la version de l'application.
// -- Merci de bien vouloir ne pas modifier ce paramètre afin de pouvoir vous prévenir en cas de mise à jour de PHP Anti Spammers

$PHPAntiSpammers['__PHPAntiSpammers_Version_Core__'] = "3.0.2";

/* ***************************************************************************************************** */
//Configuration des actions à exécuter lors de la détection d'un SPAM par PHPAntiSpammers

// -- Que faire lors de la détection d'un spam par PHPAntiSpammers ?

// -- move = déplacer le message dans le dossier de votre choix (recommandé)
// -- delete = supprimer le message
// -- ignore = ignorer (il ne sert à rien alors d'installer PHPAntiSpammers ;) !)

$PHPAntiSpammers['ActionDetectSpam'] = "move";

// -- Si vous avez choisi l'option "move" ci-dessus, vous devez mettre le dossier ou déplacer les SPAM détectés par PHPAntiSpammers
// -- Note : Merci de bien vouloir consulter votre messagerie pour créer des dossiers et vérifier que le dossier existe.
// -- Par exemple : 'INBOX.Spam' car dossier principal 'INBOX'. 'Spam' est un sous-dossier à 'INBOX'.

$PHPAntiSpammers['SpamDetectFolderMove'] = "INBOX.Spam";

// -- Envoyer un e-mail à l'envoyeur pour le prévenir que son message a été considéré comme un SPAM
// -- Note : si vous activez cette option, vous pouvez modifier l'e-mail envoyé dans le fichier 'core/email_answer.PHPAntiSpammers.php'.
// -- true = oui
// -- false = non

$PHPAntiSpammers['SpamDetectSendEmail'] = true;

/* ***************************************************************************************************** */
//Configuration des filtres anti-spam de l'application
// -- true = filtre activé
// -- false = filtre désactivé

// -- Activation du filtre : "sujets suspects"

$PHPAntiSpammers['ConfigFiltre']['EnableSubjectSuspect'] = true;

// -- Activation du filtre : "mots suspects dans le sujet"

$PHPAntiSpammers['ConfigFiltre']['EnableMotsSubject'] = true;

// -- Activation du filtre : "expressions régulières à vérifier dans le sujet des mails"

$PHPAntiSpammers['ConfigFiltre']['EnableSubjectRegex'] = true;

// -- Activation du filtre : "mots de l'émetteur suspect"

$PHPAntiSpammers['ConfigFiltre']['EnableNameReptEmet'] = true;

// -- Activation du filtre : "noms de domaine ou adresses e-mail suspects (expéditeur)"

$PHPAntiSpammers['ConfigFiltre']['EnableDoaminOrEmail'] = true;

// -- Activation du filtre : "codes pays suspects dans le nom de domaine de l'expéditeur"

$PHPAntiSpammers['ConfigFiltre']['EnableExtDomain'] = true;

// -- Activation du filtre : "Liste des fournisseurs d'accès Internet suspects"

$PHPAntiSpammers['ConfigFiltre']['EnableFAISMTP'] = true;

// -- Activation du filtre : "Liste des adresses IP suspectes"

$PHPAntiSpammers['ConfigFiltre']['EnableIPSMTP'] = true;

// -- Activation du filtre : "mots suspects dans le nom des fichiers (pièces jointes)"

$PHPAntiSpammers['ConfigFiltre']['EnableFileName'] = true;

// -- Activation du filtre : "extensions de noms de fichiers (pièces jointes) suspectes"

$PHPAntiSpammers['ConfigFiltre']['EnableFileExt'] = true;

// -- Activation du filtre : "vérification des messages automatiques"

$PHPAntiSpammers['ConfigFiltre']['EnableMsgAuto'] = true;

// -- Activation du filtre : "vérification de la validité de la date"

$PHPAntiSpammers['ConfigFiltre']['EnableValdDate'] = true;

// -- Activation du filtre : "vérification de l'expéditeur du message"
// -- Explication : votre adresse de messagerie est 'email@domaine.tld'. Si le spammeur envoie un e-mail avec l'adresse e-mail 'email@domaine.tld'.
// -- alors celui-ci activera ce filtre et le message sera considéré comme un SPAM.
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.

$PHPAntiSpammers['ConfigFiltre']['EnableWhoExp'] = true;

// -- Activation du filtre : "vérification de la validité domaine de l'expéditeur du message"

$PHPAntiSpammers['ConfigFiltre']['EnableDomainTest'] = true;

// -- Activer la vérification par les serveurs RBL (serveur de liste noire communautaire)
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.

$PHPAntiSpammers['ConfigFiltre']['EnableRBL'] = true;

// -- Activation du filtre : "empêcher les pièces jointes dans les e-mails"

$PHPAntiSpammers['ConfigFiltre']['EnableAttachmentNotAuth'] = false;

// -- Activation du filtre : "vérifier que le serveur distant puisse recevoir des emails"

$PHPAntiSpammers['ConfigFiltre']['EnableVefServerReceiveEmail'] = false;

/* ***************************************************************************************************** */
//Configuration des indices de spammicité pour chacun des filtres

// -- La configuration de spmmacité de chaque filtres vous permet de jouer sur la sévérité des différents filtres.
// -- Ceci permet de jouer sur la sévérité de l'analyse par PHP Anti Spammers.
// -- Plus d'indice de spammicité est élevé, plus la probabilité que l'email soit un spam est élevé.

// -- //// ATTENTION ////
// -- La configuration des indices de spammicité est réservée aux experts. La modification par un novice de ces différents paramètres peut
// -- jouer sur le taux de détection des spams par PHP Anti Spammers.

// -- Indice de spammicité du filtre : "sujets suspects"
// -- Paramètre recommandé : 100.

$PHPAntiSpammers['SpamRate']['SubjectSuspect'] = 100;

// -- Indice de spammicité du filtre : "noms de domaine ou adresses e-mail suspects (expéditeur)"
// -- Paramètre recommandé : 500.

$PHPAntiSpammers['SpamRate']['DoaminOrEmail'] = 500;

// -- Indice de spammicité du filtre : "codes pays suspects dans le nom de domaine de l'expéditeur"
// -- Paramètre recommandé : 200.

$PHPAntiSpammers['SpamRate']['ExtDomain'] = 200;

// -- Indice de spammicité du filtre : "Liste des fournisseurs d'accès Internet suspects"
// -- Paramètre recommandé : 800.

$PHPAntiSpammers['SpamRate']['FAISMTP'] = 800;

// -- Indice de spammicité du filtre : "Liste des adresses IP suspectes"
// -- Paramètre recommandé : 800.

$PHPAntiSpammers['SpamRate']['IPSMTP'] = 800;

// -- Indice de spammicité du filtre : "mots suspects dans le nom des fichiers (pièces jointes)"
// -- Paramètre recommandé : 200.

$PHPAntiSpammers['SpamRate']['FileName'] = 200;

// -- Indice de spammicité du filtre : "extensions de noms de fichiers (pièces jointes) suspectes"
// -- Paramètre recommandé : 200.

$PHPAntiSpammers['SpamRate']['FileExt'] = 200;

// -- Indice de spammicité du filtre : "vérification des messages automatiques"
// -- Paramètre recommandé : 800.

$PHPAntiSpammers['SpamRate']['MsgAuto'] = 800;

// -- Indice de spammicité du filtre : "vérification de la validité de la date"
// -- Paramètre recommandé : 800.

$PHPAntiSpammers['SpamRate']['ValdDate'] = 800;

// -- Indice de spammicité du filtre : "vérification de l'expéditeur du message"
// -- Paramètre recommandé : 400.

$PHPAntiSpammers['SpamRate']['WhoExp'] = 400;

// -- Indice de spammicité du filtre : "vérification de la validité domaine de l'expéditeur du message"
// -- Paramètre recommandé : 400.

$PHPAntiSpammers['SpamRate']['DomainTest'] = 400;

// -- Indice de spammicité du filtre : "empêcher les pièces jointes dans les e-mails"
// -- Paramètre recommandé : 1000.

$PHPAntiSpammers['SpamRate']['AttachmentNotAuth'] = 1000;

// -- Indice de spammicité du filtre : "vérifier que le serveur distant puisse recevoir des emails"
// -- Paramètre recommandé : 400.

$PHPAntiSpammers['SpamRate']['VefServerReceiveEmail'] = 400;

/* ***************************************************************************************************** */
//Configuration du filtre de vérification des serveurs RBL

// -- La variable $PHPAntiSpammers['ConfigFiltre']['EnableRBL'] doit être sur TRUE pour pouvoir utiliser ces serveurs.
// -- Note : Les serveurs qui sont configurés par défaut sont les plus connus et donc les plus fiables.
// -- Merci de bien vouloir faire ATTENTION aux serveurs que vous avez ajoutés.

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

// -- Merci de bien vouloir indiquer l'indice de spammicité que PHP Anti Spammers doit attribuer aux adresses IP SMTP distantes qui sont
// -- dans les listes noires des serveurs DNSBL/RBL.
// -- Paramètre recommandé : 50.

$PHPAntiSpammers['ConfigFiltre']['NbOfDetectInResultSP'] = 50;

/* ***************************************************************************************************** */
//Configuration de la technologie 'CRDF Analyzes Contents Message' d'analyse du contenu des messages

// -- PHPAntiSpammers doit-il analyser le contenu des messages avec la technlogie d'analyse 'CRDF Analyzes Contents Message' ?
// -- true = oui (analyse du contenu activé)
// -- false = non (analyse du contenu désactivé)

$PHPAntiSpammers['CRDFAnalyzesContentsMessage']['Enable'] = true;

// -- Activer l'analyse intelligente par les mots clefs contenus dans les règles de filtrage (sujets, regex, messages, ...).
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.
// -- true = filtre activé
// -- false = filtre désactivé

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['EnableAnalyzesWordsKeys'] = true;

// -- Activer l'analyse intelligente par les mots clefs contenus dans '$filtreSujetMot'.
// -- true = filtre activé
// -- false = filtre désactivé

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['filtreSujetMotEnable'] = true;

// -- Activer l'analyse intelligente par les regexs contenus dans '$filtreCorpsRegex'.
// -- true = filtre activé
// -- false = filtre désactivé

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['filtreCorpsRegexEnable'] = true;

// -- Si cette option est activé, tous les emails qui ne contiennent aucun mot seront automatiquements considérés par PHP Anti Spammers comme un
// -- courrier indésirable. Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.
// -- true = filtre activé
// -- false = filtre désactivé

$PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['EmptyMessageDetect'] = true;

/* ***************************************************************************************************** */
//Configuration du filtre de vérification des messages et des pièces jointes par un anti-virus

// -- PHPAntiSpammers doit-il analyser les messages et les pièces jointes contenus dans l'email avec un anti-virus ?
// -- Note : si un objet malveillant est détecté dans l'email, il sera considéré comme un courrier indésirable.
// -- Par défaut, nous utilisons l'anti-virus libre ClamAV. Nous vous conseillons vivement de l'utiliser.
// -- true = oui (analyse activé)
// -- false = non (analyse désactivé)

$PHPAntiSpammers['AntiVirusAnalyze']['Enable'] = true;

// -- Si l'analyse est activée, indiquez le chemin du binaire afin de pouvoir exécuter la commande d'analyse de l'anti-virus.
// -- Pour plus d'informations, merci de bien vouloir consulter la documentation de PHPAntiSpammers.
// -- Si vous ne savez pas quoi faire, NE MODIFIEZ PAS CE PARAMETRE.
// -- Paramètre par défaut : "/usr/bin/clamscan --no-summary -i" (nous utililons l'anti-virus libre ClamAV) (sous bash : which clamscan).

$PHPAntiSpammers['AntiVirusAnalyze']['FolderCMDName'] = "/usr/bin/clamscan --no-summary -i";

/* ***************************************************************************************************** */
//Configuration de la CRDF Blacklist Community (partage communautaire des adresses IP des spammeurs)

// -- AVERTISSEMENT : MERCI DE BIEN VOULOIR LIRE LES INFORMATIONS CI-DESSOUS :
// -- CRDF Blacklist Community est une base de données communautaire contenant les adresses IP utilisées par les spammeurs.
// -- Cette base de données est constament mise à jour grâce à la communauté des utilisateurs de PHP Anti Spammers.
// -- Les adresses IP des emails qui sont considérés comme du spam seront automatiquement transmises aux serveurs de CRDF France.
// -- En activant cette option, je comprends et j'accepte que PHP Anti Spammers envoie des données (uniquement les adresses IP) aux serveurs de CRDF France.
// -- CRDF France peut utiliser les données transmises (adresses IP) dans le but des les intégrés aux bases anti-spam de PHP Anti Spammers.

// -- PHP Anti Spammers doit-il activer la CRDF Blacklist Community ?
// -- Une clef MAJ est indispensable pour utiliser la CRDF Blacklist Community.
// -- true = oui (CRDF Blacklist Community activé)
// -- false = non (CRDF Blacklist Community désactivé)

$PHPAntiSpammers['CRDFBlacklistCommunity']['Enable'] = true;

// -- Si la CRDF Blacklist Community est activé, PHP Anti Spammers doit-il utiliser une connexion sécurisée (SSL ou TLS) ?
// -- true = oui (connexion SSL/TLS activé)
// -- false = non (connexion SSL/TLS désactivé)
// -- Paramètre recommandé : true.

$PHPAntiSpammers['CRDFBlacklistCommunity']['SSLTLS'] = true;

/* ***************************************************************************************************** */
//Configuration de l'analyse des e-mails

// -- Faut-il analyser deux fois le même message ? Ce paramètre joue sur la stabilité et l'optimisation de l'application.
// -- true = oui
// -- false = non (fortement recommandé pour une optimasation de l'application)

$PHPAntiSpammers['ConfigAnalyse']['TooManyAnalEmail'] = false;

/* ***************************************************************************************************** */
//Configuration des listes blanches pour empêcher l'exécution de l'application anti-spam sur ces messages

// -- Les emails reçus par ces noms de domaine ne seront pas analysés.

$PHPAntiSpammers['IgnoreDomai'] = array("crdf.fr",
										"crdf.es"
										);

// -- Liste blanche d'expéditeurs (adresse e-mail complète ou nom de domaine précédé de @).

$PHPAntiSpammers['WhiteLi'] = array("clients@crdf.fr",
									"abuse@crdf.fr"
									);

/* ***************************************************************************************************** */

?>