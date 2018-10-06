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
<style media="all">
div.abcRioButton.abcRioButtonBlue{
	width: 100%!important;
}
</style>
<script>
$(document).ready(function(){
	document.title = "Login @ Xena";
	$('.sidenav').sidenav();
	$('.tabs').tabs();
});
</script>
