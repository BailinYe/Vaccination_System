<!DOCTYPE html>
<html>
<head>
    <title>PHP Database Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-right: 10px;
        }

        input[type="text"], input[type="date"], input[type="time"] {
            width: 250px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: #777;
        }
    </style>
</head>
<body>
<h1>Database Connection Test</h1>

<?php
// Database configuration
$db_host = 'bec353.encs.concordia.ca';
$db_user = 'bec353_1';
$db_password = 'Best353C';
$db_name = 'bec353_1';

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful!";

// Handle query operation
if (isset($_POST['submit'])) {
    $medicare_card_number = $_POST['medicare_card_number'];

    // Query statement
    $sql = "SELECT * FROM person WHERE Medicare_card_number = '$medicare_card_number'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display query results
        echo "<h2>Query Results:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Medicare Card Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Medicare Expiry Date</th>
                    <th>Telephone Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th>Citizenship</th>
                    <th>Email Address</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Medicare_card_number'] . "</td>";
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
        echo "<p>No relevant records found.</p>";
    }
}

// Handle adding schedule operation
if (isset($_POST['submit_schedule'])) {
    $employee_id = $_POST['employee_id'];
    $facility_id = $_POST['facility_id'];
    $schedule_date = $_POST['schedule_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Insert schedule record SQL statement
    $insert_sql = "INSERT INTO schedule (EmployeeID, FacilityID, ScheduleDate, StartTime, EndTime) 
                   VALUES ('$employee_id', '$facility_id', '$schedule_date', '$start_time', '$end_time')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "<p>Schedule record has been added successfully.</p>";
    } else {
        echo "<p>Error adding schedule record: " . $conn->error . "</p>";
    }
}

// Handle "Check Schedule Log" operation
if (isset($_POST['check_schedule_log'])) {
    // SQL query to fetch email log information
    $log_sql = "SELECT log_id, email_date, sender_facility_id, receiver_email, email_subject, email_body
                FROM Email_Log";

    // Execute the query
    $log_result = $conn->query($log_sql);

    // Display the log information
    if ($log_result->num_rows > 0) {
        echo "<h2>Email Log:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Log ID</th>
                    <th>Email Date</th>
                    <th>Sender Facility ID</th>
                    <th>Receiver Email</th>
                    <th>Email Subject</th>
                    <th>Email Body</th>
                </tr>";

        while ($log_row = $log_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $log_row['log_id'] . "</td>";
            echo "<td>" . $log_row['email_date'] . "</td>";
            echo "<td>" . $log_row['sender_facility_id'] . "</td>";
            echo "<td>" . $log_row['receiver_email'] . "</td>";
            echo "<td>" . $log_row['email_subject'] . "</td>";
            echo "<td>" . $log_row['email_body'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No email log records found.</p>";
    }
}

// Handle "Vaccination Status" query
if (isset($_POST['check_vaccination_status'])) {
    $medical_care_ID = $_POST['medical_care_ID'];

    // SQL query to fetch vaccination status
    $vaccination_sql = "SELECT vaccination_ID, person_ID, vaccination_date, vaccination_type, dose_number
                        FROM vaccination
                        WHERE person_ID = '$medical_care_ID'";

    // Execute the query
    $vaccination_result = $conn->query($vaccination_sql);

    // Display vaccination status
    if ($vaccination_result->num_rows > 0) {
        echo "<h2>Vaccination Status:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Vaccination ID</th>
                    <th>Person ID</th>
                    <th>Vaccination Date</th>
                    <th>Vaccination Type</th>
                    <th>Dose Number</th>
                </tr>";

        while ($vaccination_row = $vaccination_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $vaccination_row['vaccination_ID'] . "</td>";
            echo "<td>" . $vaccination_row['person_ID'] . "</td>";
            echo "<td>" . $vaccination_row['vaccination_date'] . "</td>";
            echo "<td>" . $vaccination_row['vaccination_type'] . "</td>";
            echo "<td>" . $vaccination_row['dose_number'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No vaccination records found for the provided person ID.</p>";
    }
}
$conn->close();
?>

<h2>Query Personnel Information</h2>
<form method="post">
    <label for="medicare_card_number">Enter Medicare Card Number:</label>
    <input type="text" id="medicare_card_number" name="medicare_card_number">
    <input type="submit" name="submit" value="Query">
</form>

<h2>Add Schedule</h2>
<form method="post">
    <label for="employee_id">Employee ID:</label>
    <input type="text" id="employee_id" name="employee_id"><br>

    <label for="facility_id">Facility ID:</label>
    <input type="text" id="facility_id" name="facility_id"><br>

    <label for="schedule_date">Schedule Date:</label>
    <input type="date" id="schedule_date" name="schedule_date"><br>

    <label for="start_time">Start Time:</label>
    <input type="time" id="start_time" name="start_time"><br>

    <label for="end_time">End Time:</label>
    <input type="time" id="end_time" name="end_time"><br>

    <input type="submit" name="submit_schedule" value="Confirm">
</form>

<h2>Check My Schedule Log</h2>
<form method="post">
    <input type="submit" name="check_schedule_log" value="Check My Schedule Log">
</form>

<h2>Vaccination Status</h2>
<form method="post">
    <label for="medical_care_ID">Medical Care ID:</label>
    <input type="text" id="medical_care_ID" name="medical_care_ID">
    <input type="submit" name="check_vaccination_status" value="Check Vaccination Status">
</form>

</body>
</html>
