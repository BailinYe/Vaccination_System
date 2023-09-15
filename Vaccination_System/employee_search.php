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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["employee_search"])) {
    $search_employee_id = $_POST['employee'];

    // Prepare the SQL query with a JOIN between student and Person tables
    $sql = "SELECT e.employee_ID, e.person_ID,e.type_ID,e.facility_ID,
            p.first_name, p.last_name, p.date_of_birth,
            p.Medicare_expiry_date, p.telephone_number, p.address,
            p.city, p.province, p.postal_code, p.citizenship,
            p.email_address
            FROM Employee e
            INNER JOIN Person p ON e.person_ID = p.Medicare_card_number
            WHERE e.employee_ID = ?";

    // Create a prepared statement for Student search
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the user input to the prepared statement for Student search
        $stmt->bind_param("s", $search_employee_id);

        // Execute the prepared statement for Student search
        $stmt->execute();

        // Get the result for Student search
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Employee Information:</h2>";
            echo "<table>";
            echo "<tr><th>Employee ID</th><th>Person ID</th><th>Type ID</th><th>Facility ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                  <th>Medicare Expire Date</th><th>Telephone Number</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th>
                  <th>Citizenship</th><th>Email Address</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['employee_ID'] . "</td>";

                echo "<td>" . $row['person_ID'] . "</td>";
                echo "<td>" . $row['type_ID'] . "</td>";
                echo "<td>" . $row['facility_ID'] . "</td>";
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
            echo "<h2>No matching employee found.</h2>";
        }

        // Close the statement for Student search
        $stmt->close();
    } else {
        echo "Error in the Employee SQL query.";
    }
}
?>

</body>
</html>