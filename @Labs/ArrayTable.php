<?php 

/**
 * 
 * Database filter
 * 
 */

$filtreSujetMot[]= array('join now', '+3600');
$filtreSujetMot[]= array('server', '-600');
$filtreSujetMot[]= array('sex', '+200');
$filtreSujetMot[]= array('porn', '-10');
$filtreSujetMot[]= array('exploit', '-6');
$filtreSujetMot[]= array('xp', '-40');
$filtreSujetMot[]= array('sex', '+10');

/**
 * 
 * View array tables
 * 
 */

print_r($filtreSujetMot);

/**
 * 
 * Function to count level spam
 * 
 */

function LvlSpam ($O, $V)
{
	global $LevelGlobal;
	
	if($O == "+")
	{
		$LevelGlobal += $V;
	} else
	{
		$LevelGlobal -= $V;
	}
	
	return $LevelGlobal;
}

/**
 * 
 * Example included in PHP Anti Spammers
 * 
 */

$SubjectMsg = "join now server sex xp exploit";

echo "<p>Text : ".$SubjectMsg.".</p>";

$LevelGlobal = 0;

echo "<p>Result :</p><p>";

foreach ($filtreSujetMot as $mot)
{
	if(strstr($SubjectMsg, $mot[0]))
	{
		echo "Words found: ".$mot[0]." / Op: ".$mot[1]." / Now: ".$LevelGlobal." ;<br />";
		
		$LevelGlobal += $mot[1];
		
		$LevellSpam++;
	}
}

echo "</p><p>Level Spam : ".$LevelGlobal." ;</p>";

?>