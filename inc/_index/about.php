<!DOCTYPE html>
<html lang="en">
<head>
	<!-- START META TAGS -->
	<title>About @ Xena</title>
	<?php require_once __DIR__ . '/../_local/_head_meta.html'; ?>
	<?php require_once __DIR__ . '/../_local/_head_includes.html'; ?>
	<!-- END GOOGLE OAUTH -->
</head>
<body>
<!-- START HEADER -->
<header>
	<?php require_once __DIR__ . '/../_local/navbar-sidebar.php'; ?>
</header>
<!-- END HEADER -->
<div id="loader-wrapper"></div>
<main>

<!-- START CONTENT -->
<div class="row">
	<div class="col s12 m12 l12 card" id="topsection">
		<div class="col s12 m10 l8 xl8 offset-s0 offset-m1 offset-l2 offset-xl2">
			<h5 data-content="title-text" class="center-align">About Xena Project</h5>
		</div>
	</div>
</div>
<!-- END CONTENT -->
</main>
<?php require_once __DIR__ . '/../_local/footer-general.php'; ?>
<?php require_once __DIR__ . '/../_local/modal-terms.html'; ?>
</body>
</html>
<!-- START CSS -->
<link rel="stylesheet" href="/src/css/index_about-topsection.css">
<!-- END CSS -->
<!-- START SCRIPTS -->
<script>
$(document).ready(function(){
	$('.sidenav').sidenav();
});

</script>
<!-- END SCRIPTS -->
