<?php ob_start();
session_start();
?>
<?php $page="LOG IN";
 include("includes/header.php");
 require_once "includes/functions.php";

 ?>


<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">LOG IN</h1>


<div class="container">

    <div class="shadow">
        <a href="<?php  echo $link ?>login.php"> <button class="btn btn-default">Login</button> </a>
        <a href="<?php  echo $link ?>register.php"> <button class="btn btn-default">Register</button> </a>

    </div>

   <div class="card shadow-lg p-5 mt-2"> 
    <?php verifyLogin(); ?>
    <form action="" method="POST">

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="userName" placeholder="Enter user name" required>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn btn-success" name="login">Login</button>
    
    </form>


    </div>

</div>
<?php include("includes/footer.php"); ?>