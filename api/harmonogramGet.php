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

    $sql1 = "SELECT `id`, `start_date`, `end_date`, `type` FROM free_time WHERE user_id = " . $_SESSION['user_id'] . " AND `start_date` BETWEEN " . date('Y-m-d', strtotime($startday)) . " AND DATE_ADD('" . date('Y-m-d', strtotime($startday)) . "', INTERVAL " . $length . " DAY)";
    $sql2 = "SELECT `task_id`, `task_type`, `time`, `comment`, `title`, `priority`, `alerts`, `color`, DATEDIFF(`alerts`-" . date('Y-m-d', strtotime($startday)) . ") as Days_TO_END FROM tasks WHERE user_id = " . $_SESSION['user_id'] . " AND alerts BETWEEN " . date('Y-m-d', strtotime($startday)) . " AND DATE_ADD('" . date('Y-m-d', strtotime($startday)) . "', INTERVAL " . $length . " DAY) ORDER BY Days_TO_END DESC, priority DESC, time DESC";

    $res1 = $conn->query($sql1);
    $res2 = $conn->query($sql2);

    $res1_num_rows = $res1->num_rows;
    $res2_num_rows = $res2->num_rows;

    while($row = $res1 -> fetch_assoc())
    {
        $time[$i] = [
            "id" => $res1['id'],
            "start_date" => $res1['start_date'],
            "end_date" => $res1['end_date'],
            "type" => $res1['type']
        ];

        $i++;
    }

    $i = 0;
    while($row = $res2 -> fetch_assoc())
    {
        $task[$i] = [
            "task_id" => $res2['task_id'],
            "time" => $res2['time'],
            "type" => $res2['type'],
            "comment" => $res2['comment'],
            "title" => $res2['title'],
            "priority" => $res2['priority'],
            "alerts" => $res2['alerts'],
            "colors" => $res2['colors']
        ];

        $i++;
    }


    $json = [
        "tasks" => $task,
        "time" => $time
    ];

    echo json_encode($json);
}
