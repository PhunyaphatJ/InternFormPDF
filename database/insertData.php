<?php
    require 'db_connection.php';

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = $_POST['name'];
        $id = $_POST['id'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
    }
    $sql = "INSERT INTO student (id,name,phone,address)
    VALUES (:id,:name,:phone,:address)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id'=>$id,'name'=>$name,'phone'=>$phone,'address'=>$address]);
    $conn = null;
    header('location:../students.php');
?>