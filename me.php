<?php require_once __DIR__ . '/inc/__util/firstload.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- START META TAGS -->
	<title>Loading ... @ Xena</title>
	<?php require_once __DIR__ . '/inc/__local/_head_meta.html'; ?>
	<?php require_once __DIR__ . '/inc/__local/_head_includes.html'; ?>
	<!-- END GOOGLE OAUTH -->
</head>
<body>
<!-- START HEADER -->
<header>
	<?php require_once __DIR__ . '/inc/__local/navbar-sidebar.php'; ?>
</header>
<!-- END HEADER -->
<div id="loader-wrapper"></div>
<main>
<!-- START CONTENT -->
<?php
if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged'] == true){
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
	require_once __DIR__ . '/inc/_me/signin.php';
}
?>
<!-- END CONTENT -->
</main>
<?php require_once __DIR__ . '/inc/__local/footer-general.php'; ?>
<?php require_once __DIR__ . '/inc/__local/modal-terms.html'; ?>
</body>
</html>
