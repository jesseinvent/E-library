<?php
$page = "SEARCH";
include('includes/header.php');

require_once "includes/helpers.php";
require_once "includes/functions.php";

$category = clean($_GET['search']);
?>
<br>
<div class="container shadow-lg p-3">


	<h1>Books found on "<?php echo $category; ?>"</h2>

<hr>


<h1 class="m-1" style="font-size: 1.2rem; letter-spacing:3px; font-family: fantasy; margin: 0px; color:#ddd;"><?php echo count(getBooksByCategory($category)) ?> Book(s) found</h1>

<div id="books" class="d-flex justify-content-around flex-wrap m-3">

<?php 
if(count(getBooksByCategory($category)) == 0){

	echo "No books uploaded on this category";

} else {

	foreach(getBooksByCategory($category) as $book ){
?>
	<!----><div class='card p-2 shadow' style='width: 170px;'>

		<img class='card-img-top' src='<?php echo $link; ?>book-images/<?php echo $book->cover_photo; ?>' height='160'>
							<div class='card-body bg-light'>
							<h3 class='card-title' style='font-size: 15px;'><?php echo $book->title; ?></h3>

								<!--- view product btn -->

								<form action='view-book.php' method='post'>

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

</div> <!----end of container--->


	<?php include "includes/footer.php"; ?>