<?php
session_start();

# Validate author ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid author ID.");
}
$author_id = (int) $_GET['id'];

# Database Connection File
include "db_conn.php";

# Include all helper files
include "php/func-book.php";
include "php/func-author.php";
include "php/func-category.php";

# Fetch author
$current_author = get_author($conn, $author_id);
if (!$current_author) {
    die("Author not found.");
}

# Get books by this author
$books = get_books_by_author($conn, $author_id);

# Get all categories and authors for sidebar
$categories = get_all_categories($conn);
$authors = get_all_authors($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($current_author['name']) ?></title>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
  <div class="navbar-container">
    <a href="index.php" class="navbar-brand">Online Book Library</a>
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">&#9776;</label>
    <ul class="nav-links">
      <li><a href="index.php">Library</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">About</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<!-- Back link -->
<h1 class="display-4 p-3 fs-3">
  <a href="index.php" class="nd">
    <img src="img/back-arrow.png" width="35">
  </a>
  <?= htmlspecialchars($current_author['name']) ?>
</h1>

<!-- Book List -->
<div class="container">
  <p>Books by this Author:</p>

  <?php if (empty($books)) { ?>
    <div class="alert">
      <img src="img/empty-search.png" width="100"><br>
      No books found for this author.
    </div>
  <?php } else { ?>
    <div class="card-grid">
      <?php foreach ($books as $book) { ?>
        <div class="card">
          <img src="uploads/cover/<?= htmlspecialchars($book['cover']) ?>" class="card-img">
          <div class="card-body">
            <h5><?= htmlspecialchars($book['title']) ?></h5>
            <p>
              <?= htmlspecialchars($book['description']) ?><br>
              <strong>By:</strong> <?= htmlspecialchars($book['author_name']) ?><br>
              <strong>Category:</strong> <?= htmlspecialchars($book['category_name']) ?>
            </p>
            <div class="card-actions">
              <a href="payment.php?book_id=<?= $book['id'] ?>" class="btn btn-primary">Purchase</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
</div>


</div>

<!-- Footer -->
<footer class="footer">
  <p>&copy; 2025 Online Book Library. All rights reserved.</p>
</footer>

</body>
</html>
