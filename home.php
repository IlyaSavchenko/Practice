<?php session_start(); 
	if (isset($_POST["subjects"])) {
		$selected = $_POST["subjects"];
		// foreach ($selected as $key => $value) {
		// 	echo $key . '  ' . $value . "<br>";
		// }
		$table["name"] = $_SESSION['origintable']["name"];
		foreach ($selected as $key => $value) {
			$table["marks"][$_SESSION['temptable'][$value][0]] = $_SESSION['temptable'][$value][1];
		}
		$_SESSION['origintable'] = $table;
		echo "<script>document.location.replace('./Export/export.php');</script>";
		exit();
	}
?>
<html>
	<head>
		<title>
			Students Journal
		</title>
		<link  rel="stylesheet" type="text/css"/href="test.css">
        <style>
        body {
            background: url(image/bgg.png) no-repeat;
            background-size: 100%; /* Современные браузеры */
        }
        table{
            border-color: #3d58b3;
        }
        </style>
        <script language="JavaScript">
			function toggle(source) {
				checkboxes = document.getElementsByName('subjects[]');
				for(var i=0, n=checkboxes.length;i<n;i++) {
					checkboxes[i].checked = source.checked;
				}
			}
		</script>
	</head>
	<body background="img.jpg">
	<table border="0" align="center" width="100%">
    	<tr>	
    	<td align="center"><img src='image/bigHead.png' alt='Stud Journal'>
    	</td>
    </tr>
    <tr>
    <?php
		if ((isset($_SESSION['exit']) && $_SESSION['exit'] == true) || isset($_POST['Exit'])) {
				$_SESSION['login'] = null;
				$_SESSION['exit'] = true;
				$_SESSION['loginchoose'] = null;
				 echo "<script>document.location.replace('./index.php');</script>";
				 exit;
			}
			$login = $_SESSION['login'];
			
			$link = mysql_connect("localhost", "root", ""); echo mysql_error();
			mysql_select_db("students"); echo mysql_error(); 
			mysql_set_charset('utf8'); echo mysql_error();
			
			
			$studNameRes = mysql_query("SELECT upper(stud_name), upper(stud_surname) FROM students 
								  WHERE stud_login = '$login'", $link);
			$nameList = mysql_fetch_row ($studNameRes);
			
			
			$subjResult = mysql_query("SELECT upper(c.subj_name) FROM marks a, students b, subjects c 
								  WHERE b.stud_login = '$login' and a.stud_id = b.stud_id and 
								  a.subj_id = c.subj_id", $link);
			$subjList = MYSQL_NUMROWS($subjResult);
			
			
			$surLectRes = mysql_query("SELECT upper(d.lect_surname) 
								  FROM marks a, students b, subjects c, lectures d, lect_subj e
								  WHERE b.stud_login = '$login' and a.stud_id = b.stud_id and 
								  a.subj_id = c.subj_id and c.subj_id = e.subj_id and e.lect_id = d.lect_id", $link);
			$nameLectRes = mysql_query("SELECT upper(d.lect_name) 
								    FROM marks a, students b, subjects c, lectures d, lect_subj e
								    WHERE b.stud_login = '$login' and a.stud_id = b.stud_id and 
								    a.subj_id = c.subj_id and c.subj_id = e.subj_id and e.lect_id = d.lect_id", $link);			
			$lectList = MYSQL_NUMROWS($surLectRes);

			$markRes = mysql_query("SELECT a.mark
								  FROM marks a, students b, subjects c, lectures d, lect_subj e
								  WHERE b.stud_login = '$login' and a.stud_id = b.stud_id and 
								  a.subj_id = c.subj_id and c.subj_id = e.subj_id and e.lect_id = d.lect_id", $link);
			$markList = MYSQL_NUMROWS($markRes);
	?>
		<font>
		<center>
		<table align="center" border="0">
		<tr>
			<td>
				<h1>
					<?php echo $nameList[0] . " " . $nameList[1] ; ?>
				</h1>
			</td>
			<td>
				<?php
					echo "<form method = 'post' action = './home.php'><input name = 'Exit' type = 'submit' value = '' class = 'exitst'></form>";
					// if ())
					// { 
					// 	$_SESSION['exit'] = true;
					// }
				?>
			</td>
		</tr>		
		</center>
		<?php
			//$table['name'] = $nameList[0] . "_" . $nameList[1];
			for($i = 0; $i < $markList; $i++ )
			{
				$_SESSION['temptable'][$i][0] = mysql_result($subjResult, $i);
				$_SESSION['temptable'][$i][1] =  mysql_result($markRes, $i);
				//$table['marks'][mysql_result($subjResult, $i)] = mysql_result($markRes, $i);
			}
			
			$_SESSION['origintable']['name'] = $nameList[0] . "_" . $nameList[1];// = $table;
			
			
			echo "<form align='center' method = 'post' action = './home.php' name=\"subjects\">";
			echo "<table cellspacing = '0' border = 3 align = 'center'>";	
				echo "<tr>";
					// echo "<td align = 'center' style='font-size: 20pt'>", "Имя", "</td>";
					// echo "<td align = 'center' style='font-size: 20pt'>", "Фамилия", "</td>";
					echo "<td align = 'center' style='font-size: 20pt'>", "<input type=\"checkbox\" onClick=\"toggle(this)\" />", "Subjects", "</td>";
					echo "<td align = 'center' style='font-size: 20pt'>", "Lectors", "</td>";
				echo "</tr>";
				
				echo "<tr>";
					// echo "<td align = 'center' style='font-size: 15pt'>", $nameList[0], "</td>";
					// echo "<td align = 'center' style='font-size: 15pt'>", $nameList[1], "</td>";	
					echo "<td align = 'left' style='font-size: 15pt'>";
						for($i = 0; $i < $subjList; $i++)
						{
							echo("<input type=\"checkbox\" name=\"subjects[]\" value='" . strval($i) . "'/>" .  mysql_result($subjResult, $i) . "</br>");
						}
					echo "</td>";
					echo "<td align = 'center' style='font-size: 15pt'>";
						for($i = 0; $i < $lectList; $i++)
						{
							echo mysql_result($surLectRes, $i)," ", mysql_result($nameLectRes, $i),   "</br>";
						}
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			echo "<p align='center'>";
			echo "<input align='center' name = 'Show marks' type = 'submit' value = '' class = 'sm'>";
			echo "</p>";
			echo "</form>";
			// echo "<form id='forma' action='./Export/export.php' method='post'> 
			// 	  <p align = 'center' ><input type='submit' name='submit' 
			// 	  value=' ' class = sm style='font-size: 15pt'><br></p></form>";
		?></tr>
        </table>
	</body>
</html>