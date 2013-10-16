<?php

/** 
 * @author Iluha
 * @copyright 2013
 */

echo "
<html>
<head>
<link rel='stylesheet' type='text/css' href='Test.css' />
<title>Registration</title>
</head>
<body>
</br>
	<table align = 'center' border = '0' width='30%' >
    <tr>
        <td>
            <img src='image/Head.png' alt='альтернативный текст'>
        </td>
    </tr>
    <td background = 'image/reg.png'>
        <form align = 'center' id='forma' action='script2.php' method='POST'>
        </br></br></br></br>
        <PRE><p><font face='Myriad Pro'>*Login: &nbsp&nbsp &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='login' ></font></p></PRE>
        <p><font face='Myriad Pro'>*Password: &nbsp&nbsp&nbsp&nbsp&nbsp<input type='password' name='password' ></font></p>
        <p><font face='Myriad Pro'>*Repeat pass:  &nbsp<input type='password' name='password2'></font></p>
        <p><font face='Myriad Pro'>*Name: &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='text' name='name'></font></p>
        <p><font face='Myriad Pro'>*Surname: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='text' name='surname'></font></p>
        <p><font face='Myriad Pro'>*Middlename: <input type='text' name='middlename'></font></p>
        <p><font face='Myriad Pro'>*Course:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type='text' name='course'></font></p>
        <p><font face='Myriad Pro'>*Group: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='text' name='group'></font></p>
        <p><input type='submit' value='' name='submit' class = 'regsubmit' ></p>
    </form></td>
</body>
</html>";


?>