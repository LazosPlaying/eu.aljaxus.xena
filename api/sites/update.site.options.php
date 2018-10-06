<?php

require_once __DIR__ . '/../../inc/__util/firstload.php';
require_once __DIR__ . '/../../inc/__util/database.php';

$dbutil = new dbInit();
$pdo = $dbutil->pdo();

$datArr = [
	'msg' => [],
	'site' => [],
];

if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged']==true){
	if (!empty($_POST['site_id']) && is_numeric($_POST['site_id']) && !empty($_POST['option'])){
		if ($stmt = $pdo->prepare('SELECT `site_id`, `site_owner`, `site_options` FROM `sites` WHERE `site_id` = ? LIMIT 1;')){
			array_push($datArr['msg'], 'PDO statement successfully prepared @ SELECT FROM sites');
			if ($stmt->execute([$_POST['site_id']])){
				array_push($datArr['msg'], 'PDO statement successfully executed @ SELECT FROM sites');
				if ($site = $stmt->fetch()){
					array_push($datArr['msg'], 'PDO statement successfully fetched @ SELECT FROM sites -> site id: '.$site['site_id']);
					if ($site['site_owner'] === $_SESSION['u_id']){
						array_push($datArr['msg'], 'You have permission for editing this site');
						$siteOptions = json_decode($site['site_options'], true);
						array_push($datArr['msg'], ['site options'=>$siteOptions]);

						if ($_POST['option'] == 'enabled'){
							$datArr['site']['old'] = $siteOptions['enabled'];

							$siteOptions = json_decode($site['site_options'], true);
							$siteOptions['enabled'] = !$siteOptions['enabled'];

							if ($stmt2 = $pdo->prepare('UPDATE `sites` SET `site_options` = ? WHERE `site_id` = ?;')){
								array_push($datArr['msg'], 'PDO statement successfully prepared @ INSERT INTO sites');
								if ($stmt2->execute([json_encode($siteOptions), $_POST['site_id']])){
									array_push($datArr['msg'], 'PDO statement successfully executed @ INSERT INTO sites');
									array_push($datArr['msg'], ['Rows affected'=>$stmt2->rowCount()]);
									$datArr['site']['new'] = $siteOptions['enabled'];
									if ($stmt2->rowCount() == 1){
										array_push($datArr['msg'], 'Successfully updated the site data');
									} else {
										array_push($datArr['msg'], '/!\ Failed to update the site data');
									}
								} else {
									array_push($datArr['msg'], '/!\ PDO statement failed to execute @ INSERT INTO sites');
								}
							} else {
								array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ INSERT INTO sites');
							}
						} elseif ($_POST['option'] == 'showowner'){
							$datArr['site']['old'] = $siteOptions['showowner'];

							$siteOptions = json_decode($site['site_options'], true);
							$siteOptions['showowner'] = !$siteOptions['showowner'];

							if ($stmt2 = $pdo->prepare('UPDATE `sites` SET `site_options` = ? WHERE `site_id` = ?;')){
								array_push($datArr['msg'], 'PDO statement successfully prepared @ INSERT INTO sites');
								if ($stmt2->execute([json_encode($siteOptions), $_POST['site_id']])){
									array_push($datArr['msg'], 'PDO statement successfully executed @ INSERT INTO sites');
									array_push($datArr['msg'], ['Rows affected'=>$stmt2->rowCount()]);
									$datArr['site']['new'] = $siteOptions['showowner'];
									if ($stmt2->rowCount() == 1){
										array_push($datArr['msg'], 'Successfullyupdated the site data');
									} else {
										array_push($datArr['msg'], '/!\ Failed to update the site data');
									}
								} else {
									array_push($datArr['msg'], '/!\ PDO statement failed to execute @ INSERT INTO sites');
								}
							} else {
								array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ INSERT INTO sites');
							}
						} else {
							array_push($datArr['msg'], '/!\ Unknown OPTION type!');
						}

					} else {
						array_push($datArr['msg'], '/!\ You do not have permission for editing this site');
					}
				} else {
					array_push($datArr['msg'], '/!\ PDO statement failed to fetch @ SELECT FROM sites');
				}
			} else {
				array_push($datArr['msg'], '/!\ PDO statement failed to execute @ SELECT FROM sites');
			}
		} else {
			array_push($datArr['msg'], '/!\ PDO statement failed to prepare @ SELECT FROM sites');
		}
	} else {
		array_push($datArr['msg'], '/!\ Required data was not provided');
	}
} else {
	array_push($datArr['msg'], '/!\ You must login in order to manage your sites');
}


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
