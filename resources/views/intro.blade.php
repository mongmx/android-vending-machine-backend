<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>Vending Machine</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body style="background-color: #C6EFFF;">
	<div style="position: fixed; top: 50%; left: 50%; margin-top: -320px; margin-left: -512px;">
		<img id="introimg" src="{{ asset('/intro_2.png') }}" style="visibility: hidden;">
		<a href="/products" style="position: absolute; bottom: 65px; left: 50%; margin-left: -141px;">
			<img id="introbtn" src="{{ asset('/entersite.png') }}" style="visibility: hidden;">
		</a>
	</div>

	<script type="text/javascript">
		window.onload = function() { 
			document.getElementById("introimg").style.visibility = "visible"; 
			document.getElementById("introbtn").style.visibility = "visible"; 
		}
	</script>
</body>
</html>
