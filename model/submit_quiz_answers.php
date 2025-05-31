<?php
session_start();
include_once('controller/config.php');

$student_id = $_SESSION['index_number']; // or use your student ID/session logic
$answers = $_POST['answers'] ?? [];
foreach ($answers as $question_id => $selected_option) {
    $stmt = $conn->prepare("INSERT INTO quiz_answers (student_id, question_id, selected_option) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $student_id, $question_id, $selected_option);
    $stmt->execute();
    $stmt->close();
}
echo "<script>alert('Quiz submitted!');window.location='my_subject2.php';</script>";
?>