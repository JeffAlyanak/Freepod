<!DOCTYPE html>
<html>
	<head>
		<?php
			require '../freepod/freepod.php';
		?>

			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Project 1</title>

	</head>
	<body>

<div class="jumbotron text-center">
	<h1><?php echo $fp_title; ?></h1>
	<p><?php echo $fp_description; ?></p>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
		<h3>Contact us</h3>
		<img src="image.php?i=1.jpg&s=Thumb&t=Scale" class="img-rounded" alt="Cinque Terre"> 
			<p><?php echo $fp_email; ?></p>
		</div>
		<div class="col-sm-4">
		<h3>Column 2</h3>
		<img src="image.php?i=2.jpg&s=Thumb&t=Scale" class="img-rounded" alt="Cinque Terre"> 
			<p>Lorem ipsum dolor..</p>
		</div>
		<div class="col-sm-4">
		<h3>Column 3</h3>
		<img src="image.php?i=3.jpg&s=Thumb&t=Scale" class="img-rounded" alt="Cinque Terre"> 
			<p>Lorem ipsum dolor..</p>
		</div>
	</div>
</div>

	</body>
</html>