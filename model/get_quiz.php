<?php
include_once('controller/config.php');
$subject = $_GET['subject'] ?? '';
// Find the latest quiz for this subject (adjust as needed)
$sql = "SELECT q.id, q.title FROM quizzes q
        JOIN subject ON q.subject_id = subject.id
        WHERE subject.name = ? ORDER BY q.created_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $subject);
$stmt->execute();
$result = $stmt->get_result();
if ($quiz = $result->fetch_assoc()) {
    echo "<h5>" . htmlspecialchars($quiz['title']) . "</h5>";
    $quiz_id = $quiz['id'];
    $qsql = "SELECT * FROM quiz_questions WHERE quiz_id = ?";
    $qstmt = $conn->prepare($qsql);
    $qstmt->bind_param("i", $quiz_id);
    $qstmt->execute();
    $qres = $qstmt->get_result();
    $qnum = 1;
    while ($row = $qres->fetch_assoc()) {
        echo "<div class='form-group'>";
        echo "<label>Q{$qnum}: " . htmlspecialchars($row['question']) . "</label>";
        for ($i = 1; $i <= 3; $i++) {
            $opt = htmlspecialchars($row["option$i"]);
            echo "<div><label><input type='radio' name='answers[{$row['id']}]' value='$i' required> $opt</label></div>";
        }
        echo "</div>";
        $qnum++;
    }
    $qstmt->close();
} else {
    echo "<p>No quiz found for this subject.</p>";
}
$stmt->close();
?>
