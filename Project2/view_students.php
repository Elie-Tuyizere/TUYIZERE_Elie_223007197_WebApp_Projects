<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM registrations ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Students</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background: #fff;
            padding: 20px;
        }
        .container {
            width: 1200px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
            text-align: center;
        }
        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border: 1px solid #007bff;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>REGISTERED STUDENTS</h1>
    <a href="index.php" class="btn">← Back to Registration Form</a>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center;">No students registered yet.</p>
    <?php endif; ?>
    
    <?php $conn->close(); ?>
</div>
</body>
</html>