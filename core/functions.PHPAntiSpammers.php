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
//			SI VOUS NE SAVEZ PAS CE QUE VOUS FAITES, NE MODIFIEZ PAS CES DONNEES.
// ///////////////////////////////////////////////////////////////////////////////////
// Ce fichier contient l'ensemble des fonctions principales de l'application.
// En cas de modification de ces fonctions, vous pouvez corrompre l'intégrité de
// l'application. Soyez vigilant !
// ///////////////////////////////////////////////////////////////////////////////////


/* ***************************************************************************************************** */
//Fonction permettant de vérifier la validité d'une adresse e-mail

function checkEmail($email)
{
    if(empty($email) || !strstr($email, "@") || !strstr($email, "."))
    {
        return false;
    }

    return eregi("^[a-z0-9+=._-]+@[a-z0-9]+([.-][a-z0-9]+)*\.[a-z]{2,4}$", $email)?true:false;
}


/* ***************************************************************************************************** */
//Fonction permettant de vérifier la validité d'un domaine

function checkDomain($domain)
{
    return eregi("^([a-z0-9-]{2,}\.)+[a-z]{2,4}$", $domain)?true:false;
}

/* ***************************************************************************************************** */
//Fonction permettant de transformer certaines chaînes de caractères en dites "NORMALES"

function fix_text ($var)
{
	if(ereg("=\?.{0,}\?[Bb]\?", $var))
	{
		$var = split("=\?.{0,}\?[Bb]\?", $var);
		
		while(list($key, $value) = each($var))
		{
			if(ereg("\?=", $value))
			{
				$arrTemp = split("\?=", $value);
				$arrTemp[0] = base64_decode($arrTemp[0]);
				$var[$key] = join("", $arrTemp);
			}
		}
		$var = join("", $var);
	} 
	
	if(ereg("=\?.{0,}\?Q\?", $var))
	{
		$var = quoted_printable_decode($var);
		$var = ereg_replace("=\?.{0,}\?[Qq]\?", "", $var);
		$var = ereg_replace("\?=", "", $var);
	}
	return trim($var);
}

/* ***************************************************************************************************** */
//Fonction permettant l'affichage des logs en mode console

function WriteLogConsole ($IDENTID, $Msg)
{
	if(empty($IDENTID))
	{
		echo $Msg . "\r\n";
	} else
	{
		echo date("r") . ": " . $Msg . "\r\n";
	}
}

/* ***************************************************************************************************** */
//Fonction permettant la gestion des erreurs personnalisées avec PHP

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    switch($errno)
    {
        case E_ERROR:               $CRDFErrorTypeCore = "Error";                  break;
        case E_WARNING:             $CRDFErrorTypeCore = "Warning";                break;
        case E_PARSE:               $CRDFErrorTypeCore = "Parse Error";            break;
        case E_NOTICE:              $CRDFErrorTypeCore = "Notice";                 break;
        case E_CORE_ERROR:          $CRDFErrorTypeCore = "Core Error";             break;
        case E_CORE_WARNING:        $CRDFErrorTypeCore = "Core Warning";           break;
        case E_COMPILE_ERROR:       $CRDFErrorTypeCore = "Compile Error";          break;
        case E_COMPILE_WARNING:     $CRDFErrorTypeCore = "Compile Warning";        break;
        case E_USER_ERROR:          $CRDFErrorTypeCore = "User Error";             break;
        case E_USER_WARNING:        $CRDFErrorTypeCore = "User Warning";           break;
        case E_USER_NOTICE:         $CRDFErrorTypeCore = "User Notice";            break;
        case E_STRICT:              $CRDFErrorTypeCore = "Strict Notice";          break;
        case E_RECOVERABLE_ERROR:   $CRDFErrorTypeCore = "Recoverable Error";      break;
        default:                    $CRDFErrorTypeCore = "Unknown error ($errno)"; break;
    }
    
    if($errno != E_NOTICE)
    {
    	echo "<html>" . "\n";
    	echo "<head>" . "\n";
    	echo "<title>CRDF Core : ".$CRDFErrorTypeCore."</title>" . "\n";
    	echo "</head>" . "\n";
    	echo "<body>" . "\n";
    	echo "<div style=\"border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;\">" . "\n";
    	echo "<h4>CRDF Core : <strong>".$CRDFErrorTypeCore."</strong>.</h4>" . "\n";
   		echo "<p>ERROR PHP [<strong>".$CRDFErrorTypeCore."</strong>]: ".$errstr."</p>" . "\n";
  		echo "<p>Filename : <strong>".$errfile."</strong><br />" . "\n";
    	echo "Line Number : <strong>".$errline."</strong></p>" . "\n";
    	echo "<p>Powered by <a title=\"CRDF Core\" href=\"http://www.crdf.fr\">CRDF Core</a>.</p>" . "\n";
    	echo "</div>" . "\n";
    	echo "</body>" . "\n";
    	echo "</html>" . "\n";
    	exit;
    }
    
    return true;
}

set_error_handler("myErrorHandler");

/* ***************************************************************************************************** */

?>