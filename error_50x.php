<!DOCTYPE html>
<html lang="en-US" dir="LTR" class="Public">
<head>
    <!-- START META TAGS -->
    <title>Error 50X - An error occured on our side!</title>
	<?php require_once __DIR__ . '/inc/_local/_head_meta.php'; ?>
	<?php require_once __DIR__ . '/inc/_local/_head_includes.php'; ?>
</head>
<body>
	<div class="wrapper">
		<div class="buttonWrapper">
			<a class="button back Tooltip" title="Go Back" onclick="window.history.go(-1);"><i class="fa fa-long-arrow-left"></i></a>
			<a class="button home Tooltip" href="https://xena.aljaxus.eu" title="Return Home"><i class="fa fa-home"></i></a>
		</div>
	</div>
</body>
<style media="all">

@charset "UTF-8";

/* --- gfn404_error.css --- */

html, body {
	display: block;
	padding: 0;
	margin: 0;
	height: 100vh;
	width: 100vw;
	background-color: #222222;
	color: #ffffff;
	font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    background-image: url("/src/img/error-background1.png");
    background-size: cover;
    background-position: center;
}

body {
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-align: center;
	-moz-box-align: center;
	-ms-flex-align: center;
	align-items: center;
	-webkit-box-pack: center;
	-moz-box-pack: center;
	-ms-flex-pack: center;
	justify-content: center;
}

.wrapper {
	display: block;
	max-width: 90vw;
	margin: -10px auto 0;
	text-align: center;
}

.wrapper h1 {
	display: none;
}

.wrapper .404,
.wrapper .404 img {
	display: block;
	max-width: 100%;
}
small.message {
	color: #999999;
	font-size: 12px;
	margin: 0;
}
.buttonWrapper {
	display: block;
	margin: 30px 0 0;
}
.button,
.button:visited {
	display: inline-block;
	font-size: 20px;
	line-height: 20px;
	padding: 15px;
	cursor: pointer;
	box-shadow: 0 0 0 1px rgba(0,0,0,.08) inset;
	color: #ffffff;
	background-color: #2d78d5;
	border: 1px solid #276ec6;
	text-decoration: none !important;
	margin: 5px;
	transition: all .1s linear 0s;
	min-width: 85px;
	position: relative;
}
.button:hover,
.button:active,
.button:focus {
	background-color: #276ec6;
}
.button.home,
.button.home:visited {
	background-color: #85c744;
	border-color: #669e2f;
}
.button.home:hover,
.button.home:active,
.button.home:focus {
	background-color: #669e2f;
}
.button:active {
	box-shadow: 0 1px 3px rgba(0,0,0,.2) inset;
}
</style>
</html>
