<?php
include_once('../controller/config.php');
session_start();
$student_id = $_SESSION['student_id'];
// Fetch student's subject_id (adjust as needed)
$subject_sql = "SELECT subject_id FROM students WHERE id = ?";
$subject_stmt = $conn->prepare($subject_sql);
$subject_stmt->bind_param("i", $student_id);
$subject_stmt->execute();
$subject_stmt->bind_result($student_subject_id);
$subject_stmt->fetch();
$subject_stmt->close();

// Fetch quizzes for this subject
$sql = "SELECT * FROM quizzes WHERE subject_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_subject_id);
$stmt->execute();
$result = $stmt->get_result();

while($quiz = $result->fetch_assoc()) {
    echo "<h3>{$quiz['title']}</h3>";
    echo "<a href='attempt_quiz.php?quiz_id={$quiz['id']}' class='btn btn-primary'>Start Quiz</a><hr>";
}
?>