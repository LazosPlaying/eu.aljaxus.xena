<?php
require_once __DIR__ . '/../../inc/_util/firstload.php';
require_once __DIR__ . '/../../inc/_util/database.php';
require_once __DIR__ . '/../../inc/googleApiCli/vendor/autoload.php';

$utildb = new dbInit();
$pdo = $utildb->pdo();

$datArr = array(
	'POST' => (!empty($_POST)) ? $_POST : null,
	'SESSION' => null,
	'is_validtoken' => null,
	'msg' => []
);

function startSession($uData){
	global $datArr;
	array_push($datArr['msg'], 'Setting up session data');
	$_SESSION['u_id'] = (!empty($uData['u_id'])) ? $uData['u_id'] : null;
	$_SESSION['u_email'] = (!empty($uData['email'])) ? $uData['email'] : null;
	$_SESSION['u_email_verified'] = (!empty($uData['email_verified'])) ? $uData['email_verified'] : null;
	$_SESSION['u_name'] = (!empty($uData['name'])) ? $uData['name'] : null;
	$_SESSION['u_picture'] = (!empty($uData['picture'])) ? $uData['picture'] : null;
	$_SESSION['u_given_name'] = (!empty($uData['given_name'])) ? $uData['given_name'] : null;
	$_SESSION['u_family_name'] = (!empty($uData['family_name'])) ? $uData['family_name'] : null;
	$_SESSION['u_locale'] = (!empty($uData['locale'])) ? $uData['locale'] : null;
	array_push($datArr['msg'], 'Finished setting up session data');
}

if (!empty($_POST['token'])){
	// Get $id_token via HTTPS POST.
	// Specify the CLIENT_ID of the app that accesses the backend
	$client = new Google_Client(['client_id' => _GAUTH_CLIID]);
	$payload = $client->verifyIdToken($_POST['token']);
	if ($payload) {
		$userid = $payload['sub'];
		$datArr['is_validtoken'] = true;

		if (!empty($payload['email'])){
			array_push($datArr['msg'], 'User email: '.$payload['email']);
			if ($stmt = $pdo->prepare('SELECT `user_id`, `user_name_first`, `user_name_last`, `user_name_full`, `user_email`, `user_email`, `user_locale` FROM `users` WHERE `user_email` = ? LIMIT 1')){
				array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM users WHERE email');
				if ($stmt->execute([$payload['email']])){
					array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM users WHERE email');
					if ($user = $stmt->fetch()){
						array_push($datArr['msg'], 'User exists in the database, logging in...');
						$sessionArr = $payload;
						$sessionArr['u_id'] = $user['user_id'];
						startSession($sessionArr);
					} else {
						array_push($datArr['msg'], 'User does not exist in the database, signing up...');

						if ($stmt = $pdo->prepare('INSERT INTO `users` (`user_name_first`, `user_name_last`, `user_name_full`, `user_email`, `user_picture`, `user_locale`) VALUES (?, ?, ?, ?, ?, ?);')){
							array_push($datArr['msg'], 'PDO statement successfully prepared @ INSERT INTO users');
							if ($stmt->execute([
								$payload['given_name'],
								(!empty($payload['family_name']))?$payload['family_name']:null,
								$payload['name'],
								$payload['email'],
								$payload['picture'],
								$payload['locale']
							])){
								array_push($datArr['msg'], 'PDO statement successfully executed @ INSERT INTO users');
								if ($stmt->rowCount() == 1){
									array_push($datArr['msg'], 'PDO statement successfully INSERTED @ INSERT INTO users');
									array_push($datArr['msg'], 'Successfully signed the user up');
									startSession($payload);
								} elseif ($stmt->rowCount() > 1) {
									array_push($datArr['msg'], 'PDO statement failed to INSERT @ INSERT INTO users - 2 >= rows modified');
								} else {
									array_push($datArr['msg'], 'PDO statement failed to INSERT @ INSERT INTO users - not inserted');
								}
							} else {
								array_push($datArr['msg'], 'PDO statement failed to execute @ INSERT INTO users');
							}
						} else {
							array_push($datArr['msg'], 'PDO statement failed to prepare @ INSERT INTO users');
						}

					}

				} else {
					array_push($datArr['msg'], 'PDO statement failed to execute @ SELECT FROM users WHERE email');
				}
			} else {
				array_push($datArr['msg'], 'PDO statement failed to prepare @ SELECT FROM users WHERE email');
			}
		} else {
			array_push($datArr['msg'], 'Something went wrong! Email was not provided');
		}


		$_SESSION['u_isloged'] = true;

	} else {
		// Invalid ID token
		$datArr['is_validtoken'] = false;
		$_SESSION['u_isloged'] = false;
	}
}

$datArr['SESSION'] = $_SESSION;

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
