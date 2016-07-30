<?php
include "connect.php";
$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, "https://www.pragyan.org/~revanth/inductions/current_status.php?q=curl");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($ch);
$result=json_decode($result, true);
$sql="Select * from currentstatus ";
$rows=$conn->query($sql);
if($rows->num_rows==0)
{
	for($control=0;$control<100;$control++)
	{
		$id=intval(str_replace("string(1)", "",$result[$control]['id']));
		$isBooked=str_replace("string(1)", "",$result[$control]['is_booked']);
		$quadrant=str_replace("string(1)", "",$result[$control]['quadrant']);
		$sql1="Insert into currentstatus (id,booked_status,quadrant) VALUES ('".$id."','".$isBooked."','".$quadrant."')";
		$conn->query($sql1);
	}
		
}
else
{
	for($control=0;$control<100;$control++)
	{
		$id=intval(str_replace("string(1)", "",$result[$control]['id']));
		$isBooked=str_replace("string(1)", "",$result[$control]['is_booked']);
		$sql1="Update currentstatus set booked_status='".$isBooked."' where id='".$id."'";
		$conn->query($sql1);
	}
}
?>