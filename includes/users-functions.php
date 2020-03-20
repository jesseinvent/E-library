<?php session_start();

require_once "../includes/helpers.php";
require_once "../includes/connect_db.php";

//function to change status
function statusQuery($value){

    global $db_con;

    try{
        $id = clean($_SESSION["userID"]);
        $sql = "UPDATE admin SET status = ? WHERE user_id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute([$value, $id]);

    } catch (PDOException $e){

        echo $e->getMessage();
    }

}

//function to change admin
function adminQuery($value){

    global $db_con;

    try{

        $id = clean($_SESSION["userID"]);
        $sql = "UPDATE admin SET type = ? WHERE user_id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute([$value, $id]);

    } catch (PDOException $e){

        echo $e->getMessage();
    }

}

//function to activate user
function activateUser(){

    $status = 1;
    statusQuery($status);

}

//function to deactivate user
function deactivateUser(){
      
    $status = 0;
    statusQuery($status);
  
}

//function to make user admin
function makeAdmin(){
      
    $type = 'admin';
    adminQuery($type);

    displaySuccessMsg('Admin successfully added');
  
}

//function to remove admin
function removeAdmin(){
      
   
    $type = 'user';
    adminQuery($type);

    displaySuccessMsg('Admin successfully removed');


  
}

//function to delete user
function deleteUser(){

    global $db_con;

    $id = clean($_SESSION["userID"]);
    $sql = "DELETE FROM admin WHERE user_id = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->execute([$id]);


 
}



///////////////////////////////////////////


