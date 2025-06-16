<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:../index.php');
    exit;
}
$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '';
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>