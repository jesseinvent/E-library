<?php $page="MANAGE USERS";
 include("../includes/header.php");
 require_once "functions/admin_functions.php";
 require_once "../includes/users-functions.php";

 ?>

<?php

  if(isset($_POST['deactivate-user'])){

    if(saveUserIdSession($_POST['userId'])){

        deactivateUser();
    }

}

if(isset($_POST['activate-user'])){

    if(saveUserIdSession($_POST['userId'])){

        activateUser();
    }

}

    



if(isset($_POST['delete-user'])){

    if(saveUserIdSession($_POST['userId'])){

        deleteUser();
    }
}

    




?>



<div class="container">

<h1 class="m-3" style="font-size: 1.9rem; letter-spacing:3px; font-family: fantasy; margin: 0px; text-align:center; color:#ddd;">Manage Users</h1>

<div class="shadow">
        <a href="dashboard.php"> <button class="btn btn-default">Dashboard</button> </a>
        <a href="manage-users.php"> <button class="btn btn-default">Users</button> </a>
        <a href="manage-admins.php"> <button class="btn btn-default">Admins</button> </a>

    </div>






<!------Unactivated users-->
<div class="card shadow-lg p-5 mt-2"> 
    
    <div class="row">
        <!-- -->
         <?php ?>
    </div>

       
    <h1 class="p-1" style="font-size: 1.5rem; letter-spacing:3px; font-family: fantasy; margin: 2px; color:#ddd;">UNACTIVATED USERS</h1>


    <div class="table-responsive-sm">

      <table class="table table-sm m-3">
            
            <tbody>
<?php
    $status = 0;
    $sql = "SELECT * FROM admin WHERE status = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([$status]);
    $users = $stmt->fetchAll();

    if(count($users) == 0){

        echo "No unactivated  users";

    } else {

        foreach($users as $user){

?>
            <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['date']; ?></td>

            
				       	<td>
							<form action="" method="post">
							<input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
								<button  class="btn btn-success btn-sm" name="activate-user" type="submit">Activate user</button>
							</form>
						</td>

                        <td>
							<form action="" method="post">
								<input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
								<button  class="btn btn-secondary btn-sm" name="delete-user" type="submit">Delete user</button>
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

<br>
<!----------------activated----------------------->

<div class="card shadow-lg p-5 m-2"> 


       
<h1 class="p-1" style="font-size: 1.5rem; letter-spacing:3px; font-family: fantasy; margin: 2px; color:#ddd;">ACTIVATED USERS</h1>

<?php 
if(isset($_POST['make-admin'])){

    if(saveUserIdSession($_POST['userId'])){

        makeAdmin();
    }
}
    
?>

    <div class="table-responsive-sm">

      <table class="table table-sm m-3">
            
            <tbody>
<?php 
    $status = 1;
    $sql = "SELECT * FROM admin WHERE status = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([$status]);
    $users = $stmt->fetchAll();

    if(count($users) == 0){

        echo "No unactivated  users";

    } else {

        foreach($users as $user){
?>
            <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['date']; ?></td>
                    <td> 3 uploads </td>

 <?php if($user['type'] == 'admin') { ?> 

                 <td>Admin</td>
 
				      
 <?php } else {?>  
                      <td>            
							<form action="" method="post">
							<input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
								<button  class="btn btn-primary btn-sm" name="make-admin" type="submit">Make admin</button>
							</form>
						</td>

 <?php }?>                    
						<td>
							<form action="" method="post">
							<input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
								<button  class="btn btn-success btn-sm" name="deactivate-user" type="submit">Deactivate user</button>
							</form>
						</td>

                        <td>
							<form action="" method="post">
								<input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
								<button  class="btn btn-secondary btn-sm" name="delete-user" type="submit">Delete user</button>
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