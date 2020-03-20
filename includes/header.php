<?php require_once "functions.php"; ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $page; ?></title>  
	  <script src="<?php echo $link; ?>js/jquery.min.js"></script>
   <link href="<?php echo $link; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $link; ?>css/bootstrap.css" rel="stylesheet" media="screen">
	<!-- <link rel="stylesheet" type="text/css" href="css/style2.css"> -->
<link rel="stylesheet" href="<?php echo $link ?>css/style2.css">
         <script src="<?php echo $link; ?>js/bootstrap.min.js"></script></head>

<body>
	<!-- adding navigation bootstrap -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
		<a class="navbar-brand" href="#" style="font-size: 1.5rem; font-family: fantasy; margin: 0px;">KINGDOM LIBRARY</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo $link; ?>index.php">Home <span class="sr-only">(current)</span></a>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Genre
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<?php
							foreach (getCategories() as $category) {

								echo '<a class="dropdown-item" href='.$link.'search.php?search='.$category['category'].'>'.$category['category'].'</a>
								';
							}
					?>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="<?php echo $link; ?>gallary.php">Gallary</a>
				</li>
				<li><a class="nav-link " href="<?php echo $link; ?>login.php">Login</a></li>
				<li><a class="nav-link " href="<?php echo $link; ?>register.php">Register</a></li>
				<li><a class="nav-link " href="#">Contact</a></li>
			</ul>

		
		</div>
	</nav>

	<?php // include('leftbar.php'); ?>