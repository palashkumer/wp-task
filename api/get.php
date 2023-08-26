<?php
require 'Db_connect.php';

$path = explode('/', $_SERVER['REQUEST_URI']);

if (isset($path[4]) && is_numeric($path[4])) {
    $json_array = array();
    $userid = $path[4];

    $getuserrow = mysqli_query($db_conn, "SELECT * FROM tbl_user WHERE userid='$userid' ");
    while ($userrow = mysqli_fetch_array($getuserrow)) {
        $json_array['rowUserdata'] = array(
            'id' => $userrow['userid'],
            'username' => $userrow['username'],
            'email' => $userrow['usermail'],
            'status' => $userrow['status']
        );
    }
    echo json_encode($json_array['rowUserdata']);
} else {
    $alluser = mysqli_query($db_conn, "SELECT * FROM tbl_user");
    $json_array["userdata"] = array(); // Initialize an empty array

    while ($row = mysqli_fetch_array($alluser)) {
        $json_array["userdata"][] = array(
            "id" => $row['userid'],
            "username" => $row["username"],
            "email" => $row["usermail"],
            "status" => $row["status"]
        );
    }

    echo json_encode($json_array["userdata"]);
}
