<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authorization</title>
</head>
<?php
if(isset($_SESSION['login']))
	{
		$login='Hello, '.$_SESSION['login'].'!';
	}
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
	echo "<p align = 'center' style='margin-left'><font color='#FF0000'><b>You are logged in as a guest.</b></font></p>
	</br>
	<table align = 'center' border = '2' width='30%' background='bg.jpg'><td>
	<form align = 'center' id='forma' action='script1.php' method='post'>
	<h1><font color='#000066'>Welcome!</font></h1>
	<p>Please, input your information</p>
	<p>Login:<br/><input type='text' name='login'></p>
	<p>Password:<br /><input type='password' name='password'></p>
	<select name='choose'>
        <option value='2'>User</option>
  		<option value='1'>Administrator</option>
	</select>
	<p><input type='submit' name='submit' value='Log in'>
	<br></p>
	</form>
	<p align = 'center' style='margin-left'><a href='registration.php'>Registration</a></p>";
}
else
{
	echo "<br /><br />You are logged in as ".$_SESSION['login']."<br><br/>";
	echo ('<form action="close.php" method="POST">
	<input type="submit" value="Exit"/>
	</form></td></table>');
}
?>
<body background="bg2.jpg">
</body>
</html>