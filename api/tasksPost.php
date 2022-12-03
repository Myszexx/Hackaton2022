<?php
session_start();

require_once "../accounts/connection.php";

if (!empty($_POST))
{
    $sql = "INSERT INTO tasks (`user_id`, `time`, `task_type`, `comment`, `title`, `priority`, `alerts`, `color`) VALUES (" . $_SESSION['user_id'] . "," . $_POST['time'] . "," . $_POST['type'] . "," . $_POST['comment'] . "," . $_POST['title'] . "," . $_POST['priority'] . "," . $_POST['alerts'] . "," . $_POST['colors'] . ")";

    $res = $conn -> query($sql);
}