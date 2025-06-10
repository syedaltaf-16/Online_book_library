<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

	<style>
		body {
			background-color: #f6f6f2;
			margin: 0;
			font-family: 'Poppins', sans-serif;
		}

		form {
			width: 400px;
			background-color: rgba(255, 255, 255, 0.13);
			backdrop-filter: blur(8px);
			padding: 40px;
			border-radius: 12px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			color: #333;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h1 {
			text-align: center;
			margin-bottom: 30px;
		}

		label {
			display: block;
			margin-top: 20px;
			margin-bottom: 5px;
		}

		input {
			width: 100%;
			padding: 12px;
			border: none;
			border-radius: 8px;
			background-color: rgba(255, 255, 255, 0.8);
			box-sizing: border-box;
		}

		.alert {
			background-color: #f8d7da;
			color: #721c24;
			padding: 10px;
			border-radius: 8px;
			margin-bottom: 20px;
			text-align: center;
		}

		.button-group {
			display: flex;
			justify-content: space-between;
			margin-top: 30px;
		}

		button {
			width: 48%;
			padding: 12px;
			border: none;
			border-radius: 20px;
			background-color: #14B8A6;
			color: white;
			cursor: pointer;
			font-weight: bold;
			transition: background 0.3s ease;
		}

		button:hover {
			background-color: #0D9488;
		}
	</style>
</head>
<body>

	<form method="POST" action="php/auth.php">
		<h1>Login</h1>

		<?php if (isset($_GET['error'])): ?>
			<div class="alert">
				<?= htmlspecialchars($_GET['error']) ?>
			</div>
		<?php endif; ?>

		<label for="email">Email address</label>
		<input type="email" name="email" id="email" required>

		<label for="password">Password</label>
		<input type="password" name="password" id="password" required>

		<div class="button-group">
			<button href="author.php" type="submit">Login</button>
			<button type="button" onclick="window.location.href='index.php'">Back</button>
		</div>
	</form>

</body>
</html>
