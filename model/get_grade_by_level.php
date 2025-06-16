<?php

include_once('../controller/config.php');
$id=$_GET["level"];
$sql = "SELECT * FROM grade WHERE level='$id' ORDER BY name ASC"; 
$result=mysqli_query($conn,$sql);
$grade=array();
while($row=mysqli_fetch_assoc($result)){ 
    $gra = array('id' => $row['id'], 'name' => $row['name']);
    array_push($grade, $gra);
}
echo json_encode($grade);//MSK-00106
?>	


