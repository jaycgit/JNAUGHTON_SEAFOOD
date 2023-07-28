<?php
// Replace the placeholders with your SQL Server credentials
$serverName = "your_server_name"; // e.g., "localhost"
$connectionOptions = array(
    "Database" => "your_database_name",
    "Uid" => "your_username",
    "PWD" => "your_password"
);

// Establish the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // You can perform your login authentication here using the provided username and password

    // For example, you can query the Users table to check if the provided credentials are valid
    $sql = "SELECT * FROM Users WHERE username = ? AND password = ?";
    $params = array($username, $password);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmt)) {
        // Login successful, redirect to another page or display a welcome message
        echo "Login successful! Welcome, $username!";
    } else {
        // Login failed, redirect back to the login page or display an error message
        echo "Invalid username or password. Please try again.";
    }

    sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);
?>
