<?php ob_start();
session_start();

$page="DELETE BOOK";
 include("../includes/header.php");
?>

<?php
if(isset($_POST['delete'])){

    deleteBook();

}

?>

<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">Delete Book</h1>


<div class="container">

    <div>
        <a href="dashboard.php"> <button class="btn btn-default">Dashboard</button> </a>
        <a href="add-category.php"> <button class="btn btn-default">Add category</button> </a>
	    <a href="upload-book.php"> <button class="btn btn-default">Upload Book</button> </a>
    </div>

<div class="card shadow-lg p-5 m-2">  

    <p>Are you sure you want delete to this book?</p>
    <div class="inline">
        <form action="" method="POST">
            <button class="btn btn-primary" name="delete" >Delete Book</button>
            <button class="btn btn-secondary" name="back" >Go back</button>
         </form>
    </div>




</div>







</div>
<?php include("../includes/footer.php"); ?>