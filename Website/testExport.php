<html>
	<head>
		<title>Main page of local server.</title>
	</head>
	<body>
		<?php
			session_start();
			$table[0]["name"] = "Borisov Vasily";
			$table[0]["marks"]["Math"] = 5;
			$table[0]["marks"]["Russian"] = 4;
			$table[0]["marks"]["Chemistry"] = 3;
			$table[0]["marks"]["Physics"] = 5;
			$table[0]["marks"]["Biology"] = 4;
			$table[0]["marks"]["Art"] = 2;
			$table[0]["marks"]["BD development"] = 5;

			$table[1]["name"] = "Ivanov Petr";
			$table[1]["marks"]["Math"] = 3;
			$table[1]["marks"]["Russian"] = 4;
			$table[1]["marks"]["Chemistry"] = 4;
			$table[1]["marks"]["Physics"] = 3;
			$table[1]["marks"]["Biology"] = 5;
			$table[1]["marks"]["Art"] = 5;
			// $table[0][0] = "Math";
			// $table[0][1] = "5";
			// $table[1][0] = "Russian";
			// $table[1][1] = "4";
			// $table[2][0] = "Chemistry";
			// $table[2][1] = "3";
			// $table[3][0] = "Physics";
			// $table[3][1] = "5";
			// $table[4][0] = "Art";
			// $table[4][1] = "5";
			// $table[5][0] = "Biology";
			// $table[5][1] = "4";
			
			$_SESSION["table"] = $table[0];
			// $_SESSION["clientName"] = "Borisov Vasily"
		?>
		<form method = "post" action = "./Export/export.php">
			<input type = "submit" value = "Show marks", name = "okbutton">
		</form>
	</body>
</html>