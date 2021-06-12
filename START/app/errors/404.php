<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<style>
	body {
		height: 100Vh;
		display:  flex;
		align-items: center;
		justify-content: center;
		font-size: 30px;
		background: aliceblue;
	}

	#wrapper_error {
		text-align: center;	
	}

	#error_id {
		color: red;
	}
</style>
<body>
	<div id="wrapper_error">
		<h1 id="error_id">404</h1>
		<h2 id="error_msg"><?= $message ?></h2>
	</div>
</body>
</html>