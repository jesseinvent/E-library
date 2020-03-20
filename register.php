<?php ob_start();
session_start();
?>
<?php $page="REGISTER";
 include("includes/header.php");
 require_once "includes/functions.php";

 ?>


<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">REGISTER</h1>


<div class="container">

<div class="shadow">
        <a href="<?php  echo $link ?>login.php"> <button class="btn btn-default">Login</button> </a>
        <a href="<?php  echo $link ?>register.php"> <button class="btn btn-default">Register</button> </a>

    </div>

   <div class="card shadow-lg p-5 mt-2"> 
    
    <div class=""><?php validateRegistration(); ?>   </div>

    <form action="" method="POST">

        <div class="form-group">
            <label for="">Enter Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
        </div>
        <div class="form-group">
            <label for="">Enter password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <div class="form-group">
            <label for="">Re-enter password</label>
            <input type="password" class="form-control" name="password2" placeholder="Re-enter password" required>
        </div>

        <button type="submit" class="btn btn-success" name="register">Register</button>
    
    </form>


    </div>

</div>
<?php include("includes/footer.php"); ?>