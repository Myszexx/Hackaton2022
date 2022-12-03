<?php
session_start();
header('Content-Type: application/json; charset: UTF-8');

$json = [];
$time = [];
$task = [];

require_once "../accounts/connection.php";

if(isset($_POST['length']) && isset($_POST['startday']) && isset($_SESSION['user_id']))
{
    $i = 0;
    $length = $_POST['length'];
    $startday = $_POST['startday'];

    $sql1 = "SELECT `id`, `start_date`, `end_date`, `type` FROM free_time WHERE user_id = " . $_SESSION['user_id'] . " AND `start_date` BETWEEN " . date('Y-m-d', strtotime($startday)) . " AND DATE_ADD('" . date('Y-m-d', strtotime($startday)) . "', INTERVAL " . $length . " DAY) ORDER BY start_date ASC";
    $sql2 = "SELECT `task_id`, `task_type`, `time`, `comment`, `title`, `priority`, `alerts`, `color`, DATEDIFF('day',`alerts`-" . date('Y-m-d', strtotime($startday)) . ") as Days_TO_END FROM tasks WHERE user_id = " . $_SESSION['user_id'] . " AND alerts BETWEEN " . date('Y-m-d', strtotime($startday)) . " AND DATE_ADD('" . date('Y-m-d', strtotime($startday)) . "', INTERVAL " . $length . " DAY) ORDER BY Days_TO_END ASC, priority DESC, time DESC";

    $res1 = $conn->query($sql1);
    $res2 = $conn->query($sql2);

    $res1_num_rows = $res1->num_rows;
    $res2_num_rows = $res2->num_rows;

    while($row = $res1 -> fetch_assoc())
    {
        $time[$i] = [
            "id" => $row['id'],
            "start_date" => $row['start_date'],
            "end_date" => $row['end_date'],
            "type" => $row['type']
        ];

        $i++;
    }

    $i = 0;
    while($row = $res2 -> fetch_assoc())
    {
        $task[$i] = [
            "task_id" => $row['task_id'],
            "time" => $row['time'],
            "type" => $row['task_type'],
            "comment" => $row['comment'],
            "title" => $row['title'],
            "priority" => $row['priority'],
            "alerts" => $row['alerts'],
            "colors" => $row['color']
        ];

        $i++;
    }


    $json = [
        "tasks" => $task,
        "time" => $time
    ];

    echo json_encode($json);
}
