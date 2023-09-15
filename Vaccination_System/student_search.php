<!DOCTYPE html>
<html>
<head>
    <title>Student Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 200px;
            padding: 5px;
            margin: 5px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }


    </style>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include the database connection file
include 'db_connection.php';


// Student Search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["student_search"])) {
    $search_student_ID = $_POST['student'];

    // Prepare the SQL query with a JOIN between student and Person tables
    $sql = "SELECT s.student_ID, s.person_ID,
            p.first_name, p.last_name, p.date_of_birth,
            p.Medicare_expiry_date, p.telephone_number, p.address,
            p.city, p.province, p.postal_code, p.citizenship,
            p.email_address
            FROM student s
            INNER JOIN person p ON s.person_ID = p.Medicare_card_number
            WHERE s.student_ID = ?";

    // Create a prepared statement for Student search
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the user input to the prepared statement for Student search
        $stmt->bind_param("s", $search_student_id);

        // Execute the prepared statement for Student search
        $stmt->execute();

        // Get the result for Student search
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Student Information:</h2>";
            echo "<table>";
            echo "<tr><th>Student ID</th><th>Person ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                  <th>Medicare Expire Date</th><th>Telephone Number</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th>
                  <th>Citizenship</th><th>Email Address</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['student_ID'] . "</td>";
                echo "<td>" . $row['person_ID'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['date_of_birth'] . "</td>";
                echo "<td>" . $row['Medicare_expiry_date'] . "</td>";
                echo "<td>" . $row['telephone_number'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['province'] . "</td>";
                echo "<td>" . $row['postal_code'] . "</td>";
                echo "<td>" . $row['citizenship'] . "</td>";
                echo "<td>" . $row['email_address'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No matching student found.</h2>";
        }

        // Close the statement for Student search
        $stmt->close();
    } else {
        echo "Error in the Student SQL query.";
    }
}
?>

</body>
</html>