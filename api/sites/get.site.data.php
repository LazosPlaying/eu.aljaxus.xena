<?php

require_once __DIR__ . '/../../inc/_util/firstload.php';
require_once __DIR__ . '/../../inc/_util/database.php';

$dbutil = new dbInit();
$pdo = $dbutil->pdo();

$datArr = [
	'msg' => [],
	'content' => [],
	'metadata' => [
		'enabled' => false,
		'name' => null,
		'title' => null
	],
	'owner' => [
		'u_email' => null,
		'u_name' => null,
		'u_picture' => null,
		'is_shown' => false
	]
];

if (!empty($_GET['site_name'])){
	array_push($datArr['msg'], 'Given site name is: '.$_GET['site_name']);
	$datArr['metadata']['name'] = $_GET['site_name'];
	if ($stmt = $pdo->prepare('SELECT `site_id`, `site_name`, `site_owner`, `site_displayname`, `site_content`, `site_options` FROM `sites` WHERE `site_name` = ?;')){
		array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM sites');
		if ($stmt->execute([$_GET['site_name']])){
			array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM sites');
			if ($site = $stmt->fetch()){
				array_push($datArr['msg'], 'PDO statement successfully fetched @ SELECT FROM sites');
				$siteOptions = json_decode($site['site_options'], true);
				$datArr['metadata']['title'] = $site['site_displayname'];

				if ($siteOptions['enabled']==true||$siteOptions['enabled']=='true'){
					array_push($datArr['msg'], 'Selected site is enabled');
					$datArr['content'] = json_decode($site['site_content'], true);
					$datArr['metadata']['enabled'] = true;
					if ($siteOptions['showowner']==true||$siteOptions['showowner']=='true'){
						array_push($datArr['msg'], '`Showowner` setting is enabled');

						if ($stmt = $pdo->prepare('SELECT `user_email`, `user_name_full`, `user_picture` FROM `users` WHERE `user_id` = ?;')){
							array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM users');
							if ($stmt->execute([$site['site_owner']])){
								array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM users');
								if ($owner = $stmt->fetch()){
									array_push($datArr['msg'], 'PDO statement successfully fetched @ SELECT FROM users');
									$datArr['owner']['is_shown'] = true;
									$datArr['owner']['u_email'] = (!empty($siteOptions['u_email'])) ? $siteOptions['u_email'] : $owner['user_email'];
									$datArr['owner']['u_name'] =(!empty($siteOptions['u_name'])) ? $siteOptions['u_name'] :  $owner['user_name_full'];
									$datArr['owner']['u_picture'] = (!empty($siteOptions['u_picture'])) ? $siteOptions['u_picture'] : $owner['user_picture'];
								} else {
									array_push($datArr['msg'], 'PDO statement failed to fetch @ SELECT FROM users');
								}
							} else {
								array_push($datArr['msg'], 'PDO statement failed to execute @ SELECT FROM users');
							}
						} else {
							array_push($datArr['msg'], 'PDO statement failed to prepare @ SELECT FROM users');
						}


					} else {
						array_push($datArr['msg'], '`Showowner` setting is disabled');
					}
				} else {
					array_push($datArr['msg'], 'Selected site is disabled');
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


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
