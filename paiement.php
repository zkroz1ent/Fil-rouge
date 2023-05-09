<!DOCTYPE html>
<html>
<head>
	<title>Payment Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			padding: 20px;
		}
		form {
			background-color: #fff;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			max-width: 500px;
			margin: 0 auto;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		input[type="text"], input[type="email"], select {
			padding: 10px;
			border-radius: 4px;
			border: 1px solid #ccc;
			box-sizing: border-box;
			width: 100%;
			margin-bottom: 20px;
			font-size: 16px;
		}
	</style>
</head>
<body>
<form class="form" action="paiement_validation.php" method="post">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" placeholder="Enter your name" required>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" placeholder="Enter your email" required>
		<label for="card">Credit Card Number:</label>
		<input type="text" id="card" name="card" placeholder="Enter your credit card number" required>
		<label for="exp">Expiration Date:</label>
		<input type="month" id="exp" name="exp" required>
		<label for="cvv">CVV:</label>
		<input type="text" id="cvv" name="cvv" placeholder="Enter your CVV" required>
		<input type="submit" value="Submit Payment">
	</form>
</body>
</html>
