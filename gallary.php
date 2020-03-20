<?php ob_start();
session_start();
?>

<?php
$page = "GALLARY";
require_once('includes/header.php'); 

if(isset($_POST['view-book'])){

	if(saveBookIdSession($_POST['bookId'])){

		header("location: ".$link."view-book.php");
	}
}
?>


<br>
<div class="container shadow-lg p-3">

<div class="d-flex align-items-center justify-content-around flex-wrap">

<div class="form-group col-9">
				<input class="form-control" name="filter" type="search" id="filter" placeholder="Filter books" aria-label="Search">
</div>

	<div class="form-group col-3">
			<select name='search' class='custom-select' id='category'>
				<option value="">Choose Category</option>
				<?php
							foreach (getCategories() as $category){

								 echo '<option value="'.$category['category'].'" class="search" id="search">'.$category['category'].'</option>';

							}
					?>
			</select>
	</div>

</div>

	

<h1 class="text-shadow" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">GALLARY</h1>

<hr>

<div id="main-div">


<?php 


foreach (getCategories() as $category){

?>


<!-----------categories----------->

<h1 class="m-2 ml-3" style="font-size: 1.2rem; letter-spacing:3px; font-family: fantasy; margin: 0px; color:#ddd;" id="books"><?php echo ucfirst($category['category']); ?></h1>

	<div id="books" class="d-flex justify-content-around flex-wrap m-3 p-3">

<?php 

if(count(getBooksByCategory($category['category'])) == 0){

	echo "No books uploaded on this category";
} else {

	foreach(getBooksByCategory($category['category']) as $book ){
?>


	<!----><div class='card p-2 shadow' style='width: 170px;'>

		<img class='card-img-top' src='<?php echo $link; ?>book-images/<?php echo $book->cover_photo; ?>' height='160'>
							<div class='card-body bg-light'>
							<h3 class='card-title' style='font-size: 15px;'><?php echo $book->title; ?></h3>

								<!--- view product btn -->

								<form action='' method='post'>

									<input type='hidden' name='bookId' value='<?php echo $book->book_id; ?>'>
									<button type='submit' name='view-book' class='btn btn-primary btn-sm' style='margin: 0px;'>View Book</button>
									
								</form>
						</div>
			</div><!---->

<?php 

	}
}	

?>

</div><!--end of books block--->

<hr>

<?php 

}

?>

</div>

</div> <!----end of container--->


	<?php include "includes/footer.php"; ?>

	<script src="js/ajax/gallary.js"></script>