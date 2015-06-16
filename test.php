<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require 'vendor/autoload.php';
use EclipseGc\DrupalOrg\Api\DrupalClient;

$client = DrupalClient::create();


$user = $client->getUser(348120);
echo "The mentors of " . $user->getName() . "(" . $user->getFirstName() . " " . $user->getlastName() .  ") are:";
foreach ($user->getMentors() as $mentor){
 echo "<br \>" . $mentor->getName() . "(" . $mentor->getFirstName() . " " . $mentor->getlastName() .  ")";

 }
/*foreach ($user->getAttendance() as $attendance){
	echo $event;
}*/

?>