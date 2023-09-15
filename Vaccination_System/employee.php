<!DOCTYPE html>
<html>
<head>
    <title>Database Management System</title>
    <style>

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
    <h1>Welcome to Database Management System</h1>
    <div>
        <h2>Employee Search Tool</h2>
        <form method="post" action="employee_search.php">
            <label for="employee">Employee ID:</label>
            <input type="text" name="employee" id="employee" required>
            <input type="submit" name="employee_search" value="Search">
        </form>
    </div>


</body>
</html>