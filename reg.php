<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
if(isset($_POST['submit']))
{
    $mysqli = new mysqli("localhost", "root", "", "test");
 
    if (mysqli_connect_errno()) 
    {
        printf("Подключение невозможно: %s\n", mysqli_connect_error());
        exit();
    }
    
    $error = '';
    
    if($_POST['mail'] !== $_POST['r_mail'])
    {
        $error .='<p>Email не совпадает с повтором</p>';
    }
    
    if($_POST['password'] !== $_POST['r_password'])
    {
        $error .= '<p>Не совпадают пароли</p>';
    }
    
    if ($stmt = $mysqli->prepare("SELECT `email` FROM `users` WHERE `email` = ?")) 
    {
        $stmt->bind_param("s", $email);
        $email = $_POST['mail'];
 
        $stmt->execute();
        $stmt->store_result();
       
        if($stmt->num_rows > 0)
        {
            $error .= 'такой Email уже есть  в базе';
        }
    }
    
    if(empty($error))
    {
        if($stmt = $mysqli->prepare("INSERT INTO `users` VALUES ('',?, ?, ?, ?)"))
        {
            $stmt->bind_param('ssss', $name, $login, $email, $pass);
 
            $name = $_POST['name'];
            $login = $_POST['login'];
            $email = $_POST['mail'];
            $pass = $_POST['password'];
 
            /* выполнение подготовленного выражения  */
            $stmt->execute();
 
            if($stmt->affected_rows > 0)
            {
                $message = '<p>Вы зарегистрированы</p>';
            }
            else
            {
                $error .= '<p>Регистрация не удалась</p>';
            }
        }
    }
}
$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Реєстрація - PradGO</title>
</head>
<style>
    .error{
        color:#C00;
    }
    .mess{
        color:#00b33c;
    }
</style>
<body>
    
    <center> 
        <h1>Реєстрація</h1>
        <div class="error"><?php if(!empty($error)){echo $error;}?></div>
        <div class="mess"><?php if(!empty($message)){echo $message;}?></div>
        <form id="form" action="" method="post">
            <p>
                <input type="text" name="name" weight="20" size="20" maxlength="15" placeholder="Ім'я" required="Заповніть це поле" />
            </p>
            <p>
                <input type="text" name="login" weight="20" size="20" maxlength="10" placeholder="Логін" required="Заповніть це поле" />
            </p>
            <p>
                <input type="text" name="mail" size="20" maxlength="35" placeholder="Емейл адрес" required="Заповніть це поле" />
            </p>
            <p>
                <input type="text" name="r_mail" size="20" maxlength="35" placeholder="Повторіть емейл адрес" required="Заповніть це поле" />
            </p>
            <p>
                <input type="password" name="password" size="20" maxlength="15" placeholder="Пароль" required="Заповніть це поле" />
            </p>
            <p>
                <input type="password" name="r_password" size="20" maxlength="15" placeholder="Повторіть пароль" required="Заповніть це поле" />
            </p>
            <p>
                <input type="submit" name="submit" value="Зареєструватися" />
            </p>
        </form>
    </center>
</body>
</html>
