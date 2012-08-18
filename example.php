<?php
include_once 'wordlistgenerator.class.php';

for ($i=2;$i<=3;$i++)
{
	$ws = new WordlistGenerator($i,'abcdefghijklmnopqrstuvwxyz');
	while($ws->isNext()) {
		echo $ws->getWord();
		$ws->nextWord();
		echo "\n";
	}
	unset($ws);
}
?>
