<?php

include_once('../controller/config.php');
$level=$_GET["level"];
$sql = "SELECT * FROM subject WHERE level='$level' ORDER BY name ASC"; //MSK-00106
$result=mysqli_query($conn,$sql);
//$row=mysqli_fetch_assoc($result);
$subjects=array(); $grade=array(); //MSK-00106
while($row=mysqli_fetch_assoc($result)){
    $sub = array('id' => $row['id'], 'name' => $row['name']);
    array_push($subjects, $sub);
}
echo json_encode($subjects);//MSK-00106

?>	


