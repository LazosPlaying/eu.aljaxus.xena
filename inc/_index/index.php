<!DOCTYPE html>
<html lang="en">
<head>
	<!-- START META TAGS -->
	<title>Home @ Xena</title>
	<?php require_once __DIR__ . '/../_local/_head_meta.php'; ?>
	<?php require_once __DIR__ . '/../_local/_head_includes.php'; ?>
</head>
<body>
<!-- START HEADER -->
<header>

</header>
<!-- END HEADER -->
<div id="loader-wrapper"></div>
<main>

<?php require_once __DIR__ . '/../_local/navbar-sidebar.php'; ?>

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
				<h2>Read more about Xena</h2>
				<p class="white-text">
					Did you know that Xena started as a school project, is developed and maintained by a single student, made by students for students?
					<br>
					It is also made simple. Simple to sign in, simple to manage account settings, switch between multiple accounts, simple to do anything, even remove all data linked to your account ...
					<br>
					... we do wish you will never leave us though :/
				</p>
				<a href="/about" class="waves-effect waves-light btn">Read more about The Xena Project</a>
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

<!-- START SECONDARY -->
<script>
$(document).ready(function(){
	$('.sidenav').sidenav();
	$('.carousel.carousel-slider').carousel({
		fullWidth: true,
		indicators: true,
		duration: 300
	}).css('height', '280px');
});
// setInterval(function(){
// 	$('#carousel1').carousel('next');
// }, 15000);
</script>
<!-- END SECONDARY -->
