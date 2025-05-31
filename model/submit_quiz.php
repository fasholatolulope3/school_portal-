<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../controller/config.php');
// Get teacher info (adjust as needed)
$teacher_id = $_SESSION['index_number']; // or $_SESSION['teacher_id']

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    print_r($_POST); // This will print all POST data
    echo '</pre>';
    // exit; // Remove or comment this out to allow further processing
    $quizTitle = $_POST['quizTitle'];
    $questions = $_POST['questions'];
    // You may want to get subject_id from the form or session
    $subject_id = 1; // Set this dynamically as needed

    // Insert quiz
    $stmt = $conn->prepare("INSERT INTO quizzes (title, subject_id, teacher_id, created_at) VALUES (?, ?, ?, NOW())");
    if (!$stmt) {
        die("Quiz Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sii", $quizTitle, $subject_id, $teacher_id);
    if (!$stmt->execute()) {
        die("Quiz Execute failed: " . $stmt->error);
    }
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
        if (!$stmt) {
            die("Question Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("issssi", $quiz_id, $question, $option1, $option2, $option3, $correct);
        if (!$stmt->execute()) {
            die("Question Execute failed: " . $stmt->error);
        }
        $stmt->close();
    }

    echo "Quiz and questions inserted successfully.";
    // header("Location: my_subject2.php?quiz=success");
    // exit();
} else {
    header("Location: my_subject2.php");
    exit();
}
?>