<html>
  <head>
  </head>
    <body>
  <h1>Регистрация</h1> 
<p>Заполните ваше имя и адрес электронной почты, затем нажмите кнопку Отправить, чтобы зарегистрироваться.</p> 
<form method="post" action="reg.php" 
enctype="multipart/form-data" > 
Имя <input type="text" 
name="name" id="name"/></br> 
Email <input type="text" 
name="email" id="email"/></br> 
Пароль <input type="text" 
name="password" id="passw"/></br> 
<input type="submit" 
name="submit" value="Отправить" /> 
</form> 
<?php 
$host = "tcp:srgk01.database.windows.net,1433"; 
$user = "ytrewq"; 
$pwd = "QWERTYqwerty123"; 
$db = "forzelen"; 
// Connect to database. 
try { 
$conn = new PDO("sqlsrv:server = tcp:srgk01.database.windows.net,1433; Database = forzelen", "ytrewq", "QWERTYqwerty123"); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} 
catch (PDOException $e) { 
print("Error connecting to SQL Server."); 
die(print_r($e)); 
} 
if(!empty($_POST)) { 
try { 
$name = $_POST['name']; 
$email = $_POST['email']; 
$date = date("Y-m-d"); 
$pass = $_POST['passw']; 
// Insert data 
$sql_insert = 
"INSERT INTO reg_table (name, email, date, passw) 
VALUES (?,?,?,?)"; 
$stmt = $conn->prepare($sql_insert); 
$stmt->bindValue(1, $name); 
$stmt->bindValue(2, $email); 
$stmt->bindValue(3, $date); 
$stmt->bindValue(4, $passw); 
$stmt->execute(); 
} 
catch(Exception $e) { 
die(var_dump($e)); 
} 
echo "<h3>Your're registered!</h3>"; 
} 
$sql_select = "SELECT * FROM reg_table"; 
$stmt = $conn->query($sql_select); 
$registrants = $stmt->fetchAll(); 
if(count($registrants) > 0) { 
echo "<h2>People who are registered:</h2>"; 
echo "<table>"; 
echo "<tr><th>Name</th>"; 
echo "<th>Email</th>"; 
echo "<th>Date</th></tr>"; 
foreach($registrants as $registrant) { 
echo "<tr><td>".$registrant['name']."</td>"; 
echo "<td>".$registrant['email']."</td>"; 
echo "<td>".$registrant['date']."</td></tr>"; 
echo "<td>".$registrant['passw']."</td></tr>"; 
} 
echo "</table>"; 
} else { 
echo "<h3>No one is currently registered.</h3>"; 
} ?> 
</body> 
</html>
