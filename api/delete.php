<?php
require 'Db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $path = explode('/', $_SERVER["REQUEST_URI"]);
    $userid = isset($path[4]) ? $path[4] : null;

    if ($userid !== null && is_numeric($userid)) {
        // Delete the user record from the database
        $result = mysqli_query($db_conn, "DELETE FROM tbl_user WHERE userid='$userid'");

        if ($result) {
            echo json_encode(["success" => "User Record Deleted Successfully"]);
        } else {
            echo json_encode(["error" => "Failed to Delete User Record"]);
        }
    } else {
        echo json_encode(["error" => "Invalid User ID"]);
    }
} else {
    echo json_encode(["error" => "Invalid Request Method"]);
}
