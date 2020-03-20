<?php $page="SET PASSWORD";
 include("includes/header.php");

 ?>


<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">SET PASSWORD</h1>


<div class="container">

<div>
        <a href="<?php  echo $link ?>login.php" class=""> <button class="btn btn-default">Login</button> </a>

    </div>

   <div class="card shadow-lg p-5"> 
    
    <form action="" method="POST">

    <div class="form-group">
            <label for="">Enter password</label>
            <input type="text" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <div class="form-group">
            <label for="">Re-enter password</label>
            <input type="password" class="form-control" name="userName" placeholder="Re-enter password" required>
        </div>

        <button type="submit" class="btn btn-success" name="register">Set Password</button>
    
    </form>


    </div>

</div>
<?php include("includes/footer.php"); ?>