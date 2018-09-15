function googleOauth_onSignInError() {
	console.log('***************************************************');
	console.log('Google OAuth failed!');
};
function googleOauth_onSignInSuccess(googleUser) {
	var profile = googleUser.getBasicProfile();
	let userData = {
		id: profile.getId(),
		fullname: profile.getName(),
		givenname: profile.getGivenName(),
		familyname: profile.getFamilyName(),
		imageurl: profile.getImageUrl(),
		email: profile.getEmail(),
		token: googleUser.getAuthResponse().id_token
	};
	console.log('***************************************************');
	console.log('User signin process started...');
	console.log('|_ Google OAuth data');
	console.log(userData);
	console.log('-> Requesting server side session start');
	$.post(
		'/api/session/signin.php',
		{
			id: userData.id,
			fullname: userData.fullname,
			givenname: userData.givenname,
			imageurl: userData.imageurl,
			email: userData.email,
			token: userData.token
		},
		function(data, textStatus, xhr) {
		}
	).done(function(xhrData){
		console.log('|_ Successful signin on server side!');
		console.log('|_ Server responded with');
		console.log(xhrData);
		location.reload();
	}).fail(function(xhrData){
		console.log('|_ Failed to access server side signin API -> /api/session/signin.php');
	}).always(function(xhrData){
		console.log('User signin process finished...');
	});
};
function googleOauth_onSignOut(url = 'refresh') {
	console.log('***************************************************');
	console.log('User signout process started...');
	console.log('-> Requesting server side session end');
	$.post(
		'/api/session/signout.php',
		{
			logout: 'logout'
		},
		function(data, textStatus, xhr) {
		}
	).done(function(xhrData){
		console.log('|_ Successful signout on server side!');
		console.log('|_ Server responded with');
		console.log(xhrData);
		location.reload();
	}).fail(function(xhrData){
		console.log('|_ Failed to access server side logout API -> /api/session/signout.php');
	}).always(function(xhrData){
		console.log('User signout process finished...');
	});
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.disconnect();
	auth2.signOut().then(function () {
		console.log('Successful google oAuth signout');
	});
}
