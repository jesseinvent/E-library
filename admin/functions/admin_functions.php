<?php
require_once "../includes/connect_db.php";
require_once "../includes/helpers.php";

//change upload limit

//function add category
function addCategory(){
    
    global $db_con;

    if(isset($_POST['add'])){

        $category = clean($_POST['category']);

        try {

            $sql = "INSERT INTO category SET category = ?";
            $stmt = $db_con->prepare($sql);
            $stmt->execute([$category]);

            displaySuccessMsg('Category successfully added');

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }
    
}


//function to delete category

function deleteCategory(){

    global $db_con;

    $id = clean($_POST['id']);

    try{

        $sql = "DELETE FROM category WHERE num = ?";

        $stmt = $db_con->prepare($sql);

        $stmt->execute([$id]);

    } catch (PDOException $e) {

        echo $e->getMessage();


    }

}



//function to check user status if approved
function checkUserStatus(){

    global $db_con;

    $id = $_SESSION["userID"];
    
    try{

        $sql = "SELECT status FROM admin WHERE user_id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if($user->status == 1){

            return true;

        } else {

            return false;
        }

    } catch(PDOException $e){

        echo $e->getMessage();
    }
}

//function to check user status if approved
function getUserName(){

    global $db_con;

    $id = $_SESSION["userID"];
    
    try{

        $sql = "SELECT name FROM admin WHERE user_id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user->name;

    } catch(PDOException $e){

        echo $e->getMessage();
    }
}

/////////////////////////////////////__MAIN_FUNCTIONS__///////////////////////////////////////////////////

//get file extension
function getFileExtension($type){

    if($type == "image/jpeg"){

        return ".jpeg";
    }
    else if($type == "image/png"){

        return ".png";
    }
    else if($type == "application/pdf"){

        return ".pdf";

    }


}

//function to handle file upload
function uploadFile($title, $type, $tmp_name){

    $ext = getFileExtension($type);


    $newBookName = strtolower(trimString($title)).mt_rand(1000, 9999);
    $destination = "../books/".$newBookName.$ext;

    if(move_uploaded_file($tmp_name, $destination)){

        return $newBookName.$ext;
    }


}


//function to upload cover photo
function uploadCoverPic($type, $tmp_name){

    $ext = getFileExtension($type);

    $newName = "cover-".mt_rand(1000, 9999);
    $destination = "../book-images/".$newName.$ext;

   if(move_uploaded_file($tmp_name, $destination)){

        return $newName.$ext;

   }


}


//process book to database
function processBook(){

    global $db_con;

    
    ini_set('upload_max_filesize', '50M');
    ini_set('post_max_size', '50M');
    ini_set('max_input_time', 300);
    ini_set('max_execution_time', 300);



        $title = clean($_POST['title']);
        $category = clean($_POST['category']);
        $pages = clean($_POST['pages']);
        $description = clean($_POST['description']);
        $id = "book".mt_rand(10000, 99999);
        $userId = $_SESSION["userID"];
        $views = 0;

        $cover = uploadCoverPic($_FILES['cover']['type'], $_FILES['cover']['tmp_name']);
        $book = uploadFile($title, $_FILES['book']['type'] ,$_FILES['book']['tmp_name']);

        try{

            $sql = "INSERT books(book_id, user_id ,title, category, pages, cover_photo, book_file, description, views ,date)
                    VALUES(?,?,?,?,?,?,?,?,?, now())";

            $stmt = $db_con->prepare($sql);
            $stmt->execute([$id, $userId ,$title, $category, $pages, $cover, $book, $description, $views]);


            displaySuccessMsg('Book successfully uploaded');

        } catch(PDOException $e){

            echo $e->getMessage();
        }   

    
}


//Validate book
function validateBook(){

    // ini_set('upload_max_filesize', '50M');
    // ini_set('post_max_size', '50M');
    // ini_set('max_input_time', 300);
    // ini_set('max_execution_time', 300);

    if(isset($_POST['upload'])){

        $errors = [];

        if(isset($_FILES["cover"]) && isset($_FILES["book"]) ){

            if($_FILES["book"]["type"] != "application/pdf"){

                $errors[] = "Invalid book format, only PDF format is allowed";

            }

            if($_FILES["cover"]["type"] != "image/jpeg" && $_FILES["cover"]["type"] != "image/png" ){

                $errors[] = "The cover photo is of invalid format, only jpg and png format are allowed";

            }
           
            if(!empty($errors)){

                foreach ($errors as $error) {
                    # code...
                   displayErrorMsg($error); 
                }

            } else {

                    if(isset($_POST['upload'])){

                        processBook();

                    }
                }
            


            } else {

                echo "No upload";

         }

    }


}

//function to edit book
function editBook($id){


if(isset($_POST['update'])){

    global $db_con;


    $title = clean($_POST['title']);
    $category = clean($_POST['category']);
    $pages = clean($_POST['pages']);
    $description = clean($_POST['description']);


    $book = clean($_POST['book_file']);
    $cover = clean($_POST['cover_pic']);
    
    if(isset($_FILES['book']) && !empty($_FILES['book'])){

        if($_FILES["book"]["type"] == "application/pdf" ){

            unlink('../books/'.$book.'');

            $book = uploadFile($title, $_FILES['book']['type'] ,$_FILES['book']['tmp_name']);

        }
    } 

    if(isset($_FILES['cover']) && !empty($_FILES['cover'])){

        if($_FILES["cover"]["type"] == "image/jpeg" ||  $_FILES["cover"]["type"] == "image/png"){

        unlink('../book-images/'.$cover.'');

          $cover = uploadCoverPic($_FILES['cover']['type'], $_FILES['cover']['tmp_name']);
          unlink('../books/'.$book.'');


        }

    } 


    try{
        // echo $book." ".$cover." ";

   
        $sql = "UPDATE books  SET 
                                 book_id = ?,
                                 title  = ?,
                                 category = ?, 
                                 pages  = ?,
                                 cover_photo  = ?,
                                 book_file = ?,
                                 description  = ?
             WHERE books.book_id = ?";

        $stmt = $db_con->prepare($sql);
        $stmt->execute([$id, $title, $category, $pages, $cover, $book, $description, $id]);

        displaySuccessMsg('Book successfully updated');

    } catch(PDOException $e){

        echo $e->getMessage();
    }   

 }

}

//function to delete book
function deleteBook($id){

    global $db_con;

    try{

            $sql = "SELECT cover_photo, book_file FROM books WHERE book_id = ?";
            $stmt = $db_con->prepare($sql);
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_OBJ);

            unlink('../books/'.$book->book_file.'');
            unlink('../book-images/'.$book->cover_photo.'');


        try{

            $sql = "DELETE FROM books WHERE book_id = ?";
            $stmt = $db_con->prepare($sql);
            $stmt->execute([$id]);
            return true;

        } catch(PDOException $e){

            echo $e->getMessage();
            
        }

    } catch (PDOException $e){

        echo $e->getMessage();
    }
}


//functionn to approve book
function bookApproval($id, $status){

        global $db_con;

    try {
        //code...
        $sql = "UPDATE books SET status = ? WHERE book_id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute([$status ,$id]);
        return true;

    } catch (PDOException $e){

        //throw $th;
        echo $e->getMessage();
    }

}