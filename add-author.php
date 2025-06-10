<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Add Author</title>
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

		input[type="text"] {
			width: 100%;
			padding: 12px 15px;
			border: 1px solid #ccc;
			border-radius: 10px;
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
					<li><a href="add-book.php">Add Book</a></li>
					<li><a href="add-category.php">Add Category</a></li>
					<li><a href="add-author.php" class="active">Add Author</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>

		<form action="php/add-author.php" method="post" novalidate>
			<h1>Add New Author</h1>

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

			<label for="author_name">Author Name</label>
			<input type="text" id="author_name" name="author_name" required />

			<button type="submit">Add Author</button>
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
