
<?php
require_once "../includes/connect_db.php";
require_once "../includes/helpers.php";

if(isset($_GET['search'])){

    $search = clean($_GET['searchVal']);
    $type = clean($_GET['searchType']);
    $status = 1;
    
    try {

        if($type == 'category'){

            $sql = "SELECT * FROM books WHERE category LIKE ? AND status = ?";
            

        } else if($type == 'title'){

            $sql = "SELECT * FROM books WHERE title LIKE ?  AND status = ?";
            
        }

            $stmt = $db_con->prepare($sql);
            $stmt->execute(['%'.$search.'%', $status]);
            $books = $stmt->fetchAll();

        if(count($books) == 0){

            echo "No books Uploaded yet";

        } else {
            
         foreach($books as $book){
        
            if(isset($_GET["card"])){

?>
	<div id="books" class="d-flex justify-content-around flex-wrap m-3 p-3">

<!----><div class='card p-2 shadow' style='width: 170px;'>

<img class='card-img-top' src='<?php echo $link; ?>book-images/<?php echo $book['cover_photo']; ?>' height='160'>
                    <div class='card-body bg-light'>
                    <h3 class='card-title' style='font-size: 15px;'><?php echo $book['title']; ?></h3>

                        <!--- view product btn -->

                        <form action='' method='post'>

                            <input type='hidden' name='bookId' value='<?php echo $book['book_id']; ?>'>
                            <button type='submit' name='view-book' class='btn btn-primary btn-sm' style='margin: 0px;'>View Book</button>
                            
                        </form>
                </div>
    </div><!---->

<?php
            }  else {
?>
<!----><tr>
                    <td><img class='image-responsive' src='../book-images/<?php echo $book['cover_photo']; ?>' height='60' width="60"></td>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['category']; ?></td>
                    <td><?php echo $book['pages']; ?> pages</td>
                    <td><?php echo $book['date']; ?></td>

                <td> <?php echo $book['views']; ?> views</td>

                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="bookId" value="<?php echo $book['book_id']; ?>">
                            <input type="hidden" name="book" value="<?php echo $book['title']; ?>">
                            <button class="btn btn-primary" name="view-book" type="submit">View</button>
                        </form>
                    </td>
                   
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="bookId" value="<?php echo $book['book_id']; ?>">
                            <button  class="btn btn-secondary" name="delete-book" type="submit">Delete</button>
                        </form>
                    </td>

                    <td>
							<form action="" method="post">
							<input type="hidden" name="bookId" value="<?php echo $book['book_id']; ?>">
								<button  class="btn btn-success" name="unapprove-book" type="submit">Unapprove</button>
							</form>
					</td>
                
                </tr><!------->
<?php
        }

    }

 } 

} catch(PDOEception $e){

         echo $e->getMessage;
    
}

}
    ?>							 												

