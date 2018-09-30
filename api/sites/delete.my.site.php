<?php

require_once __DIR__ . '/../../inc/_util/firstload.php';
require_once __DIR__ . '/../../inc/_util/database.php';
require_once __DIR__ . '/../../inc/_util/json.php';

$jsonUtil 	= new jsonUtil();
$dbutil 	= new dbInit();
$pdo 		= $dbutil->pdo();

$datArr 	= [
	'msg' => [],
	'is_deleted' => false
];

if ($_SESSION['u_isloged'] == true){
	array_push($datArr['msg'], 'You are loged in.');
	if (!empty($_POST['site_name'])){
		array_push($datArr['msg'], 'Given site_name is: '.$_POST['site_name']);
		if ($stmt = $pdo->prepare('SELECT `site_id`, `site_owner` FROM `sites` WHERE `site_name` = ?;')){
			array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM sites');
			if ($stmt->execute([$_POST['site_name']])){
				array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM sites');
				if ($site = $stmt->fetch()){
					array_push($datArr['msg'], 'PDO statement successfully fetched @ SELECT FROM sites');
					if ($site['site_owner'] === $_SESSION['u_id']){
						array_push($datArr['msg'], 'You do own this site');

						if ($stmt = $pdo->prepare('DELETE FROM `sites` WHERE `site_id` = ?;')){
							array_push($datArr['msg'], 'PDO statement successfully prepared @ DELETE FROM sites');
							if ($stmt->execute([$site['site_id']])){
								array_push($datArr['msg'], 'PDO statement successfully executed @ DELETE FROM sites');
								if ($stmt->rowCount() == 1){
									array_push($datArr['msg'], 'PDO statement successfully deleted @ DELETE FROM sites');
									$datArr['is_deleted'] = true;
								} else {
									array_push($datArr['msg'], 'PDO statement failed to delete @ DELETE FROM sites');
								}
							} else {
								array_push($datArr['msg'], 'PDO statement failed to execute @ DELETE FROM sites');
							}
						} else {
							array_push($datArr['msg'], 'PDO statement failed to prepare @ DELETE FROM sites');
						}

					} else {
						array_push($datArr['msg'], 'You do not own this site! You can only export sites that you own.');
					}
				} else {
					array_push($datArr['msg'], 'PDO statement failed to fetch @ SELECT FROM sites');
				}
			} else {
				array_push($datArr['msg'], 'PDO statement failed to execute @ SELECT FROM sites');
			}
		} else {
			array_push($datArr['msg'], 'PDO statement failed to prepare @ SELECT FROM sites');
		}
	} else {
		array_push($datArr['msg'], 'Site name must be provided via POST `site_name` data');
	}
} else {
	array_push($datArr['msg'], 'You have to be loged in in order to access this part of the API');
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
