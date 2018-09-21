<!DOCTYPE html>
<html lang="en">
<head>
	<!-- START META TAGS -->
	<title>Me @ Xena</title>
	<?php require_once __DIR__ . '/../_local/_head_meta.html'; ?>
	<?php require_once __DIR__ . '/../_local/_head_includes.html'; ?>
</head>
<body>
<div id="loader-wrapper"></div>
<main>

<?php require_once __DIR__ . '/../_local/navbar-sidebar.php'; ?>

<!-- START CONTENT -->
<div class="row">
	<div class="col s12 m12 l3 xl2 hide-on-med-and-down">
		<div class="card sidebar">
			<a class="profile_image" href="javascript:void(0)"><img src="<?php echo $_SESSION['u_picture'];?>" alt="Profile picture" class="circle responsive-img profile-picture z-depth-1"></a>
			<a class="profile_fullname" href="javascript:void(0)"><span><?php echo $_SESSION['u_name'];?></span></a>
			<a class="profile_email" href="javascript:void(0)"><span><?php echo $_SESSION['u_email'];?></span></a>
		</div>
	</div>
	<div class="col s12 m12 l8 xl9">
		<div class="col s12 m12 l12 card">
			<div class="col s12 m12 l12 main-sitelist">
				<div class="col s12 m12 l12 main-sitelist-site">
					<h5 class="center-align">Loading site data . . .</h5>
					<div class="progress" style="width:80%;margin-left:10%">
						<div class="indeterminate"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->
<!-- START MODALS -->
<div id="modal-sites_importexportcontent" class="modal" style="max-height:98%;">
	<div class="modal-content">
		<h4>Import / export content</h4>
		<p>Site: <span data-content="site_name"></span></p>
		<hr>
		<p>Please click on the "select file" button, select a file that contains the site content data and click on "import" button bellow</p>
		<form data-action="importContent">
			<div class="file-field input-field">
				<div class="btn waves-effect waves-light blue inputbtn-import" style="height:36px;line-height:36px;float:unset;margin-right:14px;">
					<span>Select file</span>
					<input type="file" name="importfile" accept="application/json">
				</div>
				<div class="file-path-wrapper" style="display:none!important;">
					<input class="file-path validate" type="text">
				</div>
				<button type="submit" class="waves-effect waves-green btn-flat confirm-import" style="background-color:rgba(76, 175, 80, 0.3) !important;" data-action="confirm-import">Import content</button>
			</div>
		</form>
		<hr>
		<p>In order to export site content, click the button bellow. A new tab will open and the download will start.</p>
		<a class="waves-effect waves-light btn btn-small blue" href="" data-action="exporturl" style="height:29px;margin:0 2px;padding:0 10px;" download><i class="material-icons left" style="margin:-0.81px 4px 0 0;font-size:1.4rem;">cloud_download</i> Export content</a>
	</div>
	<div class="modal-footer">
		<a class="modal-close waves-effect waves-red btn-flat" style="background-color:rgba(244, 67, 54, 0.3) !important">Cancel</a>
	</div>
</div>

<!-- END MODALS -->
</main>
<?php require_once __DIR__ . '/../_local/footer-general.php'; ?>
<?php require_once __DIR__ . '/../_local/modal-terms.html'; ?>
</body>
</html>
<!-- START CSS  -->
<style>
main > div > div > div.card {
	padding: 7px;
}
.sidebar {
	padding-left: 16px!important;
}
.sidebar > a:nth-child(2) > span {
	margin-top: 16px;
}
.sidebar > a:nth-last-child(1) > span {
	margin-bottom: 16px;
}
.sidebar > a > span,
.sidebar > a > img {
	display: block;
}
div.main-sitelist tr > td > button,
div.main-sitelist tr > td > a {
	margin: 0 2px;
	padding: 0 10px;
}
div.main-sitelist tr > td > button > i,
div.main-sitelist tr > td > a > i {
	margin: 0;
}
</style>
<!-- END CSS  -->

<!-- START  SCRIPTS -->
<script>
$(document).ready(function(){
	$('.sidenav').sidenav();
	$('.tabs').tabs();
	gapi.load('auth2', function() {
    	gapi.auth2.init();
  	});
	{
		console.log('***************************************************');
		console.log('Get my sites process started...');
		console.log('|_ Get my sites process started...');
		$.get(
			'/api/sites/get.my.sites.php',
			{
			}, function(json, textStatus) {
				/*optional stuff to do after success */
			}
		).done(function(xhrData){
			console.log('|_ Finished API request -> /api/sites/get.my.sites.php');
			console.log('|_ Server responded with');
			console.log(xhrData);
			let sites = $('div.main-sitelist');
			sites.html(null);
			if (xhrData.sites.length > 0){
				let siteHtml = '<table><thead><tr><th>Name</th><th>Display name</th><th>Options</th><th>Actions</th></tr></thead><tbody>';
				xhrData.sites.forEach(function(site){
					console.log(site);
					siteHtml += '<tr data-siteid="'+site.id+'">';
						siteHtml += '<td>'+site.name+'</td>';
						siteHtml += '<td>'+site.displayname+'</td>';
						siteHtml += '<td class="options">';
							siteHtml += '<a href="javascript:void(0)" class="sites-tooltipped waves-effect waves-light btn-small '+(site.options.showowner==true?"green":"red")+'" data-option="showowner" data-position="top" data-tooltip="'+(site.options.showowner==true?"Disable":"Enable")+' owner details visibility"><i class="material-icons left">'+(site.options.showowner==true?"visibility":"visibility_off")+'</i></a>';
							siteHtml += '<a href="javascript:void(0)" class="sites-tooltipped waves-effect waves-light btn-small '+(site.options.enabled==true?"green":"red")+'" data-option="enabled" data-position="top" data-tooltip="'+(site.options.enabled==true?"Disable":"Enable")+' this site"><i class="material-icons left">'+(site.options.enabled==true?"lock_open":"lock")+'</i></a>';
						siteHtml += '</td>';
						siteHtml += '<td class="actions">';
							siteHtml += '<a href="https://xena.aljaxus.eu/s/'+site.name+'" target="_blank" class="sites-tooltipped waves-effect waves-light btn-small blue darken-1" data-action="view" data-position="top" data-tooltip="Go to this site"><i class="material-icons left">open_in_new</i></a>';
							siteHtml += '<a href="javascript:void(0)" class="sites-tooltipped waves-effect waves-light btn-small amber darken-2" data-action="edit" data-position="top" data-tooltip="Edit this site"><i class="material-icons left">edit</i></a>';
							siteHtml += '<a href="javascript:void(0)" class="sites-tooltipped waves-effect waves-light btn-small red" data-action="delete" data-position="top" data-tooltip="Delete this site"><i class="material-icons left">delete</i></a>';
						siteHtml += '</td>';
					siteHtml += '</tr>';
				});
				siteHtml += '<tr><td></td><td></td><td></td><td>';
						siteHtml += '<a href="javascript:void(0)" class="sites-tooltipped waves-effect waves-light btn-small blue" data-action="createnew" data-position="top" data-tooltip="Create new site"><i class="material-icons left">add</i></a>';
				siteHtml += '</td></tr>';
				siteHtml += '</tbody></table>';
				sites.html(siteHtml);
				$('.sites-tooltipped').tooltip();

				sites.find('td.options').find('a').on('click', function(){
					let $this = $(this);
					let option = $this.attr('data-option');
					let site_id = 1;

					console.log('***************************************************');
					console.log('Update site options process Started...');
					$this.attr('disabled', true);
					$.post(
						'/api/sites/update.site.options.php',
						{
							site_id: site_id,
							option: option
						}, function(json, textStatus) {
							/*optional stuff to do after success */
						}
					).done(function(xhrData){
						console.log('|_ Successfully sent data to the API');
						console.log('|_ Server responded with');
						console.log(xhrData);
						$this.removeClass( xhrData.site.new==true?'red':'green' ).addClass( xhrData.site.new==true?'green':'red');
						if (option==='showowner'){
							$this.html('<i class="material-icons left">'+(xhrData.site.new==true?"visibility":"visibility_off")+'</i>');
						} else if (option==='enabled'){
							$this.html('<i class="material-icons left">'+(xhrData.site.new==true?"lock_open":"lock")+'</i>');
						}
					}).fail(function(xhrData){
						console.log('|_ Failed to access server side site data API -> /api/sites/update.site.options.php');
					}).always(function(xhrData){
						setTimeout(function(){
							$this.attr('disabled', false);
						}, 350);
						console.log('|_ Update site options process ended...');
					});
				});

			} else {
				let siteHtml = '<table><thead><tr><th>Name</th><th>Display name</th><th>Options</th><th>Actions</th></tr></thead><tbody>';
				siteHtml += '<tr><td></td><td></td><td></td><td>';
						siteHtml += '<a href="javascript:void(0)" class="sites-tooltipped waves-effect waves-light btn-small blue" data-action="createnew" data-position="top" data-tooltip="Create new site"><i class="material-icons left">add</i></a>';
				siteHtml += '</td></tr>';
				siteHtml += '</tbody></table>';
				sites.html(siteHtml);
				$('.sites-tooltipped').tooltip();
			}

		}).fail(function(xhrData){
			console.log('|_ Failed to access server side site data API -> /api/sites/get.my.sites.php');
		}).always(function(xhrData){
			console.log('|_ Get my sites process ended...');
		});

	}
});
</script>
<!-- END  SCRIPTS -->
