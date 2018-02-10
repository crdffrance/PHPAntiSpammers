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
//			ATTENTION, MERCI DE LIRE CET AVERTISSEMENT DANS SON INTEGRALITE.
//			SI VOUS NE SAVEZ PAS CE QUE VOUS FAITES, NE MODIFIEZ PAS CES DONNEES.
// ///////////////////////////////////////////////////////////////////////////////////
// Ce fichier contient le service de mise � jour du filtre anti-spam
// de l'application.
// ///////////////////////////////////////////////////////////////////////////////////

/* ***************************************************************************************************** */
//Inclusion des fichiers permettant le lancement de l'application et l'initialisation des filtres

require_once(dirname(__FILE__) . '/core/config.PHPAntiSpammers.php');
require_once(dirname(__FILE__) . '/core/functions.PHPAntiSpammers.php');

/* ***************************************************************************************************** */
//Affichage des cr�dits pour le d�marrage du service Updater de PHP Anti Spammers

WriteLogConsole(0, "=====================================================================");
WriteLogConsole(0, "PHP Anti Spammers Service Updater v3.0 - Update PHP Anti Spammers");
WriteLogConsole(0, "Boot with key MAJ: ".$PHPAntiSpammers['KeyMAJ'].".");
WriteLogConsole(0, "International Copyright � 2000 - 2009 CRDF All Rights Reserved.");
WriteLogConsole(0, "=====================================================================");
WriteLogConsole(0, "\n");

/* ***************************************************************************************************** */
//V�rification des diff�rents param�tres contenus dans le fichier de configuration de l'application

if(empty($PHPAntiSpammers['KeyMAJ']) || empty($PHPAntiSpammers['__PHPAntiSpammers_Version_Core__']))
{
	WriteLogConsole(1, "Les variables contenues dans le fichier de configuration de l'application ne peuvent pas �tre vides.");
	exit;
}

/* ***************************************************************************************************** */
//Affichage du message de connexion au serveur de PHP Anti Spammers

WriteLogConsole(1, "Connexion au serveur de mise � jour de PHP Anti Spammers. Veuillez patienter...");

/* ***************************************************************************************************** */
//R�cup�ration du code de la derni�re version disponible de l'application PHP Anti Spammers

$CRDFServer['PHPAntiSpammersBuild'] = file_get_contents("http://phpantispammers.crdf.fr/update/V.GLOBAL.php?VERSION=" . $PHPAntiSpammers['__PHPAntiSpammers_Version_Core__'] . "&KEY=" . $PHPAntiSpammers['KeyMAJ']);

if($CRDFServer['PHPAntiSpammersBuild'] === false)
{
	WriteLogConsole(1, "Une erreur inconnue s'est produite pendant la connexion au serveur de PHP Anti Spammers. Merci de bien vouloir v�rifier votre connexion et/ou consulez l'erreur renvoy�e par le CRDF Core.");
} else
{
	$__PHPANTISPAMMERS__GLOBAL__VERSION__ARRAY__ = explode("\n", $CRDFServer['PHPAntiSpammersBuild']);
	
	if(eregi("OK", $CRDFServer['PHPAntiSpammersBuild']))
	{
		WriteLogConsole(1, "PHP Anti Spammers v".$PHPAntiSpammers['__PHPAntiSpammers_Version_Core__']." est bien � jour.");
		WriteLogConsole(0, $__PHPANTISPAMMERS__GLOBAL__VERSION__ARRAY__[1]);
	}
	
	if(eregi("UPDATE", $CRDFServer['PHPAntiSpammersBuild']))
	{
		WriteLogConsole(1, "PHP Anti Spammers v".$PHPAntiSpammers['__PHPAntiSpammers_Version_Core__']." n'est plus � jour. Une nouvelle version de l'application a �t� trouv�e. Merci de bien vouloir consulter le site Web de CRDF afin de pouvoir mettre � jour PHP Anti Spammers vers cette nouvelle version.");
		WriteLogConsole(0, $__PHPANTISPAMMERS__GLOBAL__VERSION__ARRAY__[1]);
	}
	
	if(eregi("ERROR", $CRDFServer['PHPAntiSpammersBuild']))
	{
		WriteLogConsole(1, "Une erreur s'est produite car le site Web a renvoy�e un code d'erreur, veuillez consulter l'erreur renvoy�e par le serveur de mise � jour.");
		WriteLogConsole(0, "Erreur renvoy�e : " . $__PHPANTISPAMMERS__GLOBAL__VERSION__ARRAY__[1]);
	}
}

/* ***************************************************************************************************** */
//Affichage du message de connexion au serveur de PHP Anti Spammers

WriteLogConsole(1, "Connexion au serveur de mise � jour de PHP Anti Spammers pour la v�rification des bases anti-spam. Veuillez patienter...");

/* ***************************************************************************************************** */
//L'application va effectuer quelques v�rifications afin d'�viter les erreurs inconnues

if(!file_exists(dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php') || !is_writeable(dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php'))
{
	WriteLogConsole(1, "Le fichier ".dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php'." n'existe pas ou n'est pas accessible en lecture et/ou �criture.");
	exit;
} else
{
	$__FILTER_BUILD_SHA1__ = sha1_file(dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php');
}

if(!function_exists("sha1_file"))
{
	WriteLogConsole(1, "La fonction sha1_file() n'est pas disponible, merci de bien vouloir consulter la documentation de PHP et/ou de mettre � jour PHP vers une nouvelle version support�e par PHP Anti Spammers.");
	exit;
}

/* ***************************************************************************************************** */
//R�cup�ration de la derni�re version disponible pour les bases anti-spam

$CRDFServer['PHPAntiSpammersFilter'] = file_get_contents("http://phpantispammers.crdf.fr/update/V.FILTER.php?BUILDFILTER=" . $__FILTER_BUILD_SHA1__ . "&KEY=" . $PHPAntiSpammers['KeyMAJ']);

if($CRDFServer['PHPAntiSpammersFilter'] === false)
{
	WriteLogConsole(1, "Une erreur inconnue s'est produite pendant la connexion au serveur de PHP Anti Spammers. Merci de bien vouloir v�rifier votre connexion et/ou consulez l'erreur renvoy�e par le CRDF Core.");
} else
{
	$__PHPANTISPAMMERS__FILTER__VERSION__ARRAY__ = explode("\n", $CRDFServer['PHPAntiSpammersFilter']);
	
	if(eregi("OK", $CRDFServer['PHPAntiSpammersFilter']))
	{
		WriteLogConsole(1, "PHP Anti Spammers Filter v".$__FILTER_BUILD_SHA1__." est bien � jour. Aucune mise � jour des bases anti-spam n'a �t� faite.");
		WriteLogConsole(0, $__PHPANTISPAMMERS__FILTER__VERSION__ARRAY__[1]);
	}
	
	if(eregi("UPDATE", $CRDFServer['PHPAntiSpammersFilter']))
	{
		$__LAUNCH__UPGRADE__ = true;
		$__URL__UPGRADE__ = $__PHPANTISPAMMERS__FILTER__VERSION__ARRAY__[2];
		$__BUILD__DATABASE__FILTER__ = $__PHPANTISPAMMERS__FILTER__VERSION__ARRAY__[3];
		
		WriteLogConsole(1, "PHP Anti Spammers Filter v".$__FILTER_BUILD_SHA1__." n'est plus � jour. Le service updater va maintenant t�l�charger, installer et v�rifier la nouvelle version des bases anti-spam sur PHP Anti Spammers.");
		WriteLogConsole(0, $__PHPANTISPAMMERS__FILTER__VERSION__ARRAY__[1]);
	}
	
	if(eregi("ERROR", $CRDFServer['PHPAntiSpammersFilter']))
	{
		WriteLogConsole(1, "Une erreur s'est produite car le site Web a renvoy�e un code d'erreur, veuillez consulter l'erreur renvoy�e par le serveur de mise � jour.");
		WriteLogConsole(0, "Erreur renvoy�e : " . $__PHPANTISPAMMERS__FILTER__VERSION__ARRAY__[1]);
	}
}

/* ***************************************************************************************************** */
//Installation de la nouvelle base de donn�es des filtres anti-spam

if($__LAUNCH__UPGRADE__ === true)
{
	WriteLogConsole(1, "Lancement du t�l�chargement des nouvelles bases anti-spam depuis l'adresse Web suivante : '".$__URL__UPGRADE__."'.");
	
	$CRDFServer['UpgradeFilter'] = file_get_contents($__URL__UPGRADE__);
	
	if($CRDFServer['UpgradeFilter'] === false)
	{
		WriteLogConsole(1, "Une erreur inconnue s'est produite pendant le t�l�chargement des nouvelles bases anti-spam depuis le serveur de PHP Anti Spammers. Merci de bien vouloir v�rifier votre connexion et/ou consulez l'erreur renvoy�e par le CRDF Core.");
	} else
	{
		WriteLogConsole(1, "Installation de la nouvelle version de 'PHP Anti Spammers Filter v".$__BUILD__DATABASE__FILTER__."'. Veuillez patienter...");
		
		if(!ereg("<" . "?", $CRDFServer['UpgradeFilter']))
		{
			WriteLogConsole(1, "Le fichier ne correspond pas � une mise � jour de PHP Anti Spammers Filter. L'installation des nouvelles bases anti-spam � �chou�e.");
		} else
		{
			$fp = fopen(dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php', "w");
			fputs($fp, $CRDFServer['UpgradeFilter']);
			fclose($fp);
			
			if($__BUILD__DATABASE__FILTER__ == sha1_file(dirname(__FILE__) . '/core/filter.PHPAntiSpammers.php'))
			{
				WriteLogConsole(1, "L'installation de 'PHP Anti Spammers Filter v".$__BUILD__DATABASE__FILTER__."' a �t� effectu�e avec succ�s.");
			} else
			{
				WriteLogConsole(1, "Le fichier contenant les mises � jour des bases anti-spam est v�rol�. Merci de bien vouloir relancer le service updater. L'installation des nouvelles bases anti-spam � �chou�e.");
			}
		}
	}
}

/* ***************************************************************************************************** */
//Affichage des logs de fin du service updater

WriteLogConsole(0, "\n");
WriteLogConsole(0, "=====================================================================");
WriteLogConsole(0, "*** PHP Anti Spammers Service Updater has been completed normally. ***");
WriteLogConsole(0, "International Copyright � 2000 - 2009 CRDF All Rights Reserved.");
WriteLogConsole(0, "=====================================================================");

/* ***************************************************************************************************** */

?>