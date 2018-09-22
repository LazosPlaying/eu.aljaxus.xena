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
	<div class="col s12 m10 l8 offset-s0 offset-m1 offset-l2">
		<div class="carousel carousel-slider center" id="carousel1">
			<div class="carousel-item blue white-text" href="javascript:void(0)">
				<h2>Fourth Panel</h2>
				<p class="white-text">This is your fourth panel</p>
			</div>
		    <div class="carousel-item red white-text" href="javascript:void(0)">
		    	<h2>First Panel</h2>
		    	<p class="white-text">This is your first panel</p>
		    </div>
		    <div class="carousel-item amber white-text" href="javascript:void(0)">
		    	<h2>Second Panel</h2>
		    	<p class="white-text">This is your second panel</p>
		    </div>
		    <div class="carousel-item green white-text" href="javascript:void(0)">
		    	<h2>Third Panel</h2>
		    	<p class="white-text">This is your third panel</p>
		    </div>
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
<!-- END CSS -->

<!-- START SCRIPTS -->
<script>
$(document).ready(function(){
	$('.sidenav').sidenav();
});

</script>
<!-- END SCRIPTS -->
