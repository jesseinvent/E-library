<?php ob_start();
    session_start();
?>
<?php $page="UPLOAD BOOK";
 include("../includes/header.php");
 require_once "functions/admin_functions.php";
   ?>


<div class="container">
    <h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">Upload a Book</h1>
    
    <div class="shadow">
        <a href="dashboard.php"> <button class="btn btn-default">Dashboard</button> </a>
        <a href="add-category.php"> <button class="btn btn-default">Add category</button> </a>
    </div>

<div class="card shadow-lg p-5 mt-2">  

 
    <div>
    <?php validateBook(); ?>
    </div>

<form action="" method="POST" enctype="multipart/form-data">

    <div class = "form-group">
        <label for="">Title:</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Book Title" required>
    </div>

    <div class = "form-group">
        <label for="">Choose category: </label>
        <select name='category' class='custom-select' id='category' required>
				<option>Choose Category</option>
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
        <label for="">Number of pages:</label>
        <input type="number" class="form-control " name="pages" id="pages" placeholder="Enter Number" required>
    </div>

    <div class = "form-group">
        <label for="">Upload a cover photo for the book:</label>
        <input type="file" name="cover" class="form-control" required>
    </div>

    <div class = "form-group">
        <label for="">Upload book:</label>
        <input type="file" name="book" class="form-control" required>
    </div>

    <div class="form-group">
      <textarea name="description" class="form-control" id="description" placeholder="Enter a short description of the book" required></textarea>
    </div>

    <button type="submit" name="upload" class="btn btn-success btn-lg">Upload</button>

</form>


</div>







</div>
<?php include("../includes/footer.php"); ?>