<?php $page="MANAGE USERS";
 include("../includes/header.php");
 require_once "functions/admin_functions.php";
 require_once "../includes/users-functions.php";

 ?>

<?php

?>



<div class="container">

<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">Manage Admins</h1>


<div class="shadow">
        <a href="dashboard.php"> <button class="btn btn-default">Dashboard</button> </a>
        <a href="manage-users.php"> <button class="btn btn-default">Users</button> </a>
        <a href="manage-admins.php"> <button class="btn btn-default">Admins</button> </a>

    </div>






<!------MAIN ADMIN--->
<div class="card shadow-lg p-5 mt-2"> 
    
    <div class="row">
        <!-- -->
         <?php ?>
    </div>

       
    <h1 class="p-1" style="font-size: 1.5rem; letter-spacing:3px; font-family: fantasy; margin: 2px; color:#ddd;">MAIN ADMIN</h1>


    <div class="table-responsive-sm">

      <table class="table table-sm m-3">
            
            <tbody>
<?php 
    $status = 1;
    $type = 'main-admin';
    $sql = "SELECT * FROM admin WHERE type = ? AND status = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([$status, $type]);
    $users = $stmt->fetchAll();

    if(count($users) == 0){

        echo "No main admin";

    } else {

        foreach($users as $user){

?>
            <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td>3 uploads</td>				
            
            </tr>
  <?php 
        }
    }
  ?>  
            </tbody>
        </table>
    
    </div>



</div>




<!----ADMINS--->

<br>

<div class="card shadow-lg p-5 m-2"> 
    
    <div class="row">
        <!-- -->
         <?php ?>
    </div>

       
    <h1 class="p-1" style="font-size: 1.5rem; letter-spacing:3px; font-family: fantasy; margin: 2px; color:#ddd;">ADMINS</h1>

<?php 

if(isset($_POST['remove-admin'])){

    if(saveUserIdSession($_POST['userId'])){

        removeAdmin();
    }
}

?>
    <div class="table-responsive-sm">

      <table class="table table-sm m-3">
            
            <tbody>
<?php 
    $status = 1;
    $type = 'admin';
    $sql = "SELECT * FROM admin WHERE type = ? AND status = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([$type, $status]);
    $users = $stmt->fetchAll();

    if(count($users) == 0){

        echo "No admins";

    } else {

        foreach($users as $user){

?>
            <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td> 3 uploads </td>

            
				        <td>
							<form action="" method="post">
							<input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
								<button  class="btn btn-primary btn-sm" name="remove-admin" type="submit">Remove admin</button>
							</form>
						</td>
										
            
            </tr>
  <?php 
        }
    }
  ?>  
            </tbody>
        </table>
    
    </div>



</div>


</div>
<?php include("../includes/footer.php"); ?>