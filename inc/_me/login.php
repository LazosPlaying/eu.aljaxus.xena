<!DOCTYPE html>
<html lang="en">
<head>
	<!-- START META TAGS -->
	<title>Me @ Xena</title>
	<?php require_once __DIR__ . '/../_local/_head_meta.html'; ?>
	<?php require_once __DIR__ . '/../_local/_head_includes.html'; ?>
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
	<div class="col s12 m8 l6 xl4 offset-s0 offset-m2 offset-l3 offset-xl4">
		<div class="card blue lighten-3" style="margin-top: 10vh;">
			<div class="card-tabs">
				<ul class="tabs tabs-fixed-width">
					<li class="tab"><a class="active" href="#google_signin">Sign in with google</a></li>
				</ul>
			</div>
			<div class="card-content grey lighten-4">
				<div id="google_signin">
					<div class="row">
						<div class="col s12 m6 l6 offset-s0 offset-m3 offset-l3">
							<div
								class="g-signin2 center-align"
								data-onfailure="googleOauth_onSignInError"
								data-onsuccess="googleOauth_onSignInSuccess"
								data-longtitle="true"
								data-theme="dark"
								data-prompt="select_account"
								data-immediate="false"
							></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->

</main>
<?php require_once __DIR__ . '/../_local/footer-general.php'; ?>
<?php require_once __DIR__ . '/../_local/modal-terms.html'; ?>

<!--
<div
	class="g-signin2"
	data-onfailure="googleOauth_onSignInError"
	data-onsuccess="googleOauth_onSignInSuccess"
	data-theme="dark"
></div>
<a href="javascript:void(0)" onclick="googleOauth_onSignOut();">Sign out</a>
 -->

</body>
</html>
<!-- START CSS FILES -->
<style media="all">
div.abcRioButton.abcRioButtonBlue{
	width: 100%!important;
}
</style>
<!-- END CSS FILES -->

<!-- START SECONDARY SCRIPTS -->
<script>
$(document).ready(function(){
	$('.sidenav').sidenav();
	$('.tabs').tabs();
});
</script>
<!-- END SECONDARY SCRIPTS -->
