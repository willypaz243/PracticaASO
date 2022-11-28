<?php
require_once 'conn.php';

$title = $_POST['title'];
$description = $_POST['description'];

if (isset($_POST['submit'])) {
    if ($title != "" and $description != "") {
        $conn->query("INSERT INTO todolist(title, description) VALUES('$title', '$description')");
        header('location:todolist.php');
    }
}
?>