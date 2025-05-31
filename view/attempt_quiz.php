<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:../index.php');
    exit;
}
include_once('../controller/config.php');
session_start();
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>

<?php
if (!isset($_GET['quiz_id'])) {
    echo "Quiz not specified.";
    exit;
}
$quiz_id = $_GET['quiz_id'];

// Fetch quiz title (optional)
$quiz_title_sql = "SELECT title FROM quizzes WHERE id = ?";
$quiz_title_stmt = $conn->prepare($quiz_title_sql);
$quiz_title_stmt->bind_param("i", $quiz_id);
$quiz_title_stmt->execute();
$quiz_title_stmt->bind_result($quiz_title);
$quiz_title_stmt->fetch();
$quiz_title_stmt->close();

echo "<h3>" . htmlspecialchars($quiz_title) . "</h3>";

// Fetch quiz questions
$sql = "SELECT * FROM quiz_questions WHERE quiz_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<form method='POST' action='submit_student_quiz.php'>";
while($q = $result->fetch_assoc()) {
    echo "<div><b>" . htmlspecialchars($q['question']) . "</b></div>";
    for($i=1; $i<=3; $i++) {
        $opt = htmlspecialchars($q["option$i"]);
        echo "<label><input type='radio' name='answers[{$q['id']}]' value='$i' required> $opt</label><br>";
    }
    echo "<hr>";
}
echo "<label>Feedback to Teacher:</label><br>";
echo "<textarea name='feedback' class='form-control'></textarea><br>";
echo "<input type='hidden' name='quiz_id' value='$quiz_id'>";
echo "<button type='submit' class='btn btn-success'>Submit Quiz</button>";
echo "</form>";
?>