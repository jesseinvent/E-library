<!DOCTYPE html>
<html>
<?php require_once "includes/functions.php"; ?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>  
	  <script src="js/jquery.min.js"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="css/style.css">

         <script src="js/bootstrap.min.js"></script></head>

<body>

	<!-- adding navigation bootstrap -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">KINGDOM LIBRARY</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">

					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>

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
				<li class="nav-item"><a class="nav-link " href="gallary.php">Gallary</a></li>
				<li><a class="nav-link " href="<?php echo $link; ?>login.php">Login</a></li>
				<li><a class="nav-link " href="<?php echo $link; ?>register.php">Register</a></li>
				<li><a class="nav-link " href="#">About</a></li>
				<li><a class="nav-link " href="#">Contact</a></li>
			</ul>
			<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
				<input class="form-control mr-sm-2" name="search" type="search" placeholder="Search books" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>

	<div id="background-carousel">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image:url(http://placehold.it/1600x800/)"></div>
        <div class="item" style="background-image:url(http://placehold.it/1600x800/)"></div>
        <div class="item" style="background-image:url(http://placehold.it/1600x800/)"></div>  
      </div>
    </div>
</div>
 
	<!-- centered heading -->
 <div id="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="" id="content">
					<h1>KINGDOM LIBRARY</h1>
					<a href="gallary.php"><button class="btn bg-light btn-lg">VISIT BOOKS GALLARY</button></a>
				</div>
			</div>
		</div>
	</div>
 </div>
	
	<?php include "includes/footer.php"; ?>




