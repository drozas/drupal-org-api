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

const LAST_UID = 3248108;
const DROZAS_UID = 740628;

$db_hostname = "localhost";
$db_username = "dorg_mentors";
$db_password = "dorg_mentors";
$db_name = "dorg_mentors";

require 'vendor/autoload.php';
use EclipseGc\DrupalOrg\Api\DrupalClient;


try
{
	// Create connection
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$client = DrupalClient::create();

	for ($i = DROZAS_UID; $i <= DROZAS_UID + 10; $i++) {
		//Get user 
		$user = $client->getUser($i);
		
		//Keep mentored in memory. More efficient?
		$mentored_uid = $user->getUid();
		$mentored_username = $user->getName();
		
		//Add a new tuple for each mentored_by
		foreach ($user->getMentors() as $mentored_by){
			$mentored_by_uid = $mentored_by->getUid();
			$mentored_by_username = $mentored_by->getName();
			$sql = "INSERT INTO mentored_by (mentored_uid, mentored_by_uid, mentored_username, mentored_by_username)
			VALUES ($mentored_uid, $mentored_by_uid, '$mentored_username', '$mentored_by_username')";
			$result = $conn->query($sql);
		}
	}



	$conn->close();
} catch (Exception $e)
{
	echo 'Caught exception: ', $e->getMessage(), "\n";
}

?>