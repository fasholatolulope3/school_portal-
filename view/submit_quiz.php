<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    exit;
}
include_once('../controller/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quizTitle = $_POST['quizTitle'];
    $questions = $_POST['questions'];
    // Set subject_id and teacher_id as needed
    $subject_id = 1; // Replace with actual subject_id
    $teacher_id = $_SESSION['index_number']; // Or your teacher ID session variable

    // Insert quiz
    $stmt = $conn->prepare("INSERT INTO quizzes (title, subject_id, teacher_id, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sii", $quizTitle, $subject_id, $teacher_id);
    $stmt->execute();
    $quiz_id = $stmt->insert_id;
    $stmt->close();

    // Insert questions
    foreach ($questions as $q) {
        $question = $q['question'];
        $option1 = $q['option1'];
        $option2 = $q['option2'];
        $option3 = $q['option3'];
        $correct = $q['correct'];

        $stmt = $conn->prepare("INSERT INTO quiz_questions (quiz_id, question, option1, option2, option3, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssi", $quiz_id, $question, $option1, $option2, $option3, $correct);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: my_subject2.php?quiz=success");
    exit();
} else {
    header("Location: my_subject2.php");
    exit();
}
?>