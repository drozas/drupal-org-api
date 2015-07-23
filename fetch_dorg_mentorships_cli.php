<?php
/*
 * DESCRIPTION:
 * Fetch mentorship relationships of Drupal.org profiles.
 * For each profile, it is checked if this user has been mentored by someone.
 * If so, a new record is created for each of this relationships. The UIDs
 * and usernames are stored.
 * 
 * INSTRUCTIONS TO INSTALL IT:
 * 
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

// UID of testing user, created on 23/06/2015 - https://www.drupal.org/u/djohn4406
const DRIES_UID = 1;
const LAST_UID = 3248108;
const DROZAS_UID = 740628;
const JCARBALLO_UID = 1283668;
const _403_UID = 1283721;

// CONST FOR GATEWAY SERVER ERRORS
const RUN_1 = 4735;
const RUN_2 = 5155;
const RUN_3 = 11010;
const RUN_4 = 14477;
const RUN_5 = 17134;
const RUN_6 = 25183;
const RUN_7 = 26393;
const RUN_8 = 179766;
const RUN_9 = 194223;
const RUN_10 = 207009;
const RUN_11 = 207648;
const RUN_12 = 208504;
const RUN_13 = 219641;
const RUN_14 = 232626;
const RUN_15 = 249780;
const RUN_16 = 264906;
const RUN_17 = 273384;
const RUN_18 = 284781;
const RUN_19 = 334916;



// Dummy credentials, only to use for local purposes
$db_hostname = "localhost";
$db_username = "dorg_mentors";
$db_password = "dorg_mentors";
$db_name = "dorg_mentors";

require 'vendor/autoload.php';
use EclipseGc\DrupalOrg\Api\DrupalClient;

try
{
	// Create and check connection
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Prepare log file
	$log = fopen("./logs/log_" . time(), "w") or die("Unable to open file!");
	
	//Instantiate SDK client
	$client = DrupalClient::create();

	for ($i = RUN_19; $i <= LAST_UID; $i++) {
		// Fetch whole user object. Catch possible error responses from API (e.g. 403)
		try {
			$user = $client->getUser($i);
			
			// Check if the UID exist. If not, the constructor was modified to set a null.
			if ($user->getUid() != NULL){
				
				$mentored_uid = $user->getUid();
				$mentored_username = $user->getName();
				$msg= "- Profile from $mentored_username with UID #$i is being processed.\n";
				fwrite($log, $msg);
				echo $msg;
					
				// Add a new record for each mentored_by relationship of this profile
				foreach ($user->getMentors() as $mentored_by){
					$mentored_by_uid = $mentored_by->getUid();
					$mentored_by_username = $mentored_by->getName();
					$sql = "INSERT INTO mentored_by (mentored_uid, mentored_by_uid, mentored_username, mentored_by_username)
					VALUES ($mentored_uid, $mentored_by_uid, '$mentored_username', '$mentored_by_username')";
					$result = $conn->query($sql);
					$msg = "-- A mentorship_by relationship has been stored: $mentored_username (UID #$mentored_uid) was mentored by $mentored_by_username (UID #$mentored_by_uid).\n";
					fwrite($log, $msg);
					echo $msg;
			}
			}else{
				$msg =  "- Profile with UID #$i has been skipped: 404 response from Drupal.org's API.\n";
				fwrite($log, $msg);
				echo $msg;
			}			
		}catch (GuzzleHttp\Exception\ClientException $e){
			$exception_message = $e->getMessage();
			$msg = "- Profile with UID #$i has been skipped due to an exception from Drupal.org's API (client side): $exception_message \n";
			fwrite($log, $msg);
			echo $msg;
		}catch (GuzzleHttp\Exception\ServerException $e){
			// This will make it to re-attempt after timeout
			$exception_message = $e->getMessage();
			$msg = "- Profile with UID #$i has been skipped due to an exception from Drupal.org's API (server side): $exception_message \n";
			fwrite($log, $msg);
			echo $msg;
		}
	}
	$conn->close();
	fclose($log);
} catch (Exception $e) {
	$exception_message = $e->getMessage();
	$msg =  "[!] Caught generic exception:  $exception_message \n";
	fwrite($log, $msg);
	fclose($log);
	echo $msg;
}

?>