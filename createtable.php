<?php
// DB connection info
$host = "localhost\sqlexpress";
$user = "ytrewq";
$pwd = "QWERTYqwerty123";
$db = "forzelen";
try{
    $conn = new PDO("sqlsrv:server = tcp:srgk01.database.windows.net,1433; Database = "forzelen", "ytrewq", "QWERTYqwerty123");
    $conn->setAttribute
( PDO::ATTR_ERRMODE, 
PDO::ERRMODE_EXCEPTION );
    $sql = "CREATE TABLE registration_tbl(
    id INT NOT NULL IDENTITY(1,1) 
    PRIMARY KEY(id),
    name VARCHAR(30),
    email VARCHAR(30),
    date DATE)";
    $conn->query($sql);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
echo "<h3>Table created.</h3>";
?>
