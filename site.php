<?php require_once __DIR__ . '/inc/_util/firstload.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- START META TAGS -->
	<title>Loading ... @ Xena</title>
	<?php require_once __DIR__ . '/inc/_local/_head_meta.html'; ?>
	<?php require_once __DIR__ . '/inc/_local/_head_includes.html'; ?>
</head>
<body>
<div id="loader-wrapper"></div>
<main>

<?php require_once __DIR__ . '/inc/_local/navbar-sidebar.php'; ?>

<!-- START CONTENT -->
<div class="row" id="siteMainCard">
	 <div class="col s12 m3 l3 xl2">
		 <div class="col s12 card" id="siteSidebar">
			<a class="profile_image" href="javascript:void(0)"><img src="https://xena.aljaxus.eu/src/img/512x512-00000000.png" alt="" class="circle responsive-img profile-picture z-depth-1"></a>
			<a class="profile_fullname" href="javascript:void(0)"><span>*************</span></a>
			<a class="profile_email" href="javascript:void(0)"><span>*************</span></a>
			<hr>
			<div class="col s12 indexSection">

			</div>
		 </div>
	 </div>
	 <div class="col s12 m8 l8 xl9">
		 <div class="col s12 card" id="siteContent">
			 <h5 class="center-align" style="display:block;">Loading data . . .</h5>
			 <div class="progress" style="width:80%;margin-left:10%">
				 <div class="indeterminate"></div>
			 </div>
		 </div>
	 </div>
</div>
<!-- END CONTENT -->

</main>
<?php require_once __DIR__ . '/inc/_local/footer-general.php'; ?>
<?php require_once __DIR__ . '/inc/_local/modal-terms.html'; ?>
</body>
</html>
<script>
$(document).ready(function(){
	$('.sidenav').sidenav();
	$('.tabs').tabs();
	gapi.load('auth2', function() {
		gapi.auth2.init();
	});

	{
		console.log('***************************************************');
		console.log('Render site process started...');
		console.log('|_ Site data:');
		console.log('|_ Get side data process started...');
		$.get(
			'/api/sites/get.site.data.php',
			{
				site_name: '<?php echo $_GET['par1'];?>'
			}, function(json, textStatus) {
				/*optional stuff to do after success */
			}
		).done(function(xhrData){
			console.log('|_ Finished API request -> /api/sites/get.site.data.php');
			console.log('|_ Server responded with');
			console.log(xhrData);

			if (xhrData.owner.is_shown == true){
				let el = $('#siteSidebar');
				el.find('a.profile_image').find('img').attr('src', xhrData.owner.u_picture);
				el.find('a.profile_fullname').find('span').html(xhrData.owner.u_name);
				el.find('a.profile_email').find('span').html(xhrData.owner.u_email);
				el.find('a.profile_email').attr('href', 'mailto://'+xhrData.owner.u_email);
			} else {
				let el = $('#siteSidebar');
				el.prepend('<span style="dislay:block;">User is not sharing his details</span>');
				el.find('a.profile_image').remove();
				el.find('a.profile_fullname').remove();
				el.find('a.profile_email').remove();
			}
			if (xhrData.metadata.enabled == true){
				document.title = xhrData.metadata.title+' @ Xena';
				let contentHtml = '';
				let siteIndexCounter = 1;
				let indexSection = $('#siteSidebar').find('.indexSection');

				console.log('|_ Started content parsing');
				function calcElement(elem){

					function calcElementForEach(a){
						if (a!=undefined){
							a.forEach(function(b){
								calcElement(b);
							});
						}
					}

					console.log(elem);

					switch (elem.el){
						case 'section':
							//Index-related

							//Content-related
							contentHtml += '<div style="width:100%!important;">';
							calcElementForEach(elem.contents);
							contentHtml += '</div>';
							break;
						case 'h1':
							//Content-related
							contentHtml += '<h1 class="'+(elem.class!=undefined?elem.class:'')+'" id="siteIndexCounter'+siteIndexCounter+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							contentHtml += '</h1>';
							//Index related
							if (elem.txt!=undefined){
								indexSection.append('<a href="/s/'+xhrData.metadata.name+'#siteIndexCounter'+siteIndexCounter+'" class="smoothScroll"><span class="indexFor-h1" style="display:block;">'+elem.txt+'</span></a>');
							}
							siteIndexCounter++;
							break;
						case 'h2':
							//Content-related
							contentHtml += '<h2 class="'+(elem.class!=undefined?elem.class:'')+'" id="siteIndexCounter'+siteIndexCounter+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							contentHtml += '</h2>';
							//Index related
							if (elem.txt!=undefined){
								indexSection.append('<a href="/s/'+xhrData.metadata.name+'#siteIndexCounter'+siteIndexCounter+'" class="smoothScroll"><span class="indexFor-h2" style="display:block;">'+elem.txt+'</span></a>');
							}
							siteIndexCounter++;
							break;
						case 'h3':
							//Content-related
							contentHtml += '<h3 class="'+(elem.class!=undefined?elem.class:'')+'" id="siteIndexCounter'+siteIndexCounter+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							contentHtml += '</h3>';
							//Index related
							if (elem.txt!=undefined){
								indexSection.append('<a href="/s/'+xhrData.metadata.name+'#siteIndexCounter'+siteIndexCounter+'" class="smoothScroll"><span class="indexFor-h3" style="display:block;">'+elem.txt+'</span></a>');
							}
							siteIndexCounter++;
							break;
						case 'h4':
							//Content-related
							contentHtml += '<h14 class="'+(elem.class!=undefined?elem.class:'')+'" id="siteIndexCounter'+siteIndexCounter+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							contentHtml += '</h4>';
							//Index related
							if (elem.txt!=undefined){
								indexSection.append('<a href="/s/'+xhrData.metadata.name+'#siteIndexCounter'+siteIndexCounter+'" class="smoothScroll"><span class="indexFor-h4" style="display:block;">'+elem.txt+'</span></a>');
							}
							siteIndexCounter++;
							break;
						case 'h5':
							//Content-related
							contentHtml += '<h5 class="'+(elem.class!=undefined?elem.class:'')+'" id="siteIndexCounter'+siteIndexCounter+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							contentHtml += '</h5>';
							//Index related
							if (elem.txt!=undefined){
								indexSection.append('<a href="/s/'+xhrData.metadata.name+'#siteIndexCounter'+siteIndexCounter+'" class="smoothScroll"><span class="indexFor-h5" style="display:block;">'+elem.txt+'</span></a>');
							}
							siteIndexCounter++;
							break;
						case 'p':
							//Content-related
							contentHtml += '<p class="'+(elem.class!=undefined?elem.class:'')+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							calcElementForEach(elem.contents);
							contentHtml += '</p>';
							break;
						case 'span':
							//Content-related
							contentHtml += '<span class="'+(elem.class!=undefined?elem.class:'')+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							calcElementForEach(elem.contents);
							contentHtml += '</span>';
							break;
						case 'a':
							//Content-related
							contentHtml += '<a href="'+(elem.href)+'" target="'+((elem.target!=undefined)?elem.target:'_blank')+'" class="'+(elem.class!=undefined?elem.class:'')+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							calcElementForEach(elem.contents);
							contentHtml += '</a>';
							break;
						case 'ul':
							//Content-related
							contentHtml += '<ul class="'+(elem.class!=undefined?elem.class:'')+'">';
							calcElementForEach(elem.contents);
							contentHtml += '</ul>';
							break;
						case 'li':
							//Content-related
							contentHtml += '<li class="'+(elem.class!=undefined?elem.class:'')+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							calcElementForEach(elem.contents);
							contentHtml += '</li>';
							break;
						case 'img':
							//Content-related
							contentHtml += '<br><a href="'+elem.src+'" target="_blank"><img class="'+(elem.class!=undefined?elem.class:'')+'" src="'+elem.src+'" alt="'+(elem.title!=undefined?elem.title:"")+'" width="'+(elem.width!=undefined?elem.width:"180px")+'" height="'+(elem.height!=undefined?elem.height:"auto")+'"></a>';
							// contentHtml += '<img src="'+elem.src+'" alt="'+elem.title+'" width="'+(elem.width!=undefined)?elem.width:"180px"+'" height="'+(elem.height!=undefined)?elem.height:"auto"+'">';
							break;
						default:
							//Content-related
							contentHtml += '<span class="'+(elem.class!=undefined?elem.class:'')+'">';
							contentHtml += (elem.txt!=undefined)?elem.txt:'';
							calcElementForEach(elem.contents);
							contentHtml += '</span>';
							break;
					}


				}

				xhrData.content.forEach(function(element){
					calcElement(element);
				});

				if (contentHtml != ''){
					$('#siteContent').html(null);
					$('#siteContent').html(contentHtml);
				}
				console.log('|_ Finished content parsing');
				$('.smoothScroll').click(function(event) {
					event.preventDefault();
			        //CLOSE THE DROPDOWN IN NAVIGATION
			        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			            let a = $(this.hash);
			            a = a.length ? a : $('[name=' + this.hash.slice(1) + ']');
			            if (a.length) {
			                $('html,body').animate({
			                    scrollTop: a.offset().top-80
			                }, 750); // The number here represents the speed of the scroll in milliseconds
			                return false;
			            }
			        }
			    });
				console.log('|_ Added smooth scroll to all # anchors');
			} else {
				document.title = 'Disabled - '+xhrData.metadata.title+' @ Xena';
				$('#siteContent').html('<div class="disabledSite"><h5 class="center-align" style="display:block;">This site was disabled by it\'s owner.</h5><a class="center-align btn waves-effect waves-teal btn-flat" href="/">Back to main page</a></div>');
			}

		}).fail(function(xhrData){
			console.log('|_ Failed to access server side site data API -> /api/sites/get.site.data.php');
		}).always(function(xhrData){
			console.log('|_ Get side data process ended...');
		});

		console.log('Render site process ended...');
	}
});
</script>
<!-- START CSS FILES -->
<link rel="stylesheet" href="/src/css/site_styler.css">
<!-- END CSS FILES -->
<!-- START SECONDARY SCRIPTS -->
<script src="/src/js/site_parser.js" charset="utf-8"></script>
<!-- END SECONDARY SCRIPTS -->
