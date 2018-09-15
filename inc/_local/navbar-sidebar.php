<!-- START NAVBAR -->
<nav class="blue darken-1">
	<div class="nav-wrapper">
		<a href="/" class="brand-logo waves-effect" style="">Xena Project</a>
		<a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a class="waves-effect" href="/me"><i class="material-icons left">dashboard</i> My dashboard</a></li>
			<?php if (isset($_SESSION['u_isloged'])===true) : ?>
				<li><a class="waves-effect" href="javascript:void(0)" onClick="googleOauth_onSignOut();"><i class="material-icons left">exit_to_app</i> Logout</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
<style media="screen">
nav .brand-logo {
	padding:0 30px;
}
@media only screen and (max-width: 600px) {
	nav .brand-logo {
		padding: 0;
		margin-left: 0!important;
	}
}
@media only screen and (min-width: 600px) {
	nav .brand-logo {
		padding: 0 15px;
	}
}
@media only screen and (min-width: 992px) {
	nav .brand-logo {
		padding: 0 20px;
	}
}
</style>
<!-- END NAVBAR -->

<!-- START SIDEBAR -->
<ul id="slide-out" class="sidenav">
	<?php if (!empty($_SESSION['u_isloged']) && $_SESSION['u_isloged']===true): ?>
		<li>
			<div class="user-view">
				<div class="background">
					<img src="https://xena.aljaxus.eu/src/img/512x512-00000000.png" style="background-image:url('https://xena.aljaxus.eu/src/img/photo-1498611291069-aa296192f1e4.jpg');background-position:center bottom;background-size:100% auto;background-repeat:no-repeat;width:300px;height:160px;">
				</div>
				<a href="javascript:void(0)"><img class="circle z-depth-1" src="<?php echo $_SESSION['u_picture']; ?>" alt="Profile picture" style="background-color:rgba(255,255,255,0.25)"></a>
				<a href="javascript:void(0)"><span class="white-text name"><?php echo $_SESSION['u_name']; ?></span></a>
				<a href="javascript:void(0)"><span class="white-text email"><?php echo $_SESSION['u_email']; ?></span></a>
			</div>
		</li>
	<?php endif; ?>
	<!-- <li><a class="waves-effect" href="/me"><i class="material-icons">dashboard</i> User area</a></li> -->
	<!-- <li><div class="divider"></div></li> -->
	<li><a class="waves-effect" href="/me"><i class="material-icons">dashboard</i> My dashboard</a></li>
	<?php if (isset($_SESSION['u_isloged'])===true) : ?>
		<li><a class="waves-effect" href="javascript:void(0)" onClick="googleOauth_onSignOut();"><i class="material-icons">exit_to_app</i> Logout</a></li>
	<?php endif; ?>
</ul>
<!-- END SIDEBAR -->
