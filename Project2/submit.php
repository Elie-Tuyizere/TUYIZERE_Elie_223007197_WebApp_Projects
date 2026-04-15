<?php
$servername = "localhost";
$username = "root";     // Default for WampServer
$password = "";         // Default for WampServer (empty)
$dbname = "student_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div style='color:red; text-align:center; padding:20px;'>Connection failed: " . $conn->connect_error . "<br>Please make sure:<br>1. WampServer is running<br>2. Database 'student_db' exists<br>3. Run the database.sql script first</div>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if all required fields exist, if not set default empty values
    $first_name = isset($_POST['first_name']) ? $conn->real_escape_string($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? $conn->real_escape_string($_POST['last_name']) : '';
    $day = isset($_POST['day']) ? $_POST['day'] : '1';
    $month = isset($_POST['month']) ? $_POST['month'] : '1';
    $year = isset($_POST['year']) ? $_POST['year'] : '2000';
    $dob = $year . "-" . $month . "-" . $day;
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $mobile = isset($_POST['mobile']) ? $conn->real_escape_string($_POST['mobile']) : '';
    $gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : '';
    $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';
    $city = isset($_POST['city']) ? $conn->real_escape_string($_POST['city']) : '';
    $pincode = isset($_POST['pincode']) ? $conn->real_escape_string($_POST['pincode']) : '';
    $state = isset($_POST['state']) ? $conn->real_escape_string($_POST['state']) : '';
    $country = isset($_POST['country']) ? $conn->real_escape_string($_POST['country']) : 'India';
    $course = isset($_POST['course']) ? $conn->real_escape_string($_POST['course']) : '';

    // Handle Hobbies (convert array to comma-separated string)
    $hobbies = "";
    if(isset($_POST['hobbies']) && !empty($_POST['hobbies'])) {
        $hobbies = implode(", ", $_POST['hobbies']);
    }
    if(isset($_POST['other_hobby']) && !empty($_POST['other_hobby'])) {
        if($hobbies != "") {
            $hobbies .= ", " . $conn->real_escape_string($_POST['other_hobby']);
        } else {
            $hobbies = $conn->real_escape_string($_POST['other_hobby']);
        }
    }

    // Qualifications with isset checks to avoid undefined array key errors
    $board1 = isset($_POST['board1']) ? $conn->real_escape_string($_POST['board1']) : '';
    $percent1 = isset($_POST['percent1']) ? $conn->real_escape_string($_POST['percent1']) : '';
    $year1 = isset($_POST['year1']) ? $conn->real_escape_string($_POST['year1']) : '';
    
    $board2 = isset($_POST['board2']) ? $conn->real_escape_string($_POST['board2']) : '';
    $percent2 = isset($_POST['percent2']) ? $conn->real_escape_string($_POST['percent2']) : '';
    $year2 = isset($_POST['year2']) ? $conn->real_escape_string($_POST['year2']) : '';
    
    $board3 = isset($_POST['board3']) ? $conn->real_escape_string($_POST['board3']) : '';
    $percent3 = isset($_POST['percent3']) ? $conn->real_escape_string($_POST['percent3']) : '';
    $year3 = isset($_POST['year3']) ? $conn->real_escape_string($_POST['year3']) : '';
    
    $board4 = isset($_POST['board4']) ? $conn->real_escape_string($_POST['board4']) : '';
    $percent4 = isset($_POST['percent4']) ? $conn->real_escape_string($_POST['percent4']) : '';
    $year4 = isset($_POST['year4']) ? $conn->real_escape_string($_POST['year4']) : '';

    // Prepare SQL with proper error handling
    $sql = "INSERT INTO registrations (first_name, last_name, dob, email, mobile, gender, address, city, pincode, state, country, hobbies, course, board1, percent1, year1, board2, percent2, year2, board3, percent3, year3, board4, percent4, year4) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("sssssssssssssssssssssssss", 
        $first_name, $last_name, $dob, $email, $mobile, $gender, $address, $city, $pincode, $state, $country, $hobbies, $course, 
        $board1, $percent1, $year1, $board2, $percent2, $year2, $board3, $percent3, $year3, $board4, $percent4, $year4
    );

    if ($stmt->execute()) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Registration Successful</title>
            <style>
                body { 
                    font-family: 'Times New Roman', Times, serif; 
                    text-align: center; 
                    padding: 50px; 
                    background: #fff;
                }
                .success-box { 
                    background: #d4edda; 
                    color: #155724; 
                    padding: 30px; 
                    border: 2px solid #155724;
                    border-radius: 10px; 
                    max-width: 500px; 
                    margin: 0 auto; 
                }
                .btn { 
                    display: inline-block; 
                    margin-top: 20px; 
                    margin-right: 10px;
                    padding: 10px 20px; 
                    background: #007bff; 
                    color: white; 
                    text-decoration: none; 
                    border: 1px solid #007bff;
                    border-radius: 5px; 
                    font-family: 'Times New Roman', Times, serif;
                }
                .btn:hover {
                    background: #0056b3;
                }
                .btn-green {
                    background: #28a745;
                    border-color: #28a745;
                }
                .btn-green:hover {
                    background: #1e7e34;
                }
                h2 {
                    margin-top: 0;
                }
            </style>
        </head>
        <body>
            <div class='success-box'>
                <h2>✓ REGISTRATION SUCCESSFUL!</h2>
                <p>Thank you for registering, <strong>$first_name $last_name</strong>!</p>
                <p>Your registration has been saved in our database.</p>
                <p>A confirmation has been sent to: <strong>$email</strong></p>
                <a href='index.php' class='btn'>Register Another Student</a>
                <a href='view_students.php' class='btn btn-green'>View All Students</a>
            </div>
        </body>
        </html>";
    } else {
        echo "<div style='color:red; text-align:center; padding:20px; font-family: Times New Roman;'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
$conn->close();
?>