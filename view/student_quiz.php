<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>
<?php include_once('./submit_student_quiz.php');?>
<?php
// Fetch available quizzes for this student
$sql = "SELECT * FROM quizzes WHERE subject_id = ?"; // Use student's subject_id
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_subject_id);
$stmt->execute();
$result = $stmt->get_result();

while($quiz = $result->fetch_assoc()) {
    echo "<h3>{$quiz['title']}</h3>";
    echo "<a href='attempt_quiz.php?quiz_id={$quiz['id']}' class='btn btn-primary'>Start Quiz</a><hr>";
}
?>