<html>
	<head>
		<title>Download files</title>
		<SCRIPT LANGUAGE="JavaScript">
			function CalculateMiddleValue() : flaot {

			}
		</SCRIPT>
	</head>
	<body>
		<table align = "center" border = "0">
			<tr>
				<td>
					<!-- <form method = "post" action = "./txt_export.php">
						<input type = "submit" value = "Download *.txt", name = "txtexp">
					</form> -->
					<a href = "./txt_export.php"><img src = "../Images/txt.png" width = "60" height="60" /></a>
				</td>
				<td>
<!-- 					<form method = "post" action = "./rtf_export.php">
						<input type = "submit" value = "Download *.rtf", name = "rtfexp">
					</form> -->
					<a href = "./rtf_export.php"><img src = "../Images/rtf.png" width = "60" height="60" /></a>
				</td>
				<td>
					<!-- <form method = "post" action = "./pdf_export.php">
						<input type = "submit" value = "Download *.pdf", name = "pdfexp">
					</form> -->
					<a href = "./pdf_export.php"><img src = "../Images/pdf.png" width = "60" height="60" /></a>
				</td>
				<td>
					<!-- <form method = "post" action = "./xml_export.php">
						<input type = "submit" value = "Download *.xml", name = "xmlexp">
					</form> -->
					<a href = "./xml_export.php"><img src = "../Images/xml.png" width = "60" height="60" /></a>
				</td>
				<td>
					<!-- <form method = "post" action = "javascript:(print());">
						<input type = "submit" value = "Print list", name = "print">
					</form> -->
					<a href = "javascript:(print())"><img src = "../Images/print.png" width = "60" height="60" /></a>
				</td>
			</tr>
			<tr>
				<td colspan = "5">
					<table align = "center" border = "1" bordercolor = "black" cellspacing = "0">
						<?php
							session_start();
							$table = $_SESSION["table"];			
							echo("<tr><td colspan = 2>Marks of ".$table["name"]."</td></tr>");
							echo("<tr><td>Subject</td><td>Mark</td></tr>");
							foreach ($table["marks"] as $key => $value) {
								$color = "white";
								switch ($value) {
									case 5:
										$color = "lightgreen";
										break;
									case 4:
										$color = "lightblue";
										break;
									case 3:
										$color = "yellow";
										break;
									case 2:
										$color = "red";
										break;
									default:
										$color = "white";
										break;
								}
								echo("<tr bgcolor = " . $color . "><td>".$key."</td><td>".$value."</td></tr>");
							}
						?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan = 5>
					
				</td>
			</tr>
		</table>
	</body>
</html>