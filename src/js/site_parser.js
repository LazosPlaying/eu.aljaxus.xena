function renderSite(site_name, mainEl = '#siteMainCard'){
	let sideData;


	console.log('***************************************************');
	console.log('Render site process started...');
	console.log('|_ Site data:');
	console.log('-> Get side data process started...');
	$.get(
		'/api/sites/get.site.data.php',
		{
			site_name: site_name
		}, function(json, textStatus) {
			/*optional stuff to do after success */
		}
	).done(function(xhrData){
		console.log('  |_ Server responded with');
		console.log(xhrData);
		sideData = xhrData;
	}).fail(function(xhrData){
		console.log('  |_ Failed to access server side site data API -> /api/sites/get.site.data.php');
		sideData = false;
	}).always(function(xhrData){
		console.log('  |_ Finished API request -> /api/sites/get.site.data.php');
		console.log('  |_ Get side data process ended...');
	});

	if (sideData){

	} else {
		// Site data could not be accessed
	}


	console.log('Render site process ended...');
}
