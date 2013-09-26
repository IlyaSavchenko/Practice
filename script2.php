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
    echo 'Login is not entered';
}
elseif(empty($_POST['password']))
{
    echo 'Password is not entered';
}
elseif(empty($_POST['password2']))
{
    echo "You don't repeat password";
}
elseif($_POST['password'] != $_POST['password2'])
{
    echo 'Passwords do not match';
}
elseif(empty($_POST['name']))
{
    echo 'Name is not entered';
}
elseif(empty($_POST['surname']))
{
    echo 'Surname is not entered';
}
else
{    
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    //$password = md5( "$password" );
    $login = stripslashes($login);//удаляет экранирование символов, произведенное функцией addslashes()
    $login = htmlspecialchars($login);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай от действий умников-спамеров)
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);//удаляет пробелы (или другие символы) из начала и конца строки
    $password = trim($password);
    // Задаём переменные для подключения к БД
    $link = mysql_connect("localhost", "ilya", "admin")
        or die("Could not connect : " . mysql_error());
    // Подключаемся к БД mysql_connect($db_host, $db_user, $db_password);
    mysql_select_db("newdatabase") or die("Could not select database");
    $value;
    if ($_POST['choose'] == '1') 
    {
        $res = mysql_query("SELECT lecture_login FROM lectures WHERE lecture_login = '$login'", $link);
    } 
    else
    {
        if ($_POST['choose'] == '2') 
        {
            $res = mysql_query("SELECT student_login FROM students WHERE student_login = '$login'", $link);
        }    
    } 
    
    while ($line = mysql_fetch_array($res, MYSQL_ASSOC))
    { 
        foreach ($line as $col)
        {
            if($col == $login)
            {
                $value = $col;
            } 
        }
    }  
     
       
     if($value != $login)
     { 
        if ($_POST['choose'] == '1') 
        {
            $query=mysql_query("INSERT INTO `lectures`(`lecture_login`, `lecture_pass`, `lecture_name`, `lecture_surname`, `lecture_mtddlename`) 
            VALUES ('$login', '$password', '$name', '$surname', '$middlename')", $link)  or die("Query failed : " . mysql_error());
        }
        
        else
        {
            if($_POST['choose'] == '2') 
            {
                $query=mysql_query("INSERT INTO `students`(`student_login`, `student_pass`, `student_name`, `student_surname`, `student_middlename`) 
                VALUES ('$login', '$password', '$name', '$surname', '$middlename')", $link)  or die("Query failed : " . mysql_error());
            }
        }
        
        echo 'Регистрация успешно прошла';
        echo '<br /><br /><a href="/index.php">Войти на сайт</a>';
            
     }  
     else
     {
        echo "There is a login!";
     }  
      
}
}
    


?>