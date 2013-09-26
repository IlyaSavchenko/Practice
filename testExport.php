<?php session_start(); ?>
<html>
	<head>
		<title>Main page of local server.</title>
	</head>
	<body>
		<?php
			ini_set('display_errors',1);
			error_reporting(E_ALL);
			$table["name"] = "Borisov Vasily";
			$table["marks"]["Math"] = 5;
			$table["marks"]["Russian"] = 4;
			$table["marks"]["Chemistry"] = 3;
			$table["marks"]["Physics"] = 5;
			$table["marks"]["Biology"] = 4;
			$table["marks"]["Art"] = 2;
			$table["marks"]["BD development"] = 5;
			
			$_SESSION["origintable"] = $table;
		?>
		<form method = "post" action = "./Export/export.php">
			<input type = "submit" value = "Show marks", name = "okbutton">
		</form>
	</body>
</html>