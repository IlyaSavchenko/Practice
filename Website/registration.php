<?php

/**
 * @author Iluha
 * @copyright 2013
 */

echo "
<html>
<head>
<link rel='stylesheet' type='text/css' href='style.css' />
<title>Registration</title>
</head>
<body>
<!--Подключение обработчика формы-->
</br>
	<table align = 'center' border = '0' width='30%' background='bg.jpg'><tr><td>
<form align = 'center' id='forma' action='script2.php' method='POST'>
<h1 align = 'center'>Register a profile</h1>
<p align = 'center'><font size = '+1,5'>Input information</font> </p>
<p>*Login: <input type='text' name='login' ></p>
<p>*Password: <input type='password' name='password' ></p>
<p>*Repeat pass:  <input type='password' name='password2'></p>
<p>*Name: <input type='text' name='name'></p>
<p>*Surname: <input type='text' name='surname'></p>
<p>Middlename: <input type='text' name='middlename'></p>
<select name='choose'>
        <option value='2'>User</option>
  		<option value='1'>Administrator</option>
	</select>
<p><input type='submit' value='Registration' name='submit' ></p>
</form></td></tr>
<tr align = 'center'><td>(*) - mandatory information</td></tr></table>
</body>
</html>";


?>