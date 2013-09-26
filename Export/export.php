<?php session_start(); ?><html>
	<head>
		<title>Download files</title>
		<?php
			$table = $_SESSION["origintable"];
			$filter = isset($_POST["filter"]) && $_POST['filter'] == "Apply filter";
			function InsertMarkTable($table)
			{
				echo('<table align = "center" border = "1" bordercolor = "black" cellspacing = "0">');
				echo("<tr><td colspan = 2>Marks of ".$table["name"]."</td></tr>");
				echo("<tr><td>Subject</td><td>Mark</td></tr>");
				if (isset($table["marks"]))
				{ 
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
				}
				echo('</table>');
			}

			function print_table($table)
			{
				if ($table == null)
					echo "null table<br>";
				else
				{
					echo $table['name']."<br>";
					foreach ($table['marks'] as $key => $value) {
						echo $key." ".$value."<br>";
					}
				}
			}

			function Filter($table, $mark)
			{
				$newTable;
				if ($mark == "") return $table;
				if (is_integer($mark))
				{
					$newTable["name"] = $table["name"];
					foreach ($table["marks"] as $key => $value) {
						if ($value == $mark) 
						{
							$newTable["marks"][$key] = $value;
						}
					}
				} 
				else
				{
					$newTable["name"] = $table["name"];
					foreach ($table["marks"] as $key => $value) {
						if (substr_count($key, $mark) > 0) 
						{
							$newTable["marks"][$key] = $value;
						}
					}
				}
				return $newTable;
			}
		?>
	</head>
	<body>
		<table align = "center" border = "0">
			<tr>
				<td colspan = "6">	
				<img src="../Images/Head.png"/>
				</td>
			</tr>
			<tr>
				<td>
					<img src = "../Images/download.png" width = "60" height="60" />
				</td>
				<td>
					<a href = "./txt_export.php"><img src = "../Images/txt.png" width = "60" height="60" /></a>
				</td>
				<td>
					<a href = "./rtf_export.php"><img src = "../Images/rtf.png" width = "60" height="60" /></a>
				</td>
				<td>
					<a href = "./pdf_export.php"><img src = "../Images/pdf.png" width = "60" height="60" /></a>
				</td>
				<td>
					<a href = "./xml_export.php"><img src = "../Images/xml.png" width = "60" height="60" /></a>
				</td>
				<td>
					<a href = "javascript:(print())"><img src = "../Images/print.png" width = "60" height="60" /></a>
				</td>
			</tr>
			<tr>
				<td>
					<img src = "../Images/filter.png" width = "60" height="60" />
				</td>
				<td colspan = "5">	
					<form method = "post" action = "./export.php">
						<table align="center" border = 0>
							<tr align="center">
								<td align="left">
									<input type="radio" name="choose" value="mark" <?php if ($filter) echo("hidden = true"); ?>><?php if (!$filter) echo("Mark filter");?></input>
								</td>
								<td align="center">
									<input type = "text" name = "filtertext" <?php if ($filter) echo("value = '".$_POST['filtertext']."'")?>>
								</td>
							</tr>
							<tr align="center">
								<td align="left">
									<input type="radio" name="choose" value="subj"<?php if ($filter) echo("hidden = true"); ?>><?php if (!$filter) echo("Subject filter");?></input>
								</td>
								<td align="center">
									<input type = "submit" value = <?php if ($filter) echo("'Close filter'"); else echo("'Apply filter'");?> name = "filter">
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
			<tr>
				<td colspan="6" align="center">
					<?php
						if ($table != null)
						{
							if ($filter)
							{
								echo "Filter is active<br>";
								if (!isset($_POST['choose']))
								{
									$table = Filter($table, "");
									echo("You does not choose the type of filter<br>");
								}
								else
								{
									if ($_POST["choose"] == "mark")
									{
										$table = Filter($table, (int)$_POST["filtertext"]);
										echo("Mark filter<br>");
									}
									else
									{
										$table = Filter($table, $_POST["filtertext"]);
										echo("Subject filter<br>");
									}
								}
							}
							InsertMarkTable($table);
						}
						else 
						{
							echo "<font color = 'red'>";
							echo "Dear friend, you does not have some marks.<br>";
							echo "</font>";
						}
						echo "<br>";
						$_SESSION["export"] = $table;
					?>
				</td>
			</tr>
		</table>
	</body>
</html>