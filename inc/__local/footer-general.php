<!-- START FOOTER -->
<footer class="page-footer blue-grey darken-2" id="footer" style="padding-top:0;">
  	<div class="container">
    	<div class="row">
      		<div class="col s12 l6">
        		<ul>
          			<li class="togglePreloader">
						<p class="grey-text text-lighten-4"></p>
						<div class="switch">
							<label class="grey-text text-lighten-4">
									Toggle preloader - Off
								<input type="checkbox">
								<span class="lever"></span>
									On
							</label>
						</div>
					</li>
        		</ul>
      		</div>
      		<div class="col s12 l3 offset-l3">
        		<ul>
          			<li><a href="/about">About</a></li>
          			<li><a href="/me">My dashboard</a></li>
          			<li><a class="terms-open" href="/terms.php">Terms of usage</a></li>
        		</ul>
      		</div>
    	</div>
  	</div>
  	<div class="footer-copyright">
    	<div class="container">
			© <span id="footer-now-year"></span> The Xena Project - aljaxus.eu
    		<span class="right">
				<a class="btn btn-flat btn-small waves-effect waves-light" target="_blank" href="https://dev.aljaxus.eu"><i class="fas fa-code"></i> aljaxus</a>
				<a class="btn btn-flat btn-small waves-effect waves-light" target="_blank" href="https://github.com/aljaxus/eu.aljaxus.xena/"><i class="fab fa-github"></i> GitHub</a>
			</span>
    	</div>
  	</div>
</footer>
<style media="all">
footer a {
	color: #eee !important;
	transition: all .3s !important;
}
footer a:hover {
	color: #64dcdc!important;
	transition: all .3s !important;
}
footer > .footer-copyright span > a:hover {
	background-color: #ffffff1f;
}
</style>
<script type="text/javascript">
	let d = new Date();
	document.getElementById("footer-now-year").innerHTML = d.getFullYear();
</script>
<!-- END FOOTER -->
