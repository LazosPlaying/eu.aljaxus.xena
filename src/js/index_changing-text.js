$(document).ready(function() {
	let str 	= [
		"Make simple webpages",
		"Provide safe and simple signin system",
		"Make things fast",
		"Keep management simple",
		"Make data removal easier than ever"
	];

	let pos 	= 0;
	let a 		= 0;
	let html 	= "";
	str.forEach(function(el, i){str[i]=el+'       ';});
	function displayText() {
		if (pos >= str.length) pos = 0;
		if (a < str[pos].length) {
			html += str[pos].charAt(a);
			$('#topsection').find('h5[data-content="changing-text"]').children('span').html(html);
			a++;
		} else {
			a = 0;
			pos++;
			html = "";
		}
	}
	setInterval(displayText, 225);
});
