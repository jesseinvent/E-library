<?php ob_start();
session_start();
?>


<?php 

if(isset($_SESSION['bookID'])){

?>



<?php
	$page = "VIEW BOOK";
	include('includes/header.php');
	require_once "includes/helpers.php";

	$id = clean($_SESSION['bookID']);

?>

<?php
	if(isset($_POST['view-book'])){

		if(saveBookIdSession($_POST['bookId'])){

			header("location: ".$link."view-book.php");
		}
	}

?>

<div class="container">


<?php

	$sql = "SELECT title, category, pages, cover_photo, book_file, description FROM books WHERE book_id = ? ";
	$stmt = $db_con->prepare($sql);
	$stmt->execute([$id]);
	$book = $stmt->fetch(PDO::FETCH_OBJ);

	$category = $book->category;
?>

<!--------------------------------------------------->

		<div class='card shadow-lg m-2 p-4 mx-auto'>
        <h2 class="h2"><?php echo $book->title; ?></h2>

            <p class="d-flex justify-content-center">
            <a href = "<?php echo $link; ?>book-images/<?php echo $book->cover_photo; ?>"><img src='<?php echo $link; ?>book-images/<?php echo $book->cover_photo; ?>' id='producPic' class='p-1 mx-auto' width='300' height='300'/></a>
            </p>
				<div class='card-body'>
                    <h3 class='card-title' style='font-size: 15px;'><?php echo $book->title; ?></h3>
                    <p class="">Category: <?php echo $book->category; ?></p>
                    <p>Description: <?php echo $book->description; ?></p>
					<p>Pages: <?php echo $book->pages; ?></p>
				</div>
		<div id="info">
		
		</div>

        <div class="d-flex justify-content-center"> 
			<input type="hidden" id="link" value="<?php echo $link  ?>books/<?php echo $book->book_file; ?>">      
           <button class="btn btn-success m-2" id="view">View Book</button>
           <a href="<?php echo $link  ?>books/<?php echo $book->book_file; ?>" alt="<?php echo $book->book_file; ?>" download><button class="btn btn-primary m-2" id="download">Download Book</button></a>
        </div>
		</div>






<br>
<br>


        <hr>


<!-------------------------------other-books---------------------------------------------------->

<h2>Other Books on this category</h2>
<br>

	<div id="books" class="d-flex justify-content-around flex-wrap mb-4">

<?php

if(count(getBooksByCategory($category)) <= 1 ){

	echo "No other books on this category";

} else {

	foreach(getBooksByCategory($category) as $book){


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



		</div>

	</div><!--end of books block--->

<?php 

// view($id);
?>

</div> <!----end of container--->


	<?php include "includes/footer.php"; ?>

	<script type="text/javascript" src="js/ajax/record.js"> </script>

<?php 
} else {

	header("location:".$link."gallary.php");

	}
	
?>