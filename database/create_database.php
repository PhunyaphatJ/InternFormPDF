<?php
$servername = "localhost";
$username = "root";
$password = "";


try {
	$conn = new PDO("mysql:host=$servername",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE IF NOT EXISTS formDB";

	$conn->exec($sql);
	echo "DATABASE CREATED SUCCESSFULLY\n";

	$conn->exec("USE formDB");
	
	//create table
	$sql = "CREATE TABLE IF NOT EXISTS student(
	id VARCHAR(10)  PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	phone VARCHAR(10) NOT NULL,
	address TEXT(100) NOT NULL,
	reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)
";
	$conn->exec($sql);
	echo "CREATED TABLE SUCCESSFULLY\n";
}catch(PDOException $e){
	echo $sql."\n".$e->getMessage();
}
?>