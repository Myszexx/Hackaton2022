<?php
session_start();

require_once "../accounts/connection.php";

if (isset($_POST['task_id']) && isset($_POST['task' . $_POST['task_id']]))
{
    $json = json_decode($_POST['task' . $_POST['task_id']]);

    $sql = "INSERT INTO tasks (`user_id`, `time`, `task_type`, `comment`, `title`, `priority`, `alerts`, `color`) VALUES (" . $json['user_id'] . "," . $json['time'] . "," . $json['task_type'] . "," . $json['comment'] . "," . $json['title'] . "," . $json['priority'] . "," . $json['alerts'] . "," . $json['color'] . ")";

    $res = $conn -> query($sql);
}