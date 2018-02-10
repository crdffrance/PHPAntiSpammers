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

// ///////////////////////////////////////////////////////////////////////////////////
//			ATTENTION, MERCI DE LIRE CET AVERTISSEMENT DANS SON INTEGRALITE.
//			SI VOUS NE SAVEZ PAS QUOI FAIRE, NE MODIFIEZ PAS CES DONNEES.
// ///////////////////////////////////////////////////////////////////////////////////
// Ce fichier contient les filtres permettant à l'application de détecter les spams.
// Si vous modifiez les données du filtre, celui-ci pourrait avoir moins d'efficacité
// sur le tri de vos messages. Faites donc attention à ce que vous faites :) !
// ///////////////////////////////////////////////////////////////////////////////////

/* ***************************************************************************************************** */
//Liste des sujets suspects

/**
 * 
 * @example $filtreSujet[]='alert';
 * 
 */

//$filtreSujet=array();
//$filtreSujet[]='alert';
//$filtreSujet[]='confirmation link';

/* ***************************************************************************************************** */
//Liste de mots suspects dans le sujet (configuration avancée requise)

/**
 * 
 * @example $filtreSujetMot[]=array(',000', '+400');
 * 
 */

//$filtreSujetMot=array();
//$filtreSujetMot[]=array(',000', '+400');
//$filtreSujetMot[]=array('--sale--', '+400');

/* ***************************************************************************************************** */
//Liste d'expressions régulières à vérifier dans le sujet des mails (configuration avancée requise)

/**
 * 
 * @example $regexSujet[]=array('((\|#|\||@|\{|\}|\$|%).){2,}', '+800');
 * 
 */

//$regexSujet=array();
//$regexSujet[]=array('%\ ([a-z]+\ )*(o|0)ff', '+800');
//$regexSujet[]=array('((\|#|\||@|\{|\}|\$|%).){2,}', '+800');

/* ***************************************************************************************************** */
//Liste d'expressions régulières à vérifier dans le corps des emails (configuration avancée requise)

/**
 * 
 * @example $filtreCorpsRegex[]=array('\b[Ss]\W{0,3}[Tt]\W{0,3}[Yy¥Ýýÿ]\W{0,3}[Ll£¡1|!]\W{0,3}[EeÈÉÊËèéêë€3]\W{0,3}[Ss]\b', '+800');
 * 
 */

//$filtreCorpsRegex=array();
//$filtreCorpsRegex[]=array('\b[Ss]\W{0,3}[Tt]\W{0,3}[Yy¥Ýýÿ]\W{0,3}[Ll£¡1|!]\W{0,3}[EeÈÉÊËèéêë€3]\W{0,3}[Ss]\b', '+800');
//$filtreCorpsRegex[]=array('\b[OoÒÓÔÕÖØòóôõöø0]\W{0,3}[NnÑñ]\W{0,3}[Ll£¡1|!]\W{0,3}[IiÌÍÎÏìíîï¡l1|!]\W{0,3}[NnÑñ]\W{0,3}[EeÈÉÊËèéêë€3]\b', '+800');

/* ***************************************************************************************************** */
//Liste de noms de domaine ou adresses e-mail suspects (expéditeur)

/**
 * 
 * @example $filtreExpediteur[]='attbi.com';
 * 
 */

//$filtreExpediteur=array();
//$filtreExpediteur[]='attbi.com';
//$filtreExpediteur[]='bkkmail.com';

/* ***************************************************************************************************** */
//Liste des codes pays suspects dans le nom de domaine de l'expéditeur

/**
 * 
 * @example $filtreExpTld[]='adr';
 * 
 */

//$filtreExpTld=array();
//$filtreExpTld[]='adr';
//$filtreExpTld[]='ar';

/* ***************************************************************************************************** */
//Liste des fournisseurs d'accès Internet suspects (un seul .)

/**
 * 
 * @example $filtreExpFAI[]='attbi.com';
 * 
 */

//$filtreExpFAI=array();
//$filtreExpFAI[]='attbi.com';
//$filtreExpFAI[]='bigfoot.com';

/* ***************************************************************************************************** */
//Liste des adresses IP suspectes (xxx.xxx.xxx.xxx, xxx.xxx.xxx., xxx.xxx. ou xxx.)

/**
 * 
 * @example $filtreExpIP[]='117.47.';
 * 
 */

//$filtreExpIP=array();
//$filtreExpIP[]='117.47.';
//$filtreExpIP[]='122.';

/* ***************************************************************************************************** */
//Liste de mots suspects dans le nom des fichiers (pièces jointes) (caractères alphabétiques uniquement)

/**
 * 
 * @example $filtreFichierMot[]='about';
 * 
 */

//$filtreFichierMot=array();
//$filtreFichierMot[]='about';
//$filtreFichierMot[]='auction';

/* ***************************************************************************************************** */
//Liste des extensions de noms de fichiers (pièces jointes) suspectes

/**
 * 
 * @example $filtreFichierExt[]='bat';
 * 
 */

//$filtreFichierExt=array();
//$filtreFichierExt[]='bat';
//$filtreFichierExt[]='cmd';

/* ***************************************************************************************************** */

?>