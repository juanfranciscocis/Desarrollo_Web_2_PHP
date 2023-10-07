<?php
	session_start(); // Start the session


	//variables from post
	if (array_key_exists('registrar', $_POST)) {
		$name = $_POST['name'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		//save the variables in session
		$_SESSION["name"] = $name;
		$_SESSION["lastName"] = $lastName;
		$_SESSION["email"] = $email;
		$_SESSION["phone"] = $phone;
		//print in js console session
		echo "<script>console.log('Session: " . $_SESSION["name"] . "')</script>";
		echo "<script>console.log('Session: " . $_SESSION["lastName"] . "')</script>";
		echo "<script>console.log('Session: " . $_SESSION["email"] . "')</script>";
		echo "<script>console.log('Session: " . $_SESSION["phone"] . "')</script>";

		//redirect to second form page
		header("Location: data.php");
		exit();
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DEBER 4</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; width: max-content; height: 100vh; margin: auto;">
	<div class="card" style="width: 30rem;">
		<div class="card-body">
			<form method="post">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $_SESSION["name"]; ?>" required minlength="5" pattern="[A-Za-z]+">
					<small class="form-text text-muted">Must be at least 5 characters and contain only letters.</small>
				</div>
				<div class="form-group">
					<label for="lastName">Last Name</label>
					<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" value="<?php echo  $_SESSION["lastName"]; ?>" required minlength="5" pattern="[A-Za-z]+">
					<small class="form-text text-muted">Must be at least 5 characters and contain only letters.</small>
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo  $_SESSION["email"]; ?>" required pattern="[a-zA-Z0-9._\-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}">
					<small class="form-text text-muted">Please enter a valid email address.</small>
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo  $_SESSION["phone"]; ?>" required pattern="\d{10}">
					<small class="form-text text-muted">Must contain 10 digits.</small>
				</div>
				<button type="submit" name="registrar" class="btn btn-primary">Register</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>

