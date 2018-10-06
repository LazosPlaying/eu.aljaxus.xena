<?php

require_once __DIR__ . '/../../inc/__util/firstload.php';
require_once __DIR__ . '/../../inc/__util/database.php';
require_once __DIR__ . '/../../inc/__util/json.php';

$jsonUtil 	= new jsonUtil();
$dbutil 	= new dbInit();
$pdo 		= $dbutil->pdo();

$datArr 	= [
	'post' => [],
	'files' => [],
	'msg' => []
];

if (!empty($_POST)){
	$datArr['post'] = $_POST;
}
if (!empty($_FILES)){
	$datArr['files'] = $_FILES;
}

if ($_SESSION['u_isloged'] == true){
	array_push($datArr['msg'], 'You are loged in.');
	if (!empty($_POST['site_id'])){
		array_push($datArr['msg'], 'Given site_id is: '.$_POST['site_id']);
		if (
			!empty($_FILES['importfile']) &&
			$_FILES['importfile']['error']==0 &&
			!empty($_FILES['importfile']['tmp_name']) &&
			$_FILES['importfile']['size']>1
		){
			array_push($datArr['msg'], 'Importfile name is: '.$_FILES['importfile']['name']);
			if ($stmt = $pdo->prepare('SELECT `site_owner` FROM `sites` WHERE `site_id` = ?;')){
				array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM sites');
				if ($stmt->execute([$_POST['site_id']])){
					array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM sites');
					if ($site = $stmt->fetch()){
						array_push($datArr['msg'], 'PDO statement successfully fetched @ SELECT FROM sites');
						if ($site['site_owner'] === $_SESSION['u_id']){
							array_push($datArr['msg'], 'You do own this site');
							$jsonContent = file_get_contents($_FILES['importfile']['tmp_name']);
							if ($jsonUtil->validate($jsonContent) == true){
								array_push($datArr['msg'], 'The uploaded file has valid JSON');

								if ($stmt = $pdo->prepare('UPDATE `sites` SET `site_content` = ? WHERE `site_id` = ?;')){
									array_push($datArr['msg'], 'PDO statement successfully prepared @ INSERT INTO sites');
									if ($stmt->execute([$jsonContent, $_POST['site_id']])){
										array_push($datArr['msg'], 'PDO statement successfully executed @ INSERT INTO sites');
										array_push($datArr['msg'], ['Rows affected'=>$stmt->rowCount()]);
										if ($stmt->rowCount() == 1){
											array_push($datArr['msg'], 'Successfully imported site content');
										} else {
											array_push($datArr['msg'], '/!\ Failed to import site content');
										}
									} else {
										array_push($datArr['msg'], '/!\ PDO statement failed to execute @ INSERT INTO sites');
									}
								} else {
									array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ INSERT INTO sites');
								}

							} else {
								array_push($datArr['msg'], '/!\ The uploaded file has INVALID JSON');
							}
						} else {
							array_push($datArr['msg'], '/!\ You do not own this site! You can only import data to sites that you own.');
						}
					} else {
						array_push($datArr['msg'], '/!\ PDO statement failed to fetch @ SELECT FROM sites');
						array_push($datArr['msg'], '/!\ Site with that ID does not exist!');
					}
				} else {
					array_push($datArr['msg'], '/!\ PDO statement failed to execute @ SELECT FROM sites');
				}
			} else {
				array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ SELECT FROM sites');
			}
		} else {
			array_push($datArr['msg'], '/!\ Import file must be provided via FILES `importfile` data');
		}
	} else {
		array_push($datArr['msg'], '/!\ Site name must be provided via POST `site_id` data');
	}
} else {
	array_push($datArr['msg'], '/!\ You have to be loged in in order to access this part of the API');
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
