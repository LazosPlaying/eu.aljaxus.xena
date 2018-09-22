<?php
require_once __DIR__ . '/inc/_util/firstload.php';

if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged'] === true ){
	if (!empty($_GET['par1'])){
		$path = __DIR__ . '/inc/_me/'.$_GET['par1'].'.php';
		if (file_exists($path)){
			require_once $path;
		} else {
			require_once __DIR__ . '/error_404.php';
		}
	} else {
		require_once __DIR__ . '/inc/_me/dashboard.php';
	}
} else {
	require_once __DIR__ . '/inc/_me/login.php';
}
