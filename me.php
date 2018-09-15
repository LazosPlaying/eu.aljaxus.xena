<?php
require_once __DIR__ . '/inc/_util/firstload.php';

if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged'] === true ){
	require_once __DIR__ . '/inc/_me/dashboard.php';
} else {
	require_once __DIR__ . '/inc/_me/login.php';
}
