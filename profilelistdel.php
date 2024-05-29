<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['IdNum'];

$sql = "DELETE FROM profile WHERE IdNum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: profilelist.php");
} else {
    $error = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
