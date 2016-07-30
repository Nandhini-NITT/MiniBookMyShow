<?php
include "connect.php";	
$sql="Select id from currentstatus where booked_status='1'";
$result=$conn->query($sql);
$control=0;
$array=[];
while($control<$result->num_rows)
{
	$row=$result->fetch_assoc();
	$id=intval(str_replace("string(1)", "",$row['id']));
	$array[$control]=$id;
	$control++;
}
echo json_encode($array);
?>
