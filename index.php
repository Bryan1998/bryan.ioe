<!DOCTYPE html>
<html lang="en-US">
	
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bryan Hernandez</title>
	<link rel="stylesheet" href="css/main.css" />
</head>

<body><ul class="topnav">
	<li><a class="active" href="index.php">Home</a></li>
	<li><a href="https://github.com/Bryan1998">GitHub</a></li>
	<li><a href="downloads">Downloads</a></li>
</ul> 
	<hr />
	<p><?php $min = 0; $max = 100; echo("A very random number between ".$min." and ".$max." is ".mt_rand($min,$max));?></p>
</body>

</html>
