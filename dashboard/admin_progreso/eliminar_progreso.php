<?php
include '../../config/Database.php';
$id_progreso = $_GET['id'];
$sql = "DELETE FROM progreso WHERE id_progreso = '$id_progreso'";
if ($conn->query($sql) === TRUE) {
    header("Location: indexProgreso.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>