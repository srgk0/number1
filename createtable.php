<?php
// DB connection info
$host = "tcp:srgk0.database.windows.net,1433";
$user = "srgk0";
$pwd = "priorar225os";
$db = "first";
try{
    $conn = new PDO("sqlsrv:server = tcp:srgk0.database.windows.net,1433; Database = first", "srgk0", "priorar225os");
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