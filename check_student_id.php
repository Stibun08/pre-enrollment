<?php
header('Content-Type: application/json');
if (!isset($_GET['student_id'])) {
    echo json_encode(['exists' => false, 'error' => 'No student_id provided']);
    exit;
}
$student_id = $_GET['student_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_checklist";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['exists' => false, 'error' => 'Database connection failed']);
    exit;
}
$stmt = $conn->prepare("SELECT student_id FROM students WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$stmt->store_result();
$exists = $stmt->num_rows > 0;
$stmt->close();
$conn->close();
echo json_encode(['exists' => $exists]);
