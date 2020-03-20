<?php
require_once "connect_db.php";
require_once "helpers.php";
//function to save book id to session
function saveBookIdSession($id){

    if($_SESSION['bookID'] = $id){

        return true;
    } else {

        return false;
    }
}

//function to save user id to session
function saveUserIdSession($id){

    if($_SESSION['userID'] = $id){

        return true;
    } else {

        return false;
    }
}

//function to get categories from database
function getCategories(){

    global $db_con;
    
    try{

        $sql = "SELECT * FROM category";

        $stmt = $db_con->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();

       return $result;

    } catch (PDOException $e){

       echo $e->getMessage();
    }

}

//function to get book by category
function getBooksByCategory($category){

    global $db_con;
try{

    $sql = "SELECT book_id, title, cover_photo FROM books WHERE category LIKE ? ";
	$stmt = $db_con->prepare($sql);
	$stmt->execute(['%'.$category.'%']);
    return $stmt->fetchAll(PDO::FETCH_OBJ);

    } catch(PDOException $e){

        echo $e->getMessage();
    } 

}



//check if email exist

function emailExists($email){
    
    global $db_con;

    try{

        $sql = "SELECT user_name FROM admin WHERE user_name = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->rowCount();

        if($count == 0){

            return true;
             
        } else {

            return false;
        }


    } catch (PDOException $e){

        echo $e->getMessage();
    }



}


//function to register user
function registerUser(){

    global $db_con;


        $name = clean($_POST['name']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $user_id = str_replace(' ', '.', $name).mt_rand(1000, 9999);
        $hash = password_hash($password, PASSWORD_DEFAULT);


        try{

            $sql = "INSERT INTO admin(user_id, name, user_name, password ,date)
                    VALUES(?, ?, ?, ?, now())";

            $stmt = $db_con->prepare($sql);
            $stmt->execute([$user_id, $name, $email, $hash]);
            
            if($_SESSION["userID"] = $user_id){

                header('location: admin/user-dashboard.php');

            }

        } catch (PDOException $e){

            echo $e->getMessage();
        }
   
    }


//validate user registration
function validateRegistration(){

    if(isset($_POST['register'])){

        $errors = [];

        $email = clean($_POST['email']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            $errors[] =  'Invalid email'; 
        }

        if(!emailExists($email)){

         $errors[] =  'Email already exists'; 

        }
        if(strlen($_POST['password']) < 4){

            $errors[] =  'Password too short'; 
        }
        if($_POST['password'] !== $_POST['password2']){

            $errors[] =  'Password fields do not match'; 
        }
        if(!empty($errors)){

            foreach($errors as $error){

                  
                displayErrorMsg($error);

            }

        } else {

            registerUser();
        }

    }


}

//login user
function loginUser($userId, $type){

    if(saveUserIdSession($userId)){

        switch ($type) {
            case 'user':
                header("location: admin/user-dashboard.php");
                break;
            case 'admin':
                header("location: admin/dashboard.php");
                 break;
            case 'main-admin':
                header("location: admin/dashboard.php");
                  break;
            default:
                # code...
                break;
        }
    }
}

//verify user login
function verifyLogin(){

    global $db_con;

    if(isset($_POST["login"])){
        
        try{

            $email = clean($_POST["userName"]);
            $password = clean($_POST["password"]);
            $sql = "SELECT user_id, type, password FROM admin WHERE user_name =  ?";
            $stmt = $db_con->prepare($sql);
            $stmt->execute([$email]);
            $num = $stmt->rowCount();

            if($num == 0){

                displayErrorMsg('User does not exist');
            ; 

            } else {

                $user = $stmt->fetch(PDO::FETCH_OBJ);
                
                if(password_verify($password, $user->password)){

                   loginUser($user->user_id, $user->type);

                } else {
                    
                    displayErrorMsg('Wrong password');
                }

            }


        } catch(PDOException $e){
            
            echo $e->getMessage();
        }

    }

}

