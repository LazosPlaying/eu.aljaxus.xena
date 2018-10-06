<?php

require_once __DIR__ . '/../../inc/__util/firstload.php';
require_once __DIR__ . '/../../inc/__util/database.php';
require_once __DIR__ . '/../../inc/__util/json.php';

$jsonUtil 	= new jsonUtil();
$dbutil 	= new dbInit();
$pdo 		= $dbutil->pdo();


if ($_POST['enabled']=='true') {$_POST['enabled']=true;} else {$_POST['enabled']=false;}
if ($_POST['showowner']=='true') {$_POST['showowner']=true;} else {$_POST['showowner']=false;}

$datArr = [
	'post' => [],
	'files' => [],
	'msg' => [],
	'toasts' => [],
	'isok' => [
		'name' => false,
		'displayname' => false,
		'showowner' => false,
		'enabled' => false
	],
	'is_success' => false
];

if (!empty($_POST)){
	$datArr['post'] = $_POST;
}
if (!empty($_FILES)){
	$datArr['files'] = $_FILES;
}

//
// REQUIRED DATA CHECKERS
//

// CHECKER FOR "NAME"
if (!empty($_POST['name'])){
	array_push($datArr['msg'], 'NAME is not empty.');
	if (is_string($_POST['name'])){
		array_push($datArr['msg'], 'NAME is a string.');
		if (strlen($_POST['name']) <= 30){
			array_push($datArr['msg'], 'NAME is shorter than 30 characters.');
			if (!preg_match('/\s/', $_POST['name'])){
				array_push($datArr['msg'], 'NAME does not have any spaces.');
				$datArr['isok']['name'] = true;
			} else {
				$datArr['isok']['name'] = false;
				array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Name\' must exclude spaces']);
			}
		} else {
			$datArr['isok']['name'] = false;
			array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Name\' max. 30 letters']);
		}
	} else {
		$datArr['isok']['name'] = false;
		array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Name\' must be a string']);
	}
} else {
	$datArr['isok']['name'] = false;
	array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Name\' must not be empty']);
}
// CHECKER FOR "DISPLAYNAME"
if ( !empty($_POST['displayname']) ){
	array_push($datArr['msg'], 'DISPLAYNAME is not empty.');
	if (is_string($_POST['displayname'])){
		array_push($datArr['msg'], 'DISPLAYNAME is string.');
		if (strlen($_POST['displayname']) <= 60){
			array_push($datArr['msg'], 'DISPLAYNAME is shorter than 60 chars.');
			$datArr['isok']['displayname'] = true;
		} else {
			$datArr['isok']['displayname'] = false;
			array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Displayname\' max. 60 letters']);
		}
	} else {
		$datArr['isok']['displayname'] = false;
		array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Displayname\' must be a string']);
	}
} else {
	$datArr['isok']['displayname'] = false;
	array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Displayname\' must not be empty']);
}
// CHECKER FOR "ENABLED"
if (is_bool($_POST['enabled'])){
	array_push($datArr['msg'], 'ENABLED is correctly defined.');
	$datArr['isok']['enabled'] = true;
} else {
	array_push($datArr['msg'], 'ENABLED is empty or not true || false.');
	$datArr['isok']['enabled'] = false;
	array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Enabled\' is not boolean! Refresh the webpage.']);
}
// CHECKER FOR "SHOWOWNER"
if (is_bool($_POST['showowner']) ){
	array_push($datArr['msg'], 'SHOWOWNER is correctly defined.');
	$datArr['isok']['showowner'] = true;
} else {
	array_push($datArr['msg'], 'SHOWOWNER is empty or not true || false.');
	$datArr['isok']['showowner'] = false;
	array_push($datArr['toasts'], ['classes'=>'red','html'=>'\'Showowner\' is not boolean! Refresh the webpage.']);
}
//
// PROCCESS START
//

if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged'] == true){
	array_push($datArr['msg'], 'You are loged in.');
	if (!in_array(false, $datArr['isok'], true)){
		array_push($datArr['msg'], 'All checks are positive.');

		if ($stmt = $pdo->prepare('SELECT `site_id` FROM `sites` WHERE `site_name` = ?;')){
			array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM sites');
			if ($stmt->execute([$_POST['name']])){
				array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM sites');
				if (!$stmt->fetch()){
					array_push($datArr['msg'], 'The site name is free');
					if ($stmt = $pdo->prepare('INSERT INTO sites (`site_owner`, `site_name`, `site_displayname`, `site_content`, `site_options`) VALUES (?, ?, ?, ?, ?);')){
						array_push($datArr['msg'], 'PDO statement successfully prepared @ INSERT INTO sites');
						// $temp1 = json_encode(["enabled"=>$_POST['enabled'],"showowner"=>$_POST['showowner']]);
						$site_content;
						if (
							!empty($_FILES['importfile']) &&
							$_FILES['importfile']['error']==0 &&
							!empty($_FILES['importfile']['tmp_name']) &&
							$_FILES['importfile']['size']>1
						){
							$site_content = file_get_contents($_FILES['importfile']['tmp_name']);
						} else {
							$site_content = '[]';
						}
						$site_options = json_encode(["showowner"=>($_POST['showowner']==true?true:false),"enabled"=>($_POST['enabled']==true?true:false)]);
						if ($stmt->execute([$_SESSION['u_id'], $_POST['name'], $_POST['displayname'], $site_content, $site_options])){
							array_push($datArr['msg'], 'PDO statement successfully executed @ INSERT INTO sites');
							if ($stmt->rowCount() == 1){
								array_push($datArr['msg'], 'Site successfully inserted into the database');
								$datArr['is_success'] = true;
							} else {
								array_push($datArr['msg'], '/!\ Site failed to insert into the database');
							}
						} else {
							array_push($datArr['msg'], '/!\ PDO statement failed to execute @ INSERT INTO sites');
						}
					} else {
						array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ INSERT INTO sites');
					}
				} else {
					array_push($datArr['msg'], '/!\ A site with that name already exists');
					array_push($datArr['toasts'], ['classes'=>'red','html'=>'This site name is already in use']);
					$datArr['isok']['name'] = false;
				}
			} else {
				array_push($datArr['msg'], '/!\ PDO statement failed to execute @ SELECT FROM sites');
			}
		} else {
			array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ SELECT FROM sites');
		}

	} else {
		array_push($datArr['msg'], '/!\ One or more checks are negative!');
	}
} else {
	array_push($datArr['msg'], '/!\ You have to be loged in in order to access this part of the API');
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
