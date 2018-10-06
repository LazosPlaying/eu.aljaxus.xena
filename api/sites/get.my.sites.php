<?php

require_once __DIR__ . '/../../inc/__util/firstload.php';
require_once __DIR__ . '/../../inc/__util/database.php';

$dbutil = new dbInit();
$pdo = $dbutil->pdo();

$datArr = [
	'msg' => [],
	'sites' => []
];

if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged']==true && !empty($_SESSION['u_id'])){
	if ($stmt = $pdo->prepare('SELECT `site_id`, `site_name`, `site_displayname`, `site_options` FROM `sites` WHERE `site_owner` = ?;')){
		array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM sites');
		if ($stmt->execute([$_SESSION['u_id']])){
			array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM sites');
			while ($site = $stmt->fetch()){
				array_push($datArr['msg'], 'PDO statement successfully fetched @ SELECT FROM sites -> site id: '.$site['site_id']);

                array_push($datArr['sites'], ['id'=>$site['site_id'], 'name'=>$site['site_name'], 'displayname'=>$site['site_displayname'], 'options'=>json_decode($site['site_options'])]);

			}
		} else {
			array_push($datArr['msg'], '/!\ PDO statement failed to execute @ SELECT FROM sites');
		}
	} else {
		array_push($datArr['msg'], '/!\ DO statement failed to prepare @ SELECT FROM sites');
	}
} else {
	array_push($datArr['msg'], '/!\ You must login in order so list your sites');
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
