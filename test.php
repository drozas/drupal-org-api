<?php
/*
 * - Clone repo: https://github.com/drozas/drupal-org-api
 * - Install composer: https://getcomposer.org/doc/00-intro.md
 * 		curl -sS https://getcomposer.org/installer | php
 * 		mv composer.phar /usr/local/bin/composer
 * 		~/workspace/drupal-org-api$ composer install
 * - Add vendor autoload
 */
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