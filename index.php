<?
// Страница авторизации

# Соединямся с БД
$conn = new PDO("sqlsrv:server = tcp:sqldatabase2.database.windows.net,1433; Database = sqldatabase2", "makkdragonhawk", "makkDR3748");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['submit']))
{
# Вытаскиваем из БД запись, у которой логин равняеться введенному
$query = query($conn,"SELECT name, passw FROM reg_table WHERE name='".real_escape_string($conn,$_POST['login'])."' LIMIT 1");
$data = fetch_assoc($query);

# Сравниваем пароли
if($data['passw'] === $_POST['password'])
{
echo $data;
print "Вы ввели правильный логин/пароль";
}
else
{
echo $data;
print "Вы ввели неправильный логин/пароль";
}
}
?>
<form method="POST">
Логин <input name="login" type="text"><br>
Пароль <input name="password" type="password"><br>
<input name="submit" type="submit" value="Войти">
</form>
