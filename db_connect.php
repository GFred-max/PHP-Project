<?php
$host = "localhost";
$user = "root";       // Default xampp username
$pass = "";           // Default XAMPP password is empty
$dbname = "company_db";

// Establish relational connection string
$conn = new mysqli($host, $user, $pass, $dbname);

// Check if the connection has any critical faults
if ($conn->connect_error) {
      die("Database Connection Failed: " . $conn->connect_error);

}
?>