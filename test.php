<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require 'vendor/autoload.php';
use EclipseGc\DrupalOrg\Api\DrupalClient;

$client = DrupalClient::create();


$user = $client->getUser(740628);
echo $user->getFirstName() . " " . $user->getlastName() . "'s mentors are:";
foreach ($user->getMentors() as $mentor){
 echo "<br \>" . $mentor->getFirstName() . " " . $mentor->getlastName();
 }
/*foreach ($user->getAttendance() as $attendance){
	echo $event;
}*/

?>