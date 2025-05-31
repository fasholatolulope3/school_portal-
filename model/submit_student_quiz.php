<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>

<?php
$quiz_id = $_POST['quiz_id'];
$student_id = $_SESSION['student_id'];
$answers = $_POST['answers'];
$feedback = $_POST['feedback'];

// Save answers
foreach($answers as $question_id => $selected_option) {
    $sql = "INSERT INTO student_quiz_answers (quiz_id, student_id, question_id, selected_option, submitted_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $quiz_id, $student_id, $question_id, $selected_option);
    $stmt->execute();
}

// Save feedback
$sql = "INSERT INTO quiz_feedback (quiz_id, student_id, feedback, submitted_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $quiz_id, $student_id, $feedback);
$stmt->execute();

echo "Quiz submitted! Thank you for your feedback.";
?>