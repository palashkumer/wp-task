<?php
require 'Db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $userid = isset($_GET['id']) ? $_GET['id'] : null;

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
