<?php 
include_once("connect.php");
$uid = $_POST["dataget"];
$stat = $_POST["x"];
$sql="";
if($stat==1){
    $sql = "Update ng_deliverytable SET status = 1 where cust_id='".$uid."'" ;
}
else if($stat==2){
    $sql = "Update ng_deliverytable SET status = 0 where cust_id='".$uid."'" ;
}
if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

?>