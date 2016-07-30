<?php
include "connect.php";
$id=$_GET['id'];
$is_booked=$_GET['booking_status'];
$sql="Select quadrant from currentstatus where id='".$id."'";
$results=$conn->query($sql);
$quadrantarr=$results->fetch_assoc();
$quadrant=str_replace("string(1)", "",$quadrantarr['quadrant']);
$data = array();
$seat=new stdClass();
$seat->id=$id;
$seat->is_booked=$is_booked;
$data['data']=array('quadrant'=>$quadrant,'booking_status'=>array($seat));                                                                    
$data_string = json_encode($data);                                                                                  
$ch = curl_init('https://www.pragyan.org/~revanth/inductions/update.php');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                
$result = curl_exec($ch);
//Updating changes in local db
$sql="Update currentstatus set booked_status='".$is_booked."' where id='".$id."'";
$conn->query($sql);
?>