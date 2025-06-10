<?php
session_start();

# Database Connection File
include "db_conn.php";

# Book Helper function
include "php/func-book.php";

# Author Helper Function
include "php/func-author.php";

# Category Helper Function
include "php/func-category.php";

# Get all books, categories, and authors
$books = get_all_books($conn); 
$categories = get_all_categories($conn);
$authors = get_all_authors($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Online Book Library</title>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="container">

  <!-- Navigation -->
  <nav class="navbar">
    <div class="navbar-container">
      <a href="index.php" class="navbar-brand">Online Book Library</a>
      <input type="checkbox" id="menu-toggle">
      <label for="menu-toggle" class="menu-icon">&#9776;</label>
      <ul class="nav-links">
        <li><a href="index.php">Library</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="about-us.html">About</a></li>
        <?php if (!isset($_SESSION['user_id'])): ?>
          <li><a href="login.php">Login</a></li>
        <?php else: ?>
          <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <!-- Search Form -->
  <form action="search.php" method="get" class="search-form">
    <input type="text" name="key" placeholder="Search Book...">
    <button type="submit">
      <img src="img/search.png" width="20" alt="Search">
    </button>
  </form>

  <!-- Book List -->
  <h4>All Available Books</h4>
  <?php if (empty($books)) { ?>
    <div class="alert">
      <img src="img/empty-search.png" width="100"><br>
      No books available at the moment.
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

  <!-- Categories -->
  <h4>Categories</h4>
  <div class="simple-list">
    <?php if (!empty($categories)) {
      foreach ($categories as $category) { ?>
        <div class="list-item">
          <span><?= htmlspecialchars($category['name']) ?></span>
          <a href="category.php?id=<?= $category['id'] ?>" class="btn btn-warning">View</a>
        </div>
    <?php }} else { ?>
        <div class="list-item">No categories found.</div>
    <?php } ?>
  </div>

  <!-- Authors -->
  <h4>Authors</h4>
  <div class="simple-list">
    <?php if (!empty($authors)) {
      foreach ($authors as $author) { ?>
        <div class="list-item">
          <span><?= htmlspecialchars($author['name']) ?></span>
          <a href="author.php?id=<?= $author['id'] ?>" class="btn btn-warning">View</a>
        </div>
    <?php }} else { ?>
        <div class="list-item">No authors found.</div>
    <?php } ?>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 Online Book Library. All rights reserved.</p>
  </footer>

</div>
</body>
</html>
