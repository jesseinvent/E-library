<?php ob_start();
session_start();
?>
<?php $page="UPLOAD BOOK";
 include("../includes/header.php");
 require_once "functions/admin_functions.php";
 $id = $_SESSION['bookID'];

   ?>

<div class="container">
<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">Edit Book</h1>

    <div class="shadow">
        <a href="dashboard.php"> <button class="btn btn-default">Dashboard</button> </a>
        <a href="add-category.php"> <button class="btn btn-default">Add category</button> </a>
    </div>

<div class="card shadow-lg p-5 mt-2">  

 
    <div>
           <?php editBook($id); ?>
    </div>

<form action="" method="POST" enctype="multipart/form-data">

<?php 

    $sql = "SELECT title, category, pages, cover_photo, book_file, description FROM books WHERE book_id = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([$id]);
    $book = $stmt->fetch(PDO::FETCH_OBJ);

?>    

    <div class = "form-group">
        <label for="">Edit Book Title:</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo $book->title; ?>" placeholder="Enter Book Title" required>
    </div>

    <div class = "form-group">
        <label for="">Change category: </label>
        <select name='category' class='custom-select'  id='category' required>
				<option><?php echo $book->category; ?></option>
            <?php

                foreach (getCategories() as $category) {
                    # code...
                    echo '
                    <option value="'.$category['category'].'" id="">'.$category['category'].'</option>
                    ';
                }
            
            ?>
			</select>
    </div>

    <div class = "form-group">
        <label for="">Edit Number of pages:</label>
        <input type="number" class="form-control " name="pages" id="pages" value="<?php echo $book->pages; ?>" placeholder="Enter Number" required>
    </div>

    <img class='image-responsive' src='../book-images/<?php echo $book->cover_photo; ?>' height='60' width="60">

    <div class = "form-group">
        <label for="">Change book cover:</label>
        <input type="file" name="cover" class="form-control" value="<?php echo $book->cover_photo; ?>">
    </div>

    <div class = "form-group">
        <label for="">Change book file: </label>
        <p><?php echo $book->book_file; ?></p>
        <input type="file" name="book" class="form-control">
    </div>

    <div class="form-group">
      <textarea name="description" class="form-control" id="description"  placeholder="Enter a short description of the book" required><?php echo $book->description; ?></textarea>
    </div>

    <input type="hidden" name="cover_pic" value="<?php echo $book->cover_photo; ?>">
    <input type="hidden" name="book_file" value="<?php echo $book->book_file; ?>">

    <button type="submit" name="update" class="btn btn-success btn-lg">Update</button>

</form>


</div>







</div>
<?php include("../includes/footer.php"); ?>