<?php
// include the database connection file
include 'db_connection.php';

// Facility Search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["facility_search"])) {
    $search_facility_id = $_POST['facility'];

    // Prepare the SQL query with a placeholder to avoid SQL injection
    $sql_facility = "SELECT * FROM facility 
					 WHERE facility_ID = ?";

    // Create a prepared statement for Facility search
    $stmt_facility = $conn->prepare($sql_facility);

    if ($stmt_facility) {
        // Bind the user input to the prepared statement for Facility search
        $stmt_facility->bind_param("s", $search_facility_id);

        // Execute the prepared statement for Facility search
        $stmt_facility->execute();

        // Get the result for Facility search
        $result_facility = $stmt_facility->get_result();

        if ($result_facility->num_rows > 0) {
            echo "<h2>Facility Information:</h2>";
            echo "<table>";
            echo "<tr><th>Facility ID</th><th>Name</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Phone</th><th>Web Address</th><th>Capacity</th></tr>";
            while ($row = $result_facility->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['facility_ID'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
				echo "<td>" . $row['province'] . "</td>";
                echo "<td>" . $row['postal_code'] . "</td>";
				echo "<td>" . $row['phone_number'] . "</td>";
                echo "<td>" . $row['web_address'] . "</td>";
				echo "<td>" . $row['capacity'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No matching facility found.</h2>";
        }

        // Close the statement for Facility search
        $stmt_facility->close();
    } else {
        echo "Error in the Facility SQL query.";
    }
}

// Employee Search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["employee_search"])) {
    $search_employee_id = $_POST['employee'];

    // Prepare the SQL query with a placeholder to avoid SQL injection
    $sql_employee = "SELECT employee.employee_ID, person.first_name FROM employee 
					 INNER JOIN person ON employee.person_ID = person.Medicare_card_number
					 WHERE employee_ID = ?";

    // Create a prepared statement for Employee search
    $stmt_employee = $conn->prepare($sql_employee);

    if ($stmt_employee) {
        // Bind the user input to the prepared statement for Employee search
        $stmt_employee->bind_param("s", $search_employee_id);

        // Execute the prepared statement for Employee search
        $stmt_employee->execute();

        // Get the result for Employee search
        $result_employee = $stmt_employee->get_result();

        if ($result_employee->num_rows > 0) {
            echo "<h2>Employee Information:</h2>";
            echo "<table>";
            echo "<tr><th>Employee ID</th><th>Name</th><th>Department</th><th>Position</th></tr>";
            while ($row = $result_employee->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['employee_ID'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['facility_type'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No matching employee found.</h2>";
        }

        // Close the statement for Employee search
        $stmt_employee->close();
    } else {
        echo "Error in the Employee SQL query.";
    }
}

// Student Search
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["student_search"])) {
        $search_student_id = $_POST['student'];

        // Prepare the SQL query with a JOIN between student and person tables
        $sql = "SELECT student.student_ID, person.Medicare_card_number, person.first_name, person.date_of_birth FROM student 
                INNER JOIN person ON student.person_ID = person.Medicare_card_number
                WHERE student.student_ID = ?";

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
                echo "<tr><th>Student ID</th><th>Person ID</th><th>Name</th><th>Date of Birth</th></tr>";
                //<th>Facility ID</th>
				while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['student_ID'] . "</td>";
                    // echo "<td>" . $row['facility_ID'] . "</td>";
                    echo "<td>" . $row['Medicare_card_number'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['date_of_birth'] . "</td>";
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
<!-- HTML part of the page -->

<!DOCTYPE html>
<html>
<head>
    <title>Database Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #008B8B;
            color: #fff;
            padding: 20px;
            margin: 0;
        }

        .search-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 600px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #008B8B;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005757;
        }
    </style>
</head>
<body>
    <h1>Database Search</h1>
    <div class="search-form">
        <form method="post">
            <label for="facility">Search by Facility:</label>
            <input type="text" name="facility" id="facility">
            <input type="submit" name="facility_search" value="Search">
        </form>

        <form method="post">
            <label for="student">Search by Student:</label>
            <input type="text" name="student" id="student">
            <input type="submit" name="student_search" value="Search">
        </form>

        <form method="post">
            <label for="employee">Search by Employee:</label>
            <input type="text" name="employee" id="employee">
            <input type="submit" name="employee_search" value="Search">
        </form>
    </div>

    <!-- PHP code to handle the search queries can be added here -->

</body>
</html>