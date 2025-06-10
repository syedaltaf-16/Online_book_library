<?php  

# Get All books function
function get_all_books($con){
   $sql  = "SELECT 
               books.*, 
               authors.name AS author_name, 
               categories.name AS category_name
            FROM books
            LEFT JOIN authors ON books.author_id = authors.id
            LEFT JOIN categories ON books.category_id = categories.id
            ORDER BY books.id DESC";

   $stmt = $con->prepare($sql);
   $stmt->execute();

   return ($stmt->rowCount() > 0) 
        ? $stmt->fetchAll(PDO::FETCH_ASSOC) 
        : [];
}

# Get book by ID function
function get_book($con, $id){
   $sql  = "SELECT 
               books.*, 
               authors.name AS author_name, 
               categories.name AS category_name
            FROM books
            LEFT JOIN authors ON books.author_id = authors.id
            LEFT JOIN categories ON books.category_id = categories.id
            WHERE books.id = ?";
            
   $stmt = $con->prepare($sql);
   $stmt->execute([$id]);

   return ($stmt->rowCount() > 0) 
        ? $stmt->fetch(PDO::FETCH_ASSOC) 
        : null;
}

# Search books function
function search_books($con, $key) {
  $key = "%{$key}%";
  $sql = "SELECT 
            books.*, 
            authors.name AS author_name, 
            categories.name AS category_name
          FROM books 
          LEFT JOIN authors ON books.author_id = authors.id 
          LEFT JOIN categories ON books.category_id = categories.id 
          WHERE books.title LIKE ? OR books.description LIKE ?";
          
  $stmt = $con->prepare($sql);
  $stmt->execute([$key, $key]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

# Get books by category
function get_books_by_category($con, $id){
   $sql  = "SELECT 
               books.*, 
               authors.name AS author_name, 
               categories.name AS category_name
            FROM books
            LEFT JOIN authors ON books.author_id = authors.id
            LEFT JOIN categories ON books.category_id = categories.id
            WHERE books.category_id = ?";
   
   $stmt = $con->prepare($sql);
   $stmt->execute([$id]);

   return ($stmt->rowCount() > 0) 
        ? $stmt->fetchAll(PDO::FETCH_ASSOC) 
        : [];
}

# Get books by author
function get_books_by_author($con, $id){
   $sql  = "SELECT 
               books.*, 
               authors.name AS author_name, 
               categories.name AS category_name
            FROM books
            LEFT JOIN authors ON books.author_id = authors.id
            LEFT JOIN categories ON books.category_id = categories.id
            WHERE books.author_id = ?";
   
   $stmt = $con->prepare($sql);
   $stmt->execute([$id]);

   return ($stmt->rowCount() > 0) 
        ? $stmt->fetchAll(PDO::FETCH_ASSOC) 
        : [];
}

?>
