<?php
include('includes/dbconnection.php');
$name=$_POST['cn'];
$type=$_POST['type'];	

if($type=='city'){
	$id = "SELECT `id` FROM `state` WHERE `name`='$name'";
}else{
	$id = "SELECT `id` FROM `country` WHERE `name`='$name'";
}

$query1=$dbh->prepare($id);
$query1->execute();

$result=$query1->fetch(PDO::FETCH_ASSOC);
print_r($result);

if($type=='city'){
	$sql1="SELECT `id`, `name` FROM `city` WHERE `state_id`= $result[id] ";
}else{
	$sql1="SELECT `id`, `name` FROM `state` WHERE `country_id`= $result[id]";
}

$query=$dbh->prepare($sql1);
$query->execute();

$arr=$query->fetchAll(PDO::FETCH_ASSOC);
$html='';
foreach($arr as $list){
	$html.='<option value='.$list['name'].'>'.$list['name'].'</option>';
}
echo $html;
?>