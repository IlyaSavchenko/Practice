<?php session_start(); 
	if ((isset($_SESSION['exit']) && $_SESSION['exit'] == true) || isset($_POST['Exit'])) {
				$_SESSION['login'] = null;
				$_SESSION['exit'] = true;
				$_SESSION['loginchoose'] = null;
				 echo "<script>document.location.replace('./index.php');</script>";
				 exit;
			}?>
<html>
	<head>
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
	</head>
	<body>
    <table width="100%">
    <tr><td align="center"><img align="center" src='image/bigHead.png' alt='Stud Journal'></td></tr>
    <tr>
    <td>
		<?php
			$ifChooseCorrect = false; //выводить или не выводить таблицу
			$ifChooseUpdate = false; //если выбран апдейт
			$ifChooseAdd = false;//если выбрано обновление
			$ifChooseFilter = false; // если выбран фильтр
			$ifChooseWithFilter = false;//если есть фильтр
			$ifMiddleClick = false;
			// получаю в пхп курс, группу, предмет
			if (isset($_GET['course']) && isset($_GET['groupe']) && isset($_GET['subject']))
			{
			    $_SESSION['info']['course'] = $_GET['course'];
				$_SESSION['info']['groupe'] = $_GET['groupe'];
				$_SESSION['info']['subject'] = $_GET['subject'];
				$ifChooseCorrect = true;
			}
			$course = $_SESSION['info']['course'];
			$groupe = $_SESSION['info']['groupe'];
			$subject = $_SESSION['info']['subject'];
			// получаю в пхп ФИО для обновления
			if (isset($_GET['surnameForUpdate']) && ($_GET['nameForUpdate']) && ($_GET['middlenameForUpdate']) && ($_GET['newMark']))
			{
				$surnameForUpdate = $_GET['surnameForUpdate'];
				$nameForUpdate = $_GET['nameForUpdate'];
				$middlenameForUpdate = $_GET['middlenameForUpdate'];
				$newMark = $_GET['newMark'];
				$ifChooseCorrect = true;
				$link = mysql_connect("localhost", "root", ""); echo mysql_error(); 
				mysql_select_db("students"); echo mysql_error(); 
				mysql_set_charset('utf8'); echo mysql_error();
				mysql_query("UPDATE marks SET mark = " . $newMark . " WHERE stud_id = (select stud_id from students where stud_surname = '" . $surnameForUpdate . "' and stud_name = '" . $nameForUpdate ."' and stud_middlename = '" . $middlenameForUpdate . "') and subj_id = (select subj_id from subjects where subj_name = '" . $subject . "')");
			}
			if (isset($_GET['ifChooseUpdate']))
			{
				$ifChooseUpdate = $_GET['ifChooseUpdate'];
				$ifChooseCorrect = true;
			}
			if (isset($_GET['ifChooseAdd']))
			{
				$ifChooseAdd = $_GET['ifChooseAdd'];
				$ifChooseCorrect = true;
			}
			if (isset($_GET['ifChooseFilter']))
			{
				$ifChooseFilter = $_GET['ifChooseFilter'];
				$ifChooseCorrect = true;
			}
			if (isset($_GET['filterOperation']) && isset($_GET['filterValue']))
			{
			    $filterOperation = $_GET['filterOperation'];
				$filterValue = $_GET['filterValue'];
				$ifChooseCorrect = true;
				$ifChooseWithFilter = true;
			}
			if (isset($_GET['ifMiddleClick']))
			{
				$ifMiddleClick = $_GET['ifMiddleClick'];
				$ifChooseCorrect = true;
			}
			// коннекшин + приветствие
			$login = ($_SESSION['login']);
			$link = mysql_connect("localhost", "root", ""); echo mysql_error(); 
			mysql_select_db("students"); echo mysql_error(); 
			mysql_set_charset('utf8'); echo mysql_error();
			$result = mysql_query("SELECT lect_name, lect_middlename FROM lectures where lect_login = '$login'");
			$name = mysql_result($result, 0);
			$middlename = mysql_result($result, 0, 1);
		?>
			<table align="center">
			<tr>
			<td>
		<?php	echo ("<h3 align = 'center'>" . $name . " " .  $middlename . "</h3>");  ?>
			</td>
			<td>
			<?php	echo "<form method = 'post' action = './home.php'><input name = 'Exit' type = 'submit' value = '' class = 'exitlect'></form>";
				if (isset($_POST['Exit'])) ?>
			</td>
			</tr>
			</table>

		<table width = "100%">
				<tr>
				<td>
				<?php
				// кнопки: адд + апдейт + делит
				echo"<td align = \"center\">";
				if ($ifChooseCorrect)
				{
					echo"<br>";
					echo" <button class = 'upd' onclick=\"UpdateClick(this)\"/>";
					echo" <button class = 'add' onclick=\"AddClick(this)\"/>";
					echo" <button class = 'filt' onclick=\"FilterClick(this)\"/>";
					echo" <button class = 'mid' onclick=\"MiddleClick(this)\"/>";
				}
				echo"</td>";
				?>
				</td>
			</tr>
			<tr>
				<td>
					<!-- выбор курса -->
					<h4 align = "left">Choose course:</h4>
					<select onchange = "ChooseCourse(this)">
						<option value ="0"> </option>					
			  			<option value ="1">1</option>
			  			<option value ="2">2</option>
			  			<option value ="3">3</option>
			  			<option value ="4">4</option>
					</select>
					<!-- выбор группы -->
					<h4 align = "left">Choose groupe: </h4>
					<select onchange = "ChooseGroupe(this)">
						<option value ="0"> </option>
			  			<option value ="1">1</option>
			  			<option value ="2" >2</option>
			  			<option value ="3">3</option>
			  			<option value ="4">4</option>
			  			<option value ="5">5</option>
					</select>
					<!-- заполнение списка предметами, которые выдет препод -->
					<h4 align = "left">Choose subject: </h4>
					<select onchange = "ChooseSubject(this)">
						<option value ="0"> </option>
						<?php
			 				$result = mysql_query("SELECT subj_name FROM subjects where subj_id in (select subj_id from lect_subj where lect_id = (select lect_id from lectures where lect_login = '$login'))");
			 				$i = 0;
			 				while ($row = mysql_fetch_array($result))
			 				{
			 					$va = mysql_result($result, $i);
			 					echo("<option>".$va."</option>");
			 					$i++;
			 				}
						?>	
					</select>
				</td>
				<td>
					<?php
					// заполнение таблицы данными
					if ($ifChooseCorrect)
					{
						echo"<table align = \"center\" border = \"1\" cellspacing = '0' cellpadding = \"5\">";
						echo"<tr>";
							echo"<td>Last name</td>";
							echo"<td>Name</td>";
							echo"<td>Middlename</td>";
							echo"<td>Subject</td>";
							echo"<td>Mark</td>";
						echo"</tr>";
						if (!$ifChooseWithFilter)				
							$result = mysql_query("SELECT stud_surname, stud_name, stud_middlename, subj_name, mark FROM students s JOIN subjects su JOIN marks m on s.stud_id = m.stud_id and m.subj_id = (select subj_id from subjects where subj_name = '$subject') WHERE course = $course AND groupe = $groupe AND subj_name = '$subject'");			
						else
							$result = mysql_query("SELECT stud_surname, stud_name, stud_middlename, subj_name, mark FROM students s JOIN subjects su JOIN marks m on s.stud_id = m.stud_id and m.subj_id = (select subj_id from subjects where subj_name = '$subject') WHERE course = $course AND groupe = $groupe AND subj_name = '$subject' and m.mark $filterOperation $filterValue");
						$i = 0;
		 				while ($row = mysql_fetch_array($result))
		 				{
		 					echo"<tr>";
		 					$rs = mysql_result($result, $i);
		 					echo"<td>".$rs."</td>";
		 					$rn = mysql_result($result, $i, 1);
		 					echo"<td>".$rn."</td>";
		 					$rm = mysql_result($result, $i, 2);
		 					echo"<td>".$rm."</td>";
		 					$rsu = mysql_result($result, $i, 3);
		 					echo"<td>".$rsu."</td>";
		 					$rma = mysql_result($result, $i, 4);
		 					echo"<td>".$rma."</td>";
		 					echo"</tr>";
		 					$i++;
		 				}
						echo"</table>";
					}
					?>					
				</td>
				<td align="center" width="35%">
				 	<!-- выбор студента для обновления оценки -->
					<?php
					if ($ifChooseUpdate)
					{	
						echo"<h4>Choose student: </h4>";
						echo"<select onchange = \"ChooseForUpdate(this)\">";
							echo"<option value =\"0\"> </option>";
			 				$result = mysql_query("SELECT stud_surname, stud_name, stud_middlename FROM students WHERE stud_id IN (SELECT stud_id FROM marks WHERE subj_id = (SELECT subj_id FROM subjects WHERE subj_name = '$subject') AND mark IS not NULL) AND course = $course AND groupe = $groupe");
			 				$i = 0;
			 				while ($row = mysql_fetch_array($result))
			 				{
			 					$rs = mysql_result($result, $i);
			 					$rn = mysql_result($result, $i, 1);
			 					$rm = mysql_result($result, $i, 2);
			 					echo("<option>".$rs.' '.$rn.' '.$rm."</option>");
			 					$i++;
			 				}
						echo"</select>";
						echo"<br>";
						echo"<br>";
						echo"<input onblur = \"InputNewMark(this)\"></input>";
						echo"<br>";
						echo"<br>";
						echo"<button class = 'ok' onclick=\"UpdateMark(this)\"/>";
					}
					if ($ifChooseAdd)
					{
						echo"<h4>Choose student: </h4>";
						echo"<select onchange = \"ChooseForUpdate(this)\">";
							echo"<option value =\"0\"> </option>";
							$result = mysql_query("SELECT stud_surname, stud_name, stud_middlename FROM students WHERE stud_id IN (SELECT stud_id FROM marks WHERE subj_id = (SELECT subj_id FROM subjects WHERE subj_name = '$subject') AND mark IS NULL) AND course = $course AND groupe = $groupe");
			 				$i = 0;
			 				while ($row = mysql_fetch_array($result))
			 				{
			 					$rs = mysql_result($result, $i);
			 					$rn = mysql_result($result, $i, 1);
			 					$rm = mysql_result($result, $i, 2);
			 					echo("<option>".$rs.' '.$rn.' '.$rm."</option>");
			 					$i++;
			 				}
						echo"</select>";
						echo"<br>";
						echo"<br>";
						echo"<input onblur = \"InputNewMark(this)\"></input>";
						echo"<br>";
						echo"<br>";
						echo"<button class = 'ok' onclick=\"UpdateMark(this)\"/>";					
					}
					if ($ifChooseFilter)
					{
						echo"<h4>Choose operation: </h4>";
						echo"<select onchange = \"ChooseForFilter(this)\">";
							echo"<option value = \"0\"> </option>";
							echo"<option value = \"=\">=</option>";
							echo"<option value = \"<\"><</option>";
							echo"<option value = \">\">></option>";
							echo"<option value = \"<=\"><=</option>";
							echo"<option value = \">=\">>=</option>";
							echo"<option value = \"!=\">!=</option>";
						echo"</select>";
						echo"<br>";
						echo"<br>";
						echo"<input onblur = \"FilterValue(this)\"></input>";
						echo"<br>";
						echo"<br>";
						echo"<button class = 'filt' onclick=\"FilterMethod()\"/>";	
					}
					if ($ifMiddleClick)
					{
						$result = mysql_query("select avg(mark) from marks where subj_id in (select subj_id from subjects where subj_name = '$subject')");
						echo "Middle mark = ".mysql_result($result, 0);
					}
					?>
				</td>
			</tr>
		</table>
        </tr>
        </table>
    </tr>
    </td>
    </table>
	</body>
		<script type="text/javascript">
			var course, groupe, subject, fio, newMark, ifChooseUpdate, ifChooseAdd, ifChooseFilter, filterOperation, filterValue, ifMiddleClick;
			function ChooseCourse(sel)
			{  
				course = sel.options[sel.selectedIndex].value;
	    	} 
			function ChooseGroupe(sel)
			{  
				groupe = sel.options[sel.selectedIndex].value;
	    	} 
			function ChooseSubject(sel)
			{  
				subject = sel.options[sel.selectedIndex].value;
				location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&course=" + course + "&groupe=" + groupe + "&subject=" + subject;
	    	}
	    	function UpdateClick()
	    	{		
	    		ifChooseUpdate = true;
	    		location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&ifChooseUpdate=" + ifChooseUpdate;
	    	}	
	    	function AddClick()
	    	{
	    		ifChooseAdd = true;
	    		location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&ifChooseAdd=" + ifChooseAdd;
	    	}
	    	function FilterClick()
	    	{
	    		ifChooseFilter = true;
	    		location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&ifChooseFilter=" + ifChooseFilter;
	    	}
	    	function MiddleClick()
	    	{
	    		ifMiddleClick = true;
	    		location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&ifMiddleClick=" + ifMiddleClick;
	    	}
	    	function ChooseForUpdate(sel)
	    	{
	    		choouseForUpdate = sel.options[sel.selectedIndex].value;
	    		fio = choouseForUpdate.split(' ');
	    	}	
	    	function InputNewMark(inp)
	    	{
	    		newMark = inp.value;
	    	}
	    	function UpdateMark()
	    	{
	    		location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&surnameForUpdate=" + fio[0] + "&nameForUpdate=" + fio[1] + "&middlenameForUpdate=" + fio[2] + "&newMark=" + newMark;
	    	}
	    	function ChooseForFilter(sel)
	    	{
	    		filterOperation = sel.options[sel.selectedIndex].value;
	    	}
	    	function FilterValue(inp)
	    	{
	    		filterValue = inp.value;
	    	}
	    	function FilterMethod()
	    	{
	    		location.href = "lectures.php?${_SERVER['QUERY_STRING']}" + "&filterOperation=" + filterOperation + "&filterValue=" + filterValue;
	    	}
		</script>
</html>