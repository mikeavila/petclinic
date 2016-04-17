<?php
$mysqli = new mysqli('localhost', "pcmsuser", "pcmspwd", '');
$file_handle = fopen("../data/equinebreeds.txt", "r");
while (!feof($file_handle)) {
	$line = fgets($file_handle);
	$species = substr($line, 0,1);
	$code = substr($line,1,2);
	$text = substr($line,3);
	$sql = 'INSERT INTO `petclinic`.`code_breed` (`speciescode`, `breedcode`, `breeddesc`)
		VALUES("'.$species.'", "'.$code.'", "'.$text.'");';
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Error inserting into breed table" . $mysqli->error;
		exit(1);
	} }
	fclose($file_handle);