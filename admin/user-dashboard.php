<?php ob_start();
session_start();
?>
<?php if(!isset($_SESSION["userID"])){ header("location: ../login.php"); } ?>
<?php

 $page="ADMIN DASHBOARD";
 include("../includes/header.php");
 require_once "functions/admin_functions.php";
?>

<?php
	if(isset($_POST['view-book'])){

		if(saveBookIdSession($_POST['bookId'])){

			header("location: ".$link."view-book.php");
		}
	}

	if(isset($_POST['delete-book'])){


			deleteBook(clean($_POST['bookId']));

		// if(saveBookIdSession($_POST['bookId'])){

		// 	header("location: delete-book.php");
		// }
	}	


?>



<?php if(checkUserStatus()){?>

<div class="container">


<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;"><?php echo getUserName(); ?> Dashboard</h1>

<div class="shadow"> 
	
	<a href="upload-book.php"> <button class="btn btn-default">Upload Book</button> </a>
	

</div>

<!---------------------------------------Approved------------------------------->

<div class="card shadow-lg p-3 mt-2">  

<h1 class="p-1" style="font-size: 1.5rem; letter-spacing:3px; font-family: fantasy; margin: 2px; color:#ddd;" id="books-found">Books You've uploaded</h1>


<div id="books">

<div class="table-responsive">
                                         
										 <table class="table" id="books-table">

											 <tbody>
	<?php 
	try {
			$id = $_SESSION["userID"];
			$status = 1;
			$sql = "SELECT * FROM books WHERE user_id = ? AND status = ?";
			$stmt = $db_con->prepare($sql);
			$stmt->execute([$id, $status]);
			$books = $stmt->fetchAll();

			if(count($books) == 0){

				echo "No books uploaded";

			} else {

				 foreach($books as $book){
	
	?>
<!----><tr>
						<td><img class='image-responsive' src='<?php echo $link; ?>/book-images/<?php echo $book['cover_photo']; ?>' height='60' width="60"></td>
						<td><?php echo $book['title']; ?></td>
						<td><?php echo $book['category']; ?></td>
						<td><?php echo $book['pages']; ?> pages</td>
						<td><?php echo $book['date']; ?></td>

					<td> <?php echo $book['views']; ?> views</td>

					<td> <?php echo $book['downloads']; ?> downloads </td>

					
						<td>
							<form action="" method="post">
								<input type="hidden" name="bookId" value="<?php echo $book['book_id']; ?>">
								<input type="hidden" name="book" value="<?php echo $book['title']; ?>">
								<button class="btn btn-primary btn-sm" name="view-book" type="submit">View</button>
							</form>
						</td>
					
						<td>
							<form action="" method="post">
								<input type="hidden" name="bookId" value="<?php echo $book['book_id']; ?>">
								<button  class="btn btn-secondary btn-sm" name="delete-book" type="submit">Delete</button>
							</form>
						</td>

											
					</tr><!------->
	<?php
		}
	
	 } 
	
	} catch(PDOEception $e){

			 echo $e->getMessage;
		
	}
		?>							 												
											 </tbody>

										 </table>
						  
										   
					</div>



</div>

</div>


</div>
<?php include("../includes/footer.php"); ?>

<script src="../js/ajax/getCategory.js"></script>

<?php } else {?>

<h2 class="text-center my-auto">Account not activated</h2>

<?php }?>