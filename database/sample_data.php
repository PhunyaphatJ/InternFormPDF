<?php
require 'db_connection.php';

try {
	$students = [
		['id' => '6805000879','name' => 'John Doe', 'phone' => '1234567890', 'address' => '123 Main St'],
		['id' => '6805001450','name' => 'Jane Smith', 'phone' => '0987654321', 'address' => '456 Elm St'],
		['id' => '6805002222','name' => 'Alice Johnson', 'phone' => '5555555555', 'address' => '789 Oak St'],
	];

	$sql = "INSERT INTO student (id,name, phone, address) VALUES (:id,:name, :phone, :address)";
	$stmt = $conn->prepare($sql);

	foreach ($students as $student) {
		$stmt->execute([
            ':id' => $student['id'],
			':name' => $student['name'],
			':phone' => $student['phone'],
			':address' => $student['address'],
		]);
	}

	echo "Sample data inserted successfully.";
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}

$conn = null;
?>

