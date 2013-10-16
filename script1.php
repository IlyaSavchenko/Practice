<?php
@session_start();//вся процедура сверки логина и паролей работает на сессиях. Именно в них хранятся данные  пользователя, пока он находится на сайте. Запускать сессию нужно в начале странички
 
//header('Refresh: 5; URL=http://lora.in.ua/php-uroki/avtorizaciya/vhod.php'); //redirect с задержкой
//echo 'Вы будете перенаправлены на главную страницу через 5 секунд.'; //вывод сообщения
 
    if (isset($_POST['login'])) 
    { 
        $login = $_POST['login']; 
        if ($login == '') 
        { 
            unset($login);
        } 
    } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
 
    if (isset($_POST['password'])) 
    { 
        $password = $_POST['password']; 
        if ($password == '') 
        { 
            unset($password);
        } 
    }//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 
    if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаём ошибку и останавливаем выполнение скрипта
    {
        echo"<p align='center'><img src='/image/Error.png'</p>";
    }
    else
    {
    $login = stripslashes($login);//удаляет экранирование символов, произведенное функцией addslashes()
 
    $login = htmlspecialchars($login);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай от действий умников-спамеров)
 
    $password = stripslashes($password); //удаляет экранирование символов, произведенное функцией addslashes()
 
    $password = htmlspecialchars($password);
 
    $login = trim($login);//удаляет пробелы (или другие символы) из начала и конца строки
    $password = trim($password);

    /* Соединяемся, выбираем базу данных*/ 
    $link = mysql_connect("localhost", "root", "")
        or die("Could not connect : " . mysql_error());
    mysql_select_db("students") or die("Could not select database");

    /* Выполняем SQL-запрос */
    if ($_POST['choose'] == '1') 
    {   
        $result = mysql_query("SELECT lect_pass FROM lectures WHERE lect_login = '$login'", $link) 
        or die("Query failed : " . mysql_error());
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
            foreach ($line as $col_value) 
            {
                if ($col_value == null/*$password != $col_value*/)
                {
                    echo"Incorrect login or password!";
                    sleep(5);
                    echo "<script>document.location.replace('index.php');</script>";
                
                }  
                else
                {
                    echo"Succses!";
                    $_SESSION['login'] = $login;
                    $_SESSION['loginchoose'] = $_POST['choose'];
                    $_SESSION['exit'] = false;
                //header ('Location: http://www.vk.com/');  // перенаправление на нужную страницу
                    echo "<script>document.location.replace('lectures.php');</script>";
                    exit();
                }
            }
           // exit();
        }
        //sleep(2); 
        echo "<script>document.location.replace('index.php');</script>";
    }
    else
    {
        $result = mysql_query("SELECT stud_pass FROM students WHERE stud_login = '$login'", $link) 
        or die("Query failed : " . mysql_error());
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
            foreach ($line as $col_value) 
            {
                if ($col_value == null/*$password != $col_value*/)
                {
                    echo"Incorrect login or password!";
                    sleep(5);
                    echo "<script>document.location.replace('index.php');</script>";
                }  
                else
                {
                    echo"Succses!";
                //header ('Location: http://www.vk.com/');  // перенаправление на нужную страницу
                    $_SESSION['login'] = $login;
                    $_SESSION['loginchoose'] = $_POST['choose'];
                    $_SESSION['exit'] = false;
                    echo "<script>document.location.replace('home.php');</script>";
                    exit();
                }
            }
        }
        //sleep(2); 
        echo "<script>document.location.replace('index.php');</script>";
    } 
    /* Выводим результаты в html */
    
    
    /* Освобождаем память от результата */
    mysql_free_result($result);
    
    //echo "<script>document.location.replace('index.php');</script>";
    /* Закрываем соединение */
    mysql_close($link);  
    }
?>