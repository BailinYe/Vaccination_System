<?php
include 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addFacility"])) {
    $facilityName = $_POST['facilityName'];
    $facilityAddress = $_POST['facilityAddress'];
    $facilityCity = $_POST['facilityCity'];
    $facilityProvince = $_POST['facilityProvince'];
    $facilityPostalCode = $_POST['facilityPostalCode'];
    $facilityPhone = $_POST['facilityPhone'];
    $facilityWebAddress = $_POST['facilityWebAddress'];
    $facilityCapacity = $_POST['facilityCapacity'];

    $sql = "INSERT INTO Facilities (facilityName, facilityAddress, facilityCity, facilityProvince, facilityPostalCode, facilityPhone, facilityWebAddress, facilityCapacity)
            VALUES ('$facilityName', '$facilityAddress', '$facilityCity', '$facilityProvince', '$facilityPostalCode', '$facilityPhone', '$facilityWebAddress', '$facilityCapacity')";

    if ($conn->query($sql) === TRUE) {
        echo "Facility added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Education Health Facilities - COVID-19 System</title>
    <style>
        /* CSS styles here... */
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

        h2 {
            color: #008B8B;
            margin-top: 20px;
        }

        .facility-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 600px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .person-info {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        select {
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
    <h1>Education Health Facilities - COVID-19 System</h1>

    <!-- Facility Information -->
    <div class="facility-info">
        <h2>Facility Information</h2>
        <form method="post">
            <label for="facilityName">Facility Name:</label>
            <input type="text" name="facilityName" id="facilityName" required><br>
            <label for="facilityAddress">Address:</label>
            <input type="text" name="facilityAddress" id="facilityAddress" required><br>
            <label for="facilityCity">City:</label>
            <input type="text" name="facilityCity" id="facilityCity" required><br>
            <label for="facilityProvince">Province:</label>
            <input type="text" name="facilityProvince" id="facilityProvince" required><br>
            <label for="facilityPostalCode">Postal Code:</label>
            <input type="text" name="facilityPostalCode" id="facilityPostalCode" required><br>
            <label for="facilityPhone">Phone Number:</label>
            <input type="text" name="facilityPhone" id="facilityPhone" required><br>
            <label for="facilityWebAddress">Web Address:</label>
            <input type="text" name="facilityWebAddress" id="facilityWebAddress" required><br>
            <label for="facilityCapacity">Capacity:</label>
            <input type="number" name="facilityCapacity" id="facilityCapacity" required><br>
            <input type="submit" name="addFacility" value="Add Facility">
        </form>
    </div>

     </body>
     </html>

