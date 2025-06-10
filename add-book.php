<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";

    # Category helper function
	include "php/func-category.php";
    $categories = get_all_categories($conn);

    # Author helper function
	include "php/func-author.php";
    $authors = get_all_authors($conn);


    $title = $_GET['title'] ?? '';
    $desc = $_GET['desc'] ?? '';
    $category_id = $_GET['category_id'] ?? 0;
    $author_id = $_GET['author_id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Add Book</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background: #f5f5f5;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 1200px;
			margin: auto;
			padding: 20px;
		}

		/* Navbar */
		.navbar {
			background: #fff;
			border-bottom: 1px solid #ddd;
			border-radius: 10px;
			padding: 10px 20px;
			margin-bottom: 30px;
		}

		.navbar-container {
			display: flex;
			align-items: center;
			justify-content: space-between;
			position: relative;
		}

		.navbar-brand {
			font-size: 1.5rem;
			font-weight: bold;
			text-decoration: none;
			color: #000;
		}

		.nav-menu {
			list-style: none;
			display: flex;
			gap: 20px;
			margin: 0;
			padding: 0;
		}

		.nav-menu li a {
			text-decoration: none;
			color: #000;
			padding: 8px 12px;
			border-radius: 6px;
		}

		.nav-menu li a:hover,
		.nav-menu li a.active {
			color: #4F46E5;
			background: #e0e0ff;
		}

		/* Form styles */
		form {
			background: #fff;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0 2px 6px rgba(0,0,0,0.1);
			max-width: 600px;
			margin: auto;
		}

		h1 {
			margin-top: 0;
			margin-bottom: 30px;
			font-weight: bold;
			text-align: center;
			color: #333;
			font-size: 28px;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
			color: #333;
		}

		input[type="text"],
		select,
		input[type="file"] {
			width: 100%;
			padding: 12px 15px;
			border: 1px solid #ccc;
			border-radius: 8px;
			font-size: 16px;
			margin-bottom: 25px;
			box-sizing: border-box;
		}

		button {
			background: #4F46E5;
			color: #fff;
			border: none;
			padding: 14px 20px;
			border-radius: 30px;
			cursor: pointer;
			font-size: 16px;
			width: 100%;
			transition: background 0.3s ease;
		}

		button:hover {
			background: #3730a3;
		}

		.alert {
			padding: 15px;
			border-radius: 8px;
			margin-bottom: 25px;
			font-weight: bold;
		}

		.alert-danger {
			background: #fee2e2;
			color: #b91c1c;
			border: 1px solid #fca5a5;
		}

		.alert-success {
			background: #dcfce7;
			color: #15803d;
			border: 1px solid #bbf7d0;
		}
	</style>
</head>
<body>
	<div class="container">
		<nav class="navbar">
			<div class="navbar-container">
				<a href="admin.php" class="navbar-brand">Admin</a>
				<ul class="nav-menu">
					<li><a href="admin.php">Library</a></li>
					<li><a href="add-book.php" class="active">Add Book</a></li>
					<li><a href="add-category.php">Add Category</a></li>
					<li><a href="add-author.php">Add Author</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		<form action="php/add-book.php" method="post" enctype="multipart/form-data" novalidate>
			<h1>Add New Book</h1>

			<?php if (isset($_GET['error'])) { ?>
			<div class="alert alert-danger">
				<?=htmlspecialchars($_GET['error']); ?>
			</div>
			<?php } ?>

			<?php if (isset($_GET['success'])) { ?>
			<div class="alert alert-success">
				<?=htmlspecialchars($_GET['success']); ?>
			</div>
			<?php } ?>

			<label for="book_title">Book Title</label>
			<input type="text" id="book_title" name="book_title" value="<?=htmlspecialchars($title)?>" required />

			<label for="book_description">Book Description</label>
			<input type="text" id="book_description" name="book_description" value="<?=htmlspecialchars($desc)?>" required />

			<label for="book_author">Book Author</label>
			<select id="book_author" name="book_author" required>
				<option value="0">Select author</option>
				<?php if ($authors != 0): ?>
					<?php foreach ($authors as $author): ?>
						<option value="<?=htmlspecialchars($author['id'])?>" <?= ($author_id == $author['id']) ? 'selected' : '' ?>>
							<?=htmlspecialchars($author['name'])?>
						</option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>

			<label for="book_category">Book Category</label>
			<select id="book_category" name="book_category" required>
				<option value="0">Select category</option>
				<?php if ($categories != 0): ?>
					<?php foreach ($categories as $category): ?>
						<option value="<?=htmlspecialchars($category['id'])?>" <?= ($category_id == $category['id']) ? 'selected' : '' ?>>
							<?=htmlspecialchars($category['name'])?>
						</option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>

			<label for="book_cover">Book Cover</label>
			<input type="file" id="book_cover" name="book_cover" />

			<label for="file">File</label>
			<input type="file" id="file" name="file" />

			<button type="submit">Add Book</button>
		</form>
	</div>
</body>
</html>

<?php
} else {
  header("Location: login.php");
  exit;
}
?>
