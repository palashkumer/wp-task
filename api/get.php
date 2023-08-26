<?php
require 'Db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $json_array = array();
    $userid     = $_GET['id'];

    $getuserrow = mysqli_query($db_conn, "SELECT * FROM tbl_user WHERE userid='$userid'");
    if ($userrow = mysqli_fetch_array($getuserrow)) {
        $json_array['rowUserdata'] = array(
            'id'       => $userrow['userid'],
            'username' => $userrow['username'],
            'email'    => $userrow['usermail'],
            'status'   => $userrow['status'],
        );
        echo json_encode($json_array['rowUserdata']);
    } else {
        echo json_encode(array('result' => 'User not found'));
    }
} else {
    $alluser = mysqli_query($db_conn, 'SELECT * FROM tbl_user');
    if (mysqli_num_rows($alluser) > 0) {
        $json_array['userdata'] = array();
        while ($row = mysqli_fetch_array($alluser)) {
            $json_array['userdata'][] = array(
                'id'       => $row['userid'],
                'username' => $row['username'],
                'email'    => $row['usermail'],
                'status'   => $row['status'],
            );
        }
        echo json_encode($json_array['userdata']);
    } else {
        echo json_encode(array('result' => 'No User Data Found'));
    }
}
