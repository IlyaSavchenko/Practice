<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link  rel="stylesheet" type="text/css"/href="test.css">
<title>Authorization</title>
</head>
<?php
@session_start();
if(isset($_SESSION['login']))
	{
		echo $_SESSION['loginchoose'];
		echo $_SESSION['login'];
		//$login='Hello, '.$_SESSION['login'].'!';
		if (isset($_SESSION['loginchoose']))
		{
			switch ($_SESSION['loginchoose']) {
				case 1:
					echo "<script>document.location.replace('lectures.php');</script>";
					break;
				case 2:
					echo "<script>document.location.replace('home.php');</script>";
					break;
			}
		}
	}
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
	echo "<p align = 'center' style='margin-left'><font color='#FF0000' face='Myriad Pro'><b>You are logged in as a guest.</b></font></p>
	</br>
	<table align = 'center' border = '0' width='30%'>
    </tr>
        <td>
            <img src='image/Head.png' alt='альтернативный текст'>
        </td>
        </tr>
        <td background = 'image/bg.jpg'>
	       <form align = 'center' id='forma' action='script1.php' method='post'>
           </br></br></br></br></br></br></br>
	       <p><font face='Myriad Pro'>Login: </font><br/><input type='text' name='login'></p>
           <p><font face='Myriad Pro'>Password: </font><br /><input type='password' name='password'></p>
	       <select name='choose'>
              <option value='2'><font face='Myriad Pro'>Student</font></option>
  		      <option value='1'><font face='Myriad Pro'>Lecture</font></option>
	       </select>
	       <p>
              <input type='submit' name='submit' value='' class='sendsubmit'>
	       <br>
           </p>
       	   </form>
	       <p align = 'center' style='margin-left'>
              <a href='registration.php'>Registration</a>
           </p>";
}
/*else
{
	echo "<br /><br />You are logged in as ".$_SESSION['login']."<br><br/>";
	echo ('<form action="close.php" method="POST">
	<input type="submit" value="Exit"/>
	</form></td></tr></table>');
}*/
?>


</body>
</html>