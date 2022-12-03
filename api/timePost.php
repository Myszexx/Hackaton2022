<?php
session_start();

require_once "../accounts/connection.php";

if(!empty($_POST))
{
    $sql = "INSERT INTO free_time (start_date, end_date, type, user_id) VALUES (" . $_POST['start_date'] . "," . $_POST['end_date'] . "," . $_POST['type'] . "," . $_SESSION['user_id'] . ")";

    $res = $conn -> query($sql);
}