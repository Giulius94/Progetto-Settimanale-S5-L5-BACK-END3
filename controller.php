<?php
use dto\UserDTO;
// Start or continue the session (if needed).
session_start();

// Include the UserManager class file (adjust the path as necessary).
require_once ("assets/classes/UsersDto.php");
require_once("assets/php/db.php");
$config = require_once("assets/php/config.php");
   

    
   /*  var_dump($conn);
    $userDTO = new Dto($conn);
    $res = $userDTO->getUserByID(0);
    //$res = $userDTO->getUserByID(2);

    var_dump($res); * */

    use db\DB_PDO as Database;
    use dto\UserDTO as Dto;

// Check if the form was submitted.
if ($_REQUEST['mode'] == 'newuser' ) {
    // Instantiate the UserManager object.


    $pdoConn = Database::getInstance($config);
    $conn = $pdoConn->getConnection();
    $userManager = new UserDTO($conn);

    // Prepare the user data array from the POST data.
    $userData = [
        'Nome' => $_POST['Nome'] ?? '',
        'Cognome' => $_POST['Cognome'] ?? '',
        'City' => $_POST['City'] ?? '',
        'email' => $_POST['email'] ?? '',
        'Password' => $_POST['Password'] ?? '',
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
    // Not a POST request, handle accordingly.
    echo "Invalid request.";
}
