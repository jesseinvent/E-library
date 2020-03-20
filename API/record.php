<?php session_start();

require_once "../includes/connect_db.php";

//book views
if(isset($_GET['view'])){

    $id = $_SESSION['bookID'];


        try{

            $sql = "UPDATE books SET views = views + 1 WHERE book_id = ?";
            $stmt = $db_con->prepare($sql);
            $stmt->execute([$id]);
            echo "recorded";

        } catch (PDOException $e){
            
            echo $e->getMessage();
        }

}

//book downloads
if(isset($_GET['download'])){

    $id = $_SESSION['bookID'];


        try{

            $sql = "UPDATE books SET downloads = downloads + 1 WHERE book_id = ?";
            $stmt = $db_con->prepare($sql);
            $stmt->execute([$id]);
            echo "downloaded";

        } catch (PDOException $e){
            
            echo $e->getMessage();
        }

}