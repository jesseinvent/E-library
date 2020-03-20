<?php $page="ADD CATEGORY";
 include("../includes/header.php");
 require_once "functions/admin_functions.php";
 require_once "../includes/functions.php";

 ?>

 <?php if(isset($_POST['delete'])) deleteCategory();?>


<div class="container">
<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">Add Category</h1>

<div class="shadow">
        <a href="dashboard.php"> <button class="btn btn-default">Dashboard</button> </a>
        <a href="upload-book.php"> <button class="btn btn-default">Upload Book</button> </a>

    </div>

<div class="card shadow-lg p-5 mt-2"> 
    
    <div class="row">
        <!-- -->
         <?php addCategory(); ?>
    </div>

     <div class = "form-group">
        <form action="" method="POST">
            <label for="">Add a Book category</label>
            <input type="text" class="form-control " name="category" id="" placeholder="Type in category" required>
            <button type="submit" name="add" class="btn btn-success my-3">Add category</button>
        </form>
    </div>


    <h1 class="p-1" style="font-size: 1.5rem; letter-spacing:3px; font-family: fantasy; margin: 2px; color:#ddd;">Categories</h1>


    <div class="table-responsive-sm">

      <table class="table table-sm">
            <thead>
                <tr>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    <?php
         foreach (getCategories() as $category) {
            echo '
                <tr>
                        <td>'.$category['category'].'</td>
                        <td>
                            <form action="" method="post">
                            <input type="hidden" name="id" value="'.$category['num'].'">
                                <button class="btn btn-default" name="delete">  delete category </button>
                            </form>
                        </td>
                </tr>
            ';

        } 
    ?>
            </tbody>
        </table>
    
    </div>



</div>


</div>
<?php include("../includes/footer.php"); ?>