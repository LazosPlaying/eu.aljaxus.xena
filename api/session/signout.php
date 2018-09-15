<?php
require_once __DIR__ . '/../../inc/_util/firstload.php';
require_once __DIR__ . '/../../inc/googleApiCli/vendor/autoload.php';

$datArr = array(
	'POST' => (!empty($_POST)) ? $_POST : null,
	'is_tokendestroyed' => null
);

$client = new Google_Client(['client_id' => _GAUTH_CLIID]);
$client->revokeToken();

session_unset();
session_destroy();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
Header('Content-type: application/json');
echo json_encode($datArr, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
