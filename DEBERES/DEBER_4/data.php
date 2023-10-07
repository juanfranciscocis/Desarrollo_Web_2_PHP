<?php
session_start();

if (array_key_exists('register', $_POST)) {

    $departureCity = $_POST['departureCity'];
    $destinationCity = $_POST['destinationCity'];
    $departureDate = $_POST['departureDate'];
    $returnDate = $_POST['returnDate'];


    $numAdultPassengers = $_POST['numAdultPassengers'];
    $numChildPassengers = $_POST['numChildPassengers'];
    $_SESSION["numAdultPassengers"] = $numAdultPassengers;
    $_SESSION["numChildPassengers"] = $numChildPassengers;

	//validation variables
    $departureCityValid = 0;
	$departureDateValid = 0;
	$returnDateValid = 0;


    // Validate that the destination is not the same as the departure city
    if ($departureCity == $destinationCity) {
        $departureCityValid = 1;
        $departureError = "The departure city cannot be the same as the destination city";
        $destinationError = "The destination city cannot be the same as the departure city";

    } else{
        $_SESSION["departureCity"] = $departureCity;
        $_SESSION["destinationCity"] = $destinationCity;
    }

	if($returnDate < $departureDate) {
		$returnDateValid = 1;
		$returnDateError = "The return date cannot be less than the departure date";
    }else{
        $_SESSION["departureDate"] = $departureDate;
        $_SESSION["returnDate"] = $returnDate;
    }


	if ($departureCityValid == 0 && $returnDateValid == 0){
        //print in js console session
        echo "<script>console.log('Session: " . $_SESSION["departureCity"] . "')</script>";
        echo "<script>console.log('Session: " . $_SESSION["destinationCity"] . "')</script>";
        echo "<script>console.log('Session: " . $_SESSION["departureDate"] . "')</script>";
        echo "<script>console.log('Session: " . $_SESSION["returnDate"] . "')</script>";
        echo "<script>console.log('Session: " . $_SESSION["numAdultPassengers"] . "')</script>";
        echo "<script>console.log('Session: " . $_SESSION["numChildPassengers"] . "')</script>";
        //redirect to second form page
        header("Location: summary.php");
		exit();
	}






}
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
	<div class="card" style="width: 30rem;">
		<div class="card-body">
			<form method="post">
				<div class="form-group">
					<label for="departureCity">Departure City</label>
					<select class="form-control
						<?php
							if ($departureCityValid == 1) {
								echo "is-invalid";
                            }
						?>
						" id="departureCity" name="departureCity" required>
						<option value="<?php echo strtoupper($_SESSION["departureCity"]);?>"><?php if (isset($_SESSION["departureCity"])) {echo strtoupper($_SESSION["departureCity"]);} else {echo "Select";}?></option>
						<option value="QUITO">QUITO</option>
						<option value="GUAYAQUIL">GUAYAQUIL</option>
						<option value="SANTA CRUZ">SANTA CRUZ</option>
					</select>
					<small class="form-text text-muted">Choose your departure city.</small>
					<div class="invalid-feedback">
                        <?php
                        if ($departureCityValid == 1) {
                            echo $departureError;
                        }
                        ?>
					</div>
				</div>

				<div class="form-group">
					<label for="destinationCity">Destination City</label>
					<select class="form-control
						<?php
                            if ($departureCityValid == 1) {
                                echo "is-invalid";
                            }
                        ?>
						" id="destinationCity" name="destinationCity" required>
						<option value="<?php echo strtoupper($_SESSION["destinationCity"]);?>"><?php if (isset($_SESSION["destinationCity"])) {echo strtoupper($_SESSION["destinationCity"]);} else {echo "Select";}?></option>
						<option value="QUITO">QUITO</option>
						<option value="GUAYAQUIL">GUAYAQUIL</option>
						<option value="SANTA CRUZ">SANTA CRUZ</option>
					</select>
					<small class="form-text text-muted">Choose your destination city. Not the same as the departure city.</small>
					<div class="invalid-feedback">
                        <?php
                        if ($departureCityValid == 1) {
                            echo $destinationError;
                        }
                        ?>
					</div>
				</div>

				<div class="form-group">
					<label for="departureDate">Departure Date</label>
					<input type="date" class="form-control" id="departureDate" name="departureDate" required value="<?php echo $_SESSION["departureDate"]; ?>">
					<small class="form-text text-muted">Choose your departure date.</small>
				</div>

				<div class="form-group">
					<label for="returnDate">Return Date</label>
					<input type="date" class="form-control
						<?php
							if ($returnDateValid == 1) {
								echo "is-invalid";
							}
						?>
					" id="returnDate" name="returnDate" required value="<?php echo $_SESSION["returnDate"]; ?>">
					<small class="form-text text-muted">The return date cannot be less than the departure date.</small>
					<div class="invalid-feedback">
						<?php
						if ($returnDateValid == 1) {
							echo $returnDateError;
						}
						?>
					</div>
				</div>

				<div class="form-group">
					<label for="numAdultPassengers">Number of Adult Passengers</label>
					<input type="number" class="form-control" id="numAdultPassengers" name="numAdultPassengers" required min="1" max="10" value="<?php echo $_SESSION["numAdultPassengers"]; ?>">
					<small class="form-text text-muted">Must be at least 1 adult.</small>
				</div>

				<div class="form-group">
					<label for="numChildPassengers">Number of Child Passengers</label>
					<input type="number" class="form-control" id="numChildPassengers" name="numChildPassengers" min="0" max="10" value="<?php echo $_SESSION["numChildPassengers"]; ?>">
					<small class="form-text text-muted">Must be greater or equal to 0.</small>
				</div>

				<button type="submit" name="register" class="btn btn-primary">Register</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>
