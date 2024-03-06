<?php
// Start or continue the session (if needed).
session_start();
// Include the necessary files
require_once("assets/php/classes/UsersDto.php");
require_once("assets/php/db.php");
$config = require_once("assets/php/config.php");
use db\DB_PDO as Database;
use dto\UserDTO as Dto;

// Check if the form was submitted via POST and the operation is 'newuser'.
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Initialize the PDO connection using the Database class
    $pdoConn = Database::getInstance($config);
    $conn = $pdoConn->getConnection();

    // Instantiate the UserDTO object with the PDO connection
    $userManager = new Dto($conn);

    // Prepare the user data array from the POST data.
    $userData = [
        'Nome' => $_POST['Nome'],
        'Cognome' => $_POST['Cognome'],
        'City' => $_POST['City'],
        'email' => $_POST['email'],
        'Password' => $_POST['Password'],
    ];

    // Call the saveUser function with the user data.
    $result = $userManager->saveUser($userData);

    // Check if the user was saved successfully.
    if ($result > 0) {
        // User was saved, redirect or display a success message.
        echo "User saved successfully!";
    } else {
        // User was not saved, handle the error.
        echo "An error occurred while saving the user.";
    }
} else {
    // Not a POST request or the 'mode' is not 'newuser', handle accordingly.
    echo "Invalid request.";
}
