<?php 

# Get all authors function
function get_all_authors($con) {
    $sql = "SELECT * FROM authors ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}


# Get author by ID
function get_author($con, $id){
   $sql  = "SELECT * FROM authors WHERE id=?";
   $stmt = $con->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
       $author = $stmt->fetch();
   } else {
       $author = 0;
   }

   return $author;
}
?>


