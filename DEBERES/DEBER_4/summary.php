<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; width: max-content; height: 100vh; margin: auto;">
	<div class="card" style="width: 30rem; display: flex; justify-content: center; align-items: center; flex-direction: column;">
		<div class="card-body" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
			<h1 class="card-title">TOTAL</h1>
			<hr>
			<p class="card-text">Name: <?php echo strtoupper($_SESSION["name"]); ?></p>
			<p class="card-text">Last Name: <?php echo strtoupper($_SESSION["lastName"]); ?></p>
			<p class="card-text">Email: <?php echo strtolower($_SESSION["email"]); ?></p>
			<p class="card-text">Phone: <?php echo strtoupper($_SESSION["phone"]); ?></p>
			<hr>
			<p class="card-text">Departure City: <?php echo strtoupper($_SESSION["departureCity"]); ?></p>
			<p class="card-text">Destination City: <?php echo strtoupper($_SESSION["destinationCity"]); ?></p>
			<p class="card-text">Departure Date: <?php echo strtoupper($_SESSION["departureDate"]); ?></p>
			<p class="card-text">Return Date: <?php echo strtoupper($_SESSION["returnDate"]); ?></p>
			<p class="card-text">Number of Adults: <?php echo strtoupper($_SESSION["numAdultPassengers"]); ?></p>
			<p class="card-text">Number of Kids: <?php echo strtoupper($_SESSION["numChildPassengers"]); ?></p>
			<hr>
			<p class="card-text">Subtotal Ticket Adults: $<?php echo strtoupper($_SESSION["numAdultPassengers"]* 100); ?></p>
			<p class="card-text">Subtotal Ticket Kids: $<?php echo strtoupper($_SESSION["numChildPassengers"]* 50); ?></p>
			<hr>
			<p class="card-text">Total: $<?php echo strtoupper(($_SESSION["numAdultPassengers"]* 100) + ($_SESSION["numChildPassengers"]* 50)); ?></p>
			<hr>
			<a href="index.php" class="btn btn-primary">Comprar</a>
		</div>
	</div>
</div>



</body>
</html>