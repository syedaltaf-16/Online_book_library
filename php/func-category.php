<?php  

# Get all categories function
function get_all_categories($con) {
    $sql = "SELECT * FROM categories ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}


# Get category by ID
function get_category($con, $id){
   $sql  = "SELECT * FROM categories WHERE id=?";
   $stmt = $con->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
       $category = $stmt->fetch();
   } else {
       $category = 0;
   }

   return $category;
}
?>