<?php
require 'Db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the request body
    $userpostdata = json_decode(file_get_contents("php://input"));

    // Extract user data from JSON
    $username = $userpostdata->username;
    $usermail = $userpostdata->email;
    $status = $userpostdata->status;

    // Insert the user data into the database
    $result = mysqli_query($db_conn, "INSERT INTO tbl_user (username, usermail, status) 
        VALUES('$username', '$usermail', '$status')");

    if ($result) {
        echo json_encode(["success" => "User Added Successfully"]);
    } else {
        echo json_encode(["error" => "Failed to Add User"]);
    }
} else {
    echo json_encode(["error" => "Invalid Request Method"]);
}
