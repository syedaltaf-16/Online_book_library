<?php
session_start();
include "db_conn.php";
include "php/func-book.php";

if (!isset($_GET['book_id'])) {
  header("Location: index.php");
  exit;
}

$book_id = $_GET['book_id'];
$book = get_book($conn, $book_id);

if (!$book) {
  echo "Book not found.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Download Book</title>
  <style>
    body {
      font-family: Arial;
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    .btn {
      padding: 12px 20px;
      background-color: #28a745;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      display: inline-block;
      margin-top: 20px;
    }

    h2{
      text-align: center;
    }

    h3{
      text-align: center;
    }

    p{
      text-align: center;
    }

    .btn {
      display: inline-block;
      margin: 0 auto;
      text-align: center;
    }

    .center-container {
      text-align: center;
    }
    
  </style>
</head>
<body>

<h2>Payment Successful!</h2>
<p>Thank you! You can now download your book:</p>

<h3><?= htmlspecialchars($book['title']) ?></h3>
<p><strong>Author:</strong> <?= htmlspecialchars($book['author_name']) ?></p>

<div class="center-container">
  <a class="btn" href="uploads/files/<?= htmlspecialchars($book['file']) ?>" download="<?= htmlspecialchars($book['title']) ?>">
    Download Now
  </a>
</div>


</body>
</html>
