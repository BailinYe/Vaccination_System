<!DOCTYPE html>
<html>
<head>
    <title> Education Personnel Status Tracking System (EPSTS)</title>
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

        h2 {
            color: #008B8B;
            margin-top: 20px;
        }

        div {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
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
    <h1>Welcome to Database Management System</h1>
    <div>
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
