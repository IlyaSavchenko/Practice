<?php

/**
 * @author Iluha
 * @copyright 2013
 */

//Присваиваем каждому значению в форме переменную, передаём переменным данные форм
if (isset($_POST['submit']))
{
if(empty($_POST['login']))
{
    
    echo "<p align='center'><img src='/image/Login.png' alt='альтернативный текст'></p>";
    
    //echo '<meta HTTP-EQUIV="refresh" content="2" url ="http://vk.com/im?peers=63657914&sel=17465086"> ';
    echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
    //sleep(3);
    //echo "<script>document.location.replace('registration.php');</script>"; 
    //'ob_end_flush();
}
elseif(empty($_POST['password']))
{
    echo "<p align='center'><img src='/image/pass.png' alt='альтернативный текст'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif(empty($_POST['password2']))
{
    echo "<p align='center'><img src='/image/repp.png' alt='альтернативный текст'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif($_POST['password'] != $_POST['password2'])
{
    echo "<p align='center'><img src='/image/repeat.png' alt='альтернативный текст'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif(empty($_POST['name']))
{
    echo "<p align='center'><img src='/image/name.png' alt='альтернативный текст'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif(empty($_POST['surname']))
{
    echo "<p align='center'><img src='/image/surname.png' alt='альтернативный текст'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif(empty($_POST['middlename']))
{
    echo "<p align='center'><img src='/image/mid.png' alt='нет отчества'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif (empty($_POST['course']))
{
    echo "<p align='center'><img src='/image/course.png' alt='альтернативный текст'></p>";
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
elseif(empty($_POST['group']))
{
    echo("<p align='center'><img src='/image/group.png' alt='альтернативный текст'></p>");
     echo "<p align = 'center'><a href = 'registration.php'>< Back</a></p>";
}
else
{    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $course = $_POST['course'];
    $group = $_POST['group'];
    //$password = md5( "$password" );
    $login = stripslashes($login);//удаляет экранирование символов, произведенное функцией addslashes()
    $login = htmlspecialchars($login);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай от действий умников-спамеров)
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);//удаляет пробелы (или другие символы) из начала и конца строки
    $password = trim($password);
    // Задаём переменные для подключения к БД
    $link = mysql_connect("localhost", "root", "")
        or die("Could not connect : " . mysql_error());
    // Подключаемся к БД mysql_connect($db_host, $db_user, $db_password);
    mysql_select_db("students") or die("Could not select database");
    
    $result = mysql_query("SELECT stud_login FROM students WHERE stud_login = '$login'", $link) 
        or die("Query failed : " . mysql_error());
        $error = false;
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
            foreach ($line as $col_value) 
            {
                if ($login == $col_value)
                {
                  echo "<p align='center'><img src='/image/user.png' alt='альтернативный текст'></p>";
                  echo '<br /><br /><p align = "center"><a href="/registration.php">Back</a></p>';
                  $error = true;
                }
            }
        }
        if (!$error)
        {
            $query=mysql_query("INSERT INTO students(stud_login, stud_pass, stud_name, stud_surname, stud_middlename, course, groupe) 
            VALUES ('$login', '$password', '$name', '$surname', '$middlename', $course, $group)", $link)  or die("Query failed : " . mysql_error());
            echo "<p align='center'><img src='/image/registr.png' alt='альтернативный текст'></p>";
            echo '<br /><br /><p align = "center"><a href="/index.php">Log in</a></p>';
         }
        
            
     /*}  
     else
     {
        echo "There is a login!";
     } */ 
      
}
}
    


?>