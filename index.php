<?php

require_once __DIR__ . '/inc/_util/firstload.php';

if (!empty($_GET['par1'])){
	$path = __DIR__ . '/inc/_index/'.$_GET['par1'].'.php';
	if (file_exists($path)){
		require_once $path;
	} else {
		require_once __DIR__ . '/error_404.php';
	}
} else {
	require_once __DIR__ . '/inc/_index/index.php';
}
