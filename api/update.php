<?php
require 'Db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // Get the JSON data from the request body
    $userUpdate = json_decode(file_get_contents("php://input"));

    // Extract user data from JSON
    $userid = $userUpdate->id;
    $username = $userUpdate->username;
    $usermail = $userUpdate->email;
    $status = $userUpdate->status;

    // Update the user data in the database
    $updateData = mysqli_query($db_conn, "UPDATE tbl_user SET username='$username', usermail='$usermail', status='$status' WHERE userid='$userid'");

    if ($updateData) {
        echo json_encode(["success" => "User Record Updated Successfully"]);
    } else {
        echo json_encode(["error" => "Failed to Update User Record"]);
    }
} else {
    echo json_encode(["error" => "Invalid Request Method"]);
}
