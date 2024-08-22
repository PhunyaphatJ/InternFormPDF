<!-- PHP code to establish connection with the localserver -->
<?php
require 'database/db_connection.php';

// SQL query to select data from database
$sql = " SELECT * FROM student";
$result = $conn->query($sql);
$conn = null;
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Student</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		table {
			margin: 0 auto;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			color: #006600;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
		}

		td {
			background-color: #E4F5D4;
			border: 1px solid black;
		}

		th,
		td {
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">Student</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form.html">Form</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="students.php">All Students</a>
        </li>
      </ul>
    </div>
  </div>
</nav>





	<section>
		<h1>Students</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>รหัสประจำตัว</th>
				<th>ชื่อ - นามสกุล</th>
				<th>เบอร์โทรศัพท์</th>
				<th>ที่อยู่</th>
				<th>เอกสาร 1 แบบที่ 1</th>
				<th>เอกสาร 1 แบบที่ 2</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php 
				// LOOP TILL END OF DATA
				while($rows=$result->fetch(PDO::FETCH_ASSOC))
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
				<td><?php echo $rows['id'];?></td>
				<td><?php echo $rows['name'];?></td>
				<td><?php echo $rows['phone'];?></td>
				<td><?php echo $rows['address'];?></td>
				<td>
                    <form action="generate_pdf.php" method="post">
                        <input type="hidden" name="id" value="<?php echo ($rows['id']); ?>">
                        <button type="submit">PDF</button>
                    </form>
                </td>
				<td>
                    <form action="testImportPdf/main.php" method="post">
                        <input type="hidden" name="id" value="<?php echo ($rows['id']); ?>">
                        <button type="submit">PDF</button>
                    </form>
                </td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>
