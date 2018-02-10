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
 * @version 3.0.1
 */

// ///////////////////////////////////////////////////////////////////////////////////
//			ATTENTION, MERCI DE LIRE CET AVERTISSEMENT DANS SON INTEGRALITE.
//			SI VOUS NE SAVEZ PAS CE QUE VOUS FAITES, NE MODIFIEZ PAS CES DONNEES.
// ///////////////////////////////////////////////////////////////////////////////////
// Ce fichier contient toute l'application et le système de test de chacun des
// filtres. Soyez vigilant !
// ///////////////////////////////////////////////////////////////////////////////////

/* ***************************************************************************************************** */
//Inclusion des fichiers permettant le lancement de l'application et l'initialisation des filtres

require_once(dirname(__FILE__) . '/core/config.PHPAntiSpammers.php');
require_once(dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php');
require_once(dirname(__FILE__) . '/core/filter.personnal.PHPAntiSpammers.php');
require_once(dirname(__FILE__) . '/core/functions.PHPAntiSpammers.php');

/* ***************************************************************************************************** */
//Test des informations fournies par l'utilisateur de l'application

if(empty($PHPAntiSpammers['ServerAdress']) || empty($PHPAntiSpammers['ServerPort']) || empty($PHPAntiSpammers['EmailUser']) || empty($PHPAntiSpammers['ServerUser']) || empty($PHPAntiSpammers['ServerPassword']))
{
	trigger_error("Les variables contenues dans le fichier de configuration de l'application ne peuvent pas être vides.");
} else
{
	if(!checkEmail($PHPAntiSpammers['EmailUser']))
	{
		trigger_error("L'adresse e-mail fournie dans le fichier de configuration de l'application n'est pas correcte.");
	}
}

/* ***************************************************************************************************** */
//Test que les modules PHP sont présents pour exécuter l'application

if(!function_exists('imap_open'))
{
	trigger_error("Module PHP manquant : PHP-IMAP. Pour exécuter PHP Anti Spammers, merci de bien vouloir installer ce module et de réessayer.");
}

/* ***************************************************************************************************** */
//Sélectionne les paramètres de configuration selon le fichier de configuration

if($PHPAntiSpammers['ServerUseSSLProtocol'] === true)
{
	$VarCfg['ServerUseSSLProtocol'] = "/ssl/novalidate-cert";
} else
{
	$VarCfg['ServerUseSSLProtocol'] = "/notls";
}

/* ***************************************************************************************************** */
//Connexion au serveur POP3 ou IMAP (selon la configuration)

$StreamPHPAntiSpammers = imap_open("{".$PHPAntiSpammers['ServerAdress'].":".$PHPAntiSpammers['ServerPort']."/".$PHPAntiSpammers['ServerProtocol']."".$VarCfg['ServerUseSSLProtocol']."}INBOX", $PHPAntiSpammers['ServerUser'], $PHPAntiSpammers['ServerPassword']) or trigger_error(imap_last_error());

/* ***************************************************************************************************** */
//Exécution des commandes permettant de vérifier les emails et de renvoyer le nombre d'email(s)

$ExcuteCheck = imap_check($StreamPHPAntiSpammers) or trigger_error("Une erreur s'est produite pendant l'ouverture du socket de connexion au serveur de messagerie. Erreur renvoyée : " . imap_last_error());
$NbMessage = imap_num_msg($StreamPHPAntiSpammers) or trigger_error("Mailbox is empty. " . imap_last_error());

/* ***************************************************************************************************** */
//Traitement dans un tableau de chaque message, déclenchement de l'application

// -- Intialisation des différentes variables
$LevellSpam = 0;
$NbMsgSpam = 0;
$NomFiltreDeclencher = false;

for($UidMsg = 1 ; $UidMsg <= $NbMessage ; $UidMsg++)
{
	/* ***************************************************************************************************** */
	//Remise à zéro de certaines variables par mesure de précaution
	
	$StopAnalyseThisEmail = false;
	
	/* ***************************************************************************************************** */
	//Récupération dans une variable des données : HEADER, ENTETE, SUJET et CORPS (contenance de l'email) du message
	
	$HeaderMsg = imap_header($StreamPHPAntiSpammers, $UidMsg);
	
	$EnteteMsg = imap_fetchheader($StreamPHPAntiSpammers, $UidMsg);
	
	$SubjectMsg = fix_text($HeaderMsg->Subject);
	
	$CorpsMsg = fix_text(imap_body($StreamPHPAntiSpammers, $UidMsg));
	
	/* ***************************************************************************************************** */
	//Système d'optimisation empêchant d'analyser deux fois le même e-mail
	
	if($PHPAntiSpammers['ConfigAnalyse']['TooManyAnalEmail'] === false)
	{
		if(!file_exists(dirname(__FILE__) . '/data/stock_uid/') || !is_writeable(dirname(__FILE__) . '/data/stock_uid/'))
		{
			trigger_error("Le répertoire ".dirname(__FILE__) . '/data/stock_uid/'." n'existe pas ou n'est pas accessible en lecture et/ou écriture.");
		}
		if(file_exists(dirname(__FILE__) . "/data/stock_uid/." . imap_uid($StreamPHPAntiSpammers, $UidMsg)))
		{
			$StopAnalyseThisEmail = true;
		}
		
		$DirTimeOut = opendir(dirname(__FILE__) . '/data/stock_uid/');
		
		while ($FreadTimeOut = readdir($DirTimeOut))
		{
			if($FreadTimeOut != "." && $FreadTimeOut != "..")
			{
				if(filemtime(dirname(__FILE__) . "/data/stock_uid/" . $FreadTimeOut) + ( 3600 * 24 * 2 ) < time())
				{ 
					unlink(dirname(__FILE__) . "/data/stock_uid/" . $FreadTimeOut);
				}
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Traitement des informations dans le but d'extraire les adresses emails du message
	
	$to = $HeaderMsg->to;
	
	if(is_array($to))
	{
		foreach($to as $id => $object) {
			$ToName = $object->personal;
			$ToEmail = strtolower(trim($object->mailbox . "@" . $object->host));
		}
	}
	
	$from = $HeaderMsg->from;
	
	if(is_array($from))
	{
		 foreach($from as $id => $object) {
			$FromName = $object->personal;
			$FromEmail = strtolower(trim($object->mailbox . "@" . $object->host));
			$FromHost = trim($object->host);
		}
	}
	
	/* ***************************************************************************************************** */
	//Analyse des en-têtes du message afin de pouvoir extraire l'adresse IP exacte du serveur SMTP distant
	
	foreach(explode("\n", $EnteteMsg) as $LigneEnteteAnalyse)
	{
		if(ereg("Received: from (.*)", $LigneEnteteAnalyse))
		{
			preg_match_all("/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})/", $LigneEnteteAnalyse, $MatchesEnTeteAnalyse, PREG_SET_ORDER);
			foreach ($MatchesEnTeteAnalyse as $MatchesEnTeteValue)
			{
				$MatchesEnTeteSTLS = $MatchesEnTeteValue[0];
			}
		}
	}
	
	if(empty($MatchesEnTeteSTLS))
	{
		$NameResolveFAI = "Unknow reverse DNS.";
	} else
	{
		$NameResolveFAI = gethostbyaddr($MatchesEnTeteSTLS);
	}
	
	/* ***************************************************************************************************** */
	//Analyse et vérification de la liste blanche avant analyse de l'e-mail
	
	foreach($PHPAntiSpammers['IgnoreDomai'] as $DomainName)
	{
		if(trim($FromHost) == $DomainName)
		{
			$StopAnalyseThisEmail = true;
			break;
		}
	}
	
	foreach($PHPAntiSpammers['WhiteLi'] as $AdressEmail)
	{
		if(trim($FromHost) == $AdressEmail)
		{
			$StopAnalyseThisEmail = true;
			break;
		}
	}
	
	/* ***************************************************************************************************** */
	//Arrêt de l'analyse si la variable $StopAnalyseThisEmail = TRUE;
	
	if($StopAnalyseThisEmail != true)
	{
	
	/* ***************************************************************************************************** */
	//Application du filtre : "sujets suspects"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableSubjectSuspect'] === true)
	{
		if(in_array($SubjectMsg, $filtreSujet))
		{
			$NomFiltreDeclencher .= "Subject suspect: " . "+" . $PHPAntiSpammers['SpamRate']['SubjectSuspect'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['SubjectSuspect'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "mots suspects dans le sujet"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableMotsSubject'] === true)
	{
		foreach($filtreSujetMot as $mot)
		{
			if(eregi($mot[0], $SubjectMsg))
			{
				$NomFiltreDeclencher .= "Word suspect in the topic: " . $mot[0] . " = " . $mot[1] . ";";
				$LevellSpam += $mot[1];
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "expressions régulières à vérifier dans le sujet des mails"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableSubjectRegex'] === true)
	{
		foreach($regexSujet as $regex)
		{
			if(ereg($regex[0], $SubjectMsg))
			{
				$NomFiltreDeclencher .= "Regular expression triggered by the subject of the message: = " . $regex[1] . ";";
				$LevellSpam += $regex[1];
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "mots de l'émetteur suspect"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableNameReptEmet'] === true)
	{
		if(!empty($FromName))
		{
			foreach($filtreSujetMot as $mot)
			{
				if(eregi($mot[0], $FromName))
				{
					$NomFiltreDeclencher .= "Word suspect in the name of the issuer: " . $mot[0] . " = " . $mot[1] . ";";
					$LevellSpam += $mot[1];
				}
			}
			
			foreach($filtreCorpsRegex as $ValueRegex)
			{
				if(preg_match("/".$ValueRegex[0]."/i", $FromName))
				{
					$NomFiltreDeclencher .= "Regular expression triggered on the message sender: = " . $ValueRegex[1] . ";";
					$LevellSpam += $ValueRegex[1];
				}
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "noms de domaine ou adresses e-mail suspects (expéditeur)"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableDoaminOrEmail'] === true)
	{
		if(in_array($FromHost, $filtreExpediteur) || in_array($FromEmail, $filtreExpediteur) || !checkEmail($FromEmail))
		{
			$NomFiltreDeclencher .= "Domain name or e-mail suspect: " . "+" . $PHPAntiSpammers['SpamRate']['DoaminOrEmail'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['DoaminOrEmail'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "codes pays suspects dans le nom de domaine de l'expéditeur"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableExtDomain'] === true)
	{
		if(in_array(str_replace(".", "", strrchr($FromHost, ".")), $filtreExpTld))
		{
			$NomFiltreDeclencher .= "Country code in the domain of the sender of the email suspect: " . str_replace(".", "", strrchr($FromHost, ".")) . " = +" . $PHPAntiSpammers['SpamRate']['ExtDomain'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['ExtDomain'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "Liste des fournisseurs d'accès Internet suspects"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableFAISMTP'] === true)
	{
		$NewFaiTestName = trim(ereg_replace("^(.*)\.(.*)\.(.*)$", "\\2.\\3", $NameResolveFAI));
		
		if(in_array($NewFaiTestName, $filtreExpFAI))
		{
			$NomFiltreDeclencher .= "ISP suspect the remote SMTP server: " . $NewFaiTestName . " = +" . $PHPAntiSpammers['SpamRate']['FAISMTP'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['FAISMTP'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "Liste des adresses IP suspectes"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableIPSMTP'] === true)
	{
		foreach($filtreExpIP as $IPValue)
		{
			if(ereg("^" . str_replace(".", "\.", $IPValue), $MatchesEnTeteSTLS))
			{
				$NomFiltreDeclencher .= "Suspicious IP address of remote SMTP server: " . $IPValue . " = +" . $PHPAntiSpammers['SpamRate']['IPSMTP'] . ";";
				$LevellSpam += $PHPAntiSpammers['SpamRate']['IPSMTP'];
				break;
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "mots suspects dans le nom des fichiers (pièces jointes) (caractères alphabétiques uniquement)"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableFileName'] === true)
	{
		if(strstr($CorpsMsg, "filename=") || ereg('^(content-type:\ +[^;]+;\ +)?name="[^"]+"$', trim($CorpsMsg)))
		{
			$CorpsMsgArray = explode("\n", $CorpsMsg);
	
			foreach($CorpsMsgArray as $LigneCorpsMsg)
			{
				if(eregi("filename=", $LigneCorpsMsg))
				{
					foreach($filtreFichierMot as $mot)
					{
						if(strstr($LigneCorpsMsg, $mot))
						{
							$NomFiltreDeclencher .= "Word suspect in the name of the attachment: " . $mot . " = +" . $PHPAntiSpammers['SpamRate']['FileName'] . ";";
							$LevellSpam += $PHPAntiSpammers['SpamRate']['FileName'];
							break;
						}
					}
				}
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "extensions de noms de fichiers (pièces jointes) suspectes"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableFileExt'] === true)
	{
		if(strstr($CorpsMsg, "filename=") || ereg('^(content-type:\ +[^;]+;\ +)?name="[^"]+"$', trim($CorpsMsg)))
		{
			$CorpsMsgArray = explode("\n", $CorpsMsg);
	
			foreach($CorpsMsgArray as $LigneCorpsMsg)
			{
				if(eregi("filename=", $LigneCorpsMsg))
				{
					foreach($filtreFichierExt as $mot)
					{
						$TldFilePiS = strrchr($LigneCorpsMsg, ".");
						$TldFilePiS = str_replace('"', "", $TldFilePiS);
						$TldFilePiS = trim(str_replace(".", "", $TldFilePiS));
					
						if(eregi($TldFilePiS, $mot))
						{
							$NomFiltreDeclencher .= "Name extension suspicious file attachment: " . $mot . " = +" . $PHPAntiSpammers['SpamRate']['FileExt'] . ";";
							$LevellSpam += $PHPAntiSpammers['SpamRate']['FileExt'];
							break;
						}
					}
				}
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "vérification des messages automatiques"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableMsgAuto'] === true)
	{
		if(!$EnteteMsg && (ereg("^auto-submitted:", $EnteteMsg) || strstr($EnteteMsg, "x-responder") || strstr($EnteteMsg, "autorespond")))
		{
			$NomFiltreDeclencher .= "Message auto-responder: = +" . $PHPAntiSpammers['SpamRate']['MsgAuto'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['MsgAuto'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "vérification de la validité de la date"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableValdDate'] === true)
	{
		if((strtotime($HeaderMsg->Date) - 900) > time())
		{
			$NomFiltreDeclencher .= "E-mail Invalid date (timestamp): = +" . $PHPAntiSpammers['SpamRate']['ValdDate'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['ValdDate'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "vérification de l'expéditeur du message"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableWhoExp'] === true)
	{
		if($FromEmail == $PHPAntiSpammers['EmailUser'])
		{
			$NomFiltreDeclencher .= "An email can not come to '".$PHPAntiSpammers['EmailUser']."': = +" . $PHPAntiSpammers['SpamRate']['WhoExp'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['WhoExp'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "vérification de la validité domaine de l'expéditeur du message"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableDomainTest'] === true)
	{
		if(!checkDomain($FromHost))
		{
			$NomFiltreDeclencher .= "Format name of the sender's domain invalid: = +" . $PHPAntiSpammers['SpamRate']['DomainTest'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['DomainTest'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "recherche dans les RBL List (liste noire communautaire)"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableRBL'] === true)
	{
		if(empty($PHPAntiSpammers['ConfigFiltre']['NbOfDetectInResultSP']) || !eregi("^[0-9z]*$", $PHPAntiSpammers['ConfigFiltre']['NbOfDetectInResultSP']))
		{
			trigger_error("L'indice de spammicité saisi dans le fichier de configuration de l'application pour les serveurs DNSBL/RBL est incorrect.");
		}
		
		if(empty($PHPAntiSpammers['ConfigFiltre']['ListRBL']))
		{
			trigger_error("La liste des serveurs RBL ne peut pas être vide si cette option de filtrage est activée.");
		}
		if(!empty($MatchesEnTeteSTLS))
		{			
			foreach ($PHPAntiSpammers['ConfigFiltre']['ListRBL'] as $ServerRBL)
			{
				$LookupRBLIP = implode(".", array_reverse(explode(".", $MatchesEnTeteSTLS))) . "." . $ServerRBL;
				$DoLookup = gethostbyname($LookupRBLIP);
			
				if(preg_match("/127.0.0.?/", $DoLookup))
				{
					$NomFiltreDeclencher .= "The IP address of remote SMTP server in the server blacklist RBL: " . $ServerRBL . " = +" . $PHPAntiSpammers['ConfigFiltre']['NbOfDetectInResultSP'] . ";";
					$LevellSpam += $PHPAntiSpammers['ConfigFiltre']['NbOfDetectInResultSP'];
				}
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "empêcher les pièces jointes dans les e-mails"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableAttachmentNotAuth'] === true)
	{
		if(strstr($CorpsMsg, "filename=") || ereg('^(content-type:\ +[^;]+;\ +)?name="[^"]+"$', trim($CorpsMsg)))
		{
			$NomFiltreDeclencher .= "Attachments are not accepted on this message: = +" . $PHPAntiSpammers['SpamRate']['AttachmentNotAuth'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['AttachmentNotAuth'];
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "vérifier que le serveur distant puisse recevoir des emails"
	
	if($PHPAntiSpammers['ConfigFiltre']['EnableVefServerReceiveEmail'] === true)
	{
		error_reporting(0);
		
		if(!$fp = fsockopen($MatchesEnTeteSTLS, 110, $errno, $errstr, 10))
		{
			$NomFiltreDeclencher .= "The remote server can not receive email on port 110: = +" . $PHPAntiSpammers['SpamRate']['VefServerReceiveEmail'] . ";";
			$LevellSpam += $PHPAntiSpammers['SpamRate']['VefServerReceiveEmail'];
		}
		
		fclose($fp);
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "analyse du contenu du message avec la technologie 'CRDF Analyzes Contents Message'"
	
	if($PHPAntiSpammers['CRDFAnalyzesContentsMessage']['Enable'] === true)
	{
		if($PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['EnableAnalyzesWordsKeys'] === true)
		{
			$CACM__GLOBAL__INIT = 0;
			
			if($PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['filtreSujetMotEnable'] === true)
			{
				foreach($filtreSujetMot as $ValueWords)
				{
					if(eregi($ValueWords[0], $CorpsMsg))
					{
						$CamGlobalCRDFTechnologySaveInfo[] = $ValueWords[0] . "=" . $ValueWords[1];
						
						$CACM__GLOBAL__INIT++;
						$LevellSpam += $ValueWords[1];
					}
				}
			}
			
			if($PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['filtreCorpsRegexEnable'] === true)
			{
				if(is_array($filtreCorpsRegex))
				{
					foreach($filtreCorpsRegex as $ValueRegex)
					{
						if(preg_match("/".$ValueRegex[0]."/i", $CorpsMsg))
						{
							$CamGlobalCRDFTechnologySaveInfo[] = "Regular expression" . "=" . $ValueRegex[1];
						
							$CACM__GLOBAL__INIT++;
							$LevellSpam += $ValueRegex[1];
						}
					}
				}
			}
			
			if($CACM__GLOBAL__INIT > 0)
			{
				foreach ($CamGlobalCRDFTechnologySaveInfo as $LineGlobalTechOL)
				{
					$LineGlobalTechOL__INFOSOX .= $LineGlobalTechOL . ", ";
				}
				
				$NomFiltreDeclencher .= "CRDF Analyzes Contents Message : " . $LineGlobalTechOL__INFOSOX . ";";
			}
		}
		
		if($PHPAntiSpammers['CRDFAnalyzesContentsMessageFN']['EmptyMessageDetect'] === true)
		{
			if(count(explode(" ", $CorpsMsg)) == 0)
			{
				$NomFiltreDeclencher .= "CRDF Analyzes Contents Message : the message body of the email contains no word: = +10000";
				$LevellSpam += 10000;
			}
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "analyse du message et des pièces jointes par un anti-virus"
	
	if($PHPAntiSpammers['AntiVirusAnalyze']['Enable'] === true)
	{
		if(!file_exists(dirname(__FILE__) . '/data/stock_uid_msg/') || !is_writeable(dirname(__FILE__) . '/data/stock_uid_msg/'))
		{
			trigger_error("Le répertoire ".dirname(__FILE__) . '/data/stock_uid_msg/'." n'existe pas ou n'est pas accessible en lecture et/ou écriture.");
		}
		if(strstr($CorpsMsg, "filename=") || ereg('^(content-type:\ +[^;]+;\ +)?name="[^"]+"$', trim($CorpsMsg)))
		{				
			$SaveTempEmail = fopen(dirname(__FILE__) . "/data/stock_uid_msg/." . imap_uid($StreamPHPAntiSpammers, $UidMsg), "w");
			fputs($SaveTempEmail, $EnteteMsg . $CorpsMsg);
			fclose($SaveTempEmail);
			
			$CommandAntiVirusLaunchScan = shell_exec($PHPAntiSpammers['AntiVirusAnalyze']['FolderCMDName'] . " " . dirname(__FILE__) . "/data/stock_uid_msg/." . imap_uid($StreamPHPAntiSpammers, $UidMsg));
			
			if(!empty($CommandAntiVirusLaunchScan))
			{
				preg_match("/: (.*) FOUND/", trim($CommandAntiVirusLaunchScan), $ViewLineAntiVirus);
				
				$NomFiltreDeclencher .= "The message contains one or more malicious objects (ClamAV Antivirus : Object detected ".$ViewLineAntiVirus[1]."): = +10000" . ";";;
				$LevellSpam += 10000;
			}
			
			unlink(dirname(__FILE__) . "/data/stock_uid_msg/." . imap_uid($StreamPHPAntiSpammers, $UidMsg));
		}
	}
	
	/* ***************************************************************************************************** */
	//Application du filtre : "CRDF Blacklist Community (partage communautaire des adresses IP des spammeurs)"
	
	if($PHPAntiSpammers['CRDFBlacklistCommunity']['Enable'] === true)
	{
		if(empty($PHPAntiSpammers['KeyMAJ']))
		{
			trigger_error("Une clef MAJ doit être entrée dans le fichier de configuration de l'application pour pouvoir utiliser la CRDF Blacklist Community.");
		}
		
		if($LevellSpam >= 1)
		{
			if($PHPAntiSpammers['CRDFBlacklistCommunity']['SSLTLS'] === true)
			{
				$CRDFBlackListParamSSL = "https";
			} else
			{
				$CRDFBlackListParamSSL = "http";
			}
			
			file_get_contents($CRDFBlackListParamSSL . "://phpantispammers.crdf.fr/update/CRDFBlackListCommunity.php" . "?KEY=" . $PHPAntiSpammers['KeyMAJ'] . "&IP=" . $MatchesEnTeteSTLS);
		}
	}
	
	/* ***************************************************************************************************** */
	//Action à exécuter lors de la détection d'un SPAM
	
	if($LevellSpam > 0)
	{
		if($PHPAntiSpammers['ActionDetectSpam'] == "move")
		{
			if(empty($PHPAntiSpammers['SpamDetectFolderMove']))
			{
				trigger_error("Veuillez indiquer dans le fichier de configuration le dossier où déplacer les SPAM détectés.");
			}
			
			$InfoTraitMsg = "Le message a été déplacé dans le dossier '".$PHPAntiSpammers['SpamDetectFolderMove']."' du serveur de messagerie.";
			
			imap_mail_move($StreamPHPAntiSpammers, $UidMsg, $PHPAntiSpammers['SpamDetectFolderMove']) or trigger_error("Le déplacement du message '$UidMsg' est impossible. Merci de bien vouloir vérifier que le nom du dossier existe bien. " . imap_last_error() );
		}
		
		if($PHPAntiSpammers['ActionDetectSpam'] == "delete")
		{
			$InfoTraitMsg = "Le message a été supprimé du serveur de messagerie.";
			
			imap_delete($StreamPHPAntiSpammers, $UidMsg);
		}
		
		$NbMsgSpam++;
		
		if($PHPAntiSpammers['SpamDetectSendEmail'] === true)
		{
			require_once(dirname(__FILE__) . '/core/email_answer.PHPAntiSpammers.php');
		}
	}
	
	/* ***************************************************************************************************** */
	//Système d'optimisation empêchant d'analyser deux fois le même e-mail
	
	if($PHPAntiSpammers['ConfigAnalyse']['TooManyAnalEmail'] === false)
	{
		if(!file_exists(dirname(__FILE__) . "/data/stock_uid/." . imap_uid($StreamPHPAntiSpammers, $UidMsg)))
		{
			$CreateFile = fopen(dirname(__FILE__) . "/data/stock_uid/." . imap_uid($StreamPHPAntiSpammers, $UidMsg), "w");
			fputs($CreateFile, 1);
			fclose($CreateFile);
		}
		if($LevellSpam > 0)
		{
			unlink(dirname(__FILE__) . "/data/stock_uid/." . imap_uid($StreamPHPAntiSpammers, $UidMsg));
		}
	}
	
	/* ***************************************************************************************************** */
	//Destruction des différentres variables par mesure de précaution
	
	unset($HeaderMsg, $EnteteMsg, $SubjectMsg, $CorpsMsg, $NomFiltreDeclencher, $LevellSpam, $MatchesEnTeteSTLS, $LigneEnteteAnalyse, $NameResolveFAI, $NbResultOfRBS, $NameResultOfRBS, $StopAnalyseThisEmail, $CamGlobalCRDFTechnologySaveInfo, $LineGlobalTechOL__INFOSOX);
	
	/* ***************************************************************************************************** */
	//Fermeture de la boucle d'arrêt d'analyse
	
	}
	
	/* ***************************************************************************************************** */
}

/* ***************************************************************************************************** */
//Exécute une commande de fin pour effectuer les différentes modifications

if(!empty($PHPAntiSpammers['ActionDetectSpam']) && $NbMsgSpam > 0)
{
	imap_expunge($StreamPHPAntiSpammers);
}

/* ***************************************************************************************************** */
//Fermeture de la connexion au serveur de messagerie

imap_close($StreamPHPAntiSpammers) or trigger_error(imap_last_error());

/* ***************************************************************************************************** */

?>