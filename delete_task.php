<?php
require_once 'conn.php';

$task_id = intval($_GET['id']);
if ($task_id) {
    $conn->query("DELETE FROM `todolist` WHERE `id` = $task_id") or die(mysqli_errno());

}
header('location: todolist.php');
?>