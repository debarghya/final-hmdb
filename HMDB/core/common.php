<?php
mysql_connect($db_host,$db_username,$db_password) or die(mysql_error());
mysql_select_db($db_name) or die("Database not found");


function setSession($name,$value){
$_SESSION[$name]=$value;
}

//>>>>>>>>>>>Get Session
function getSession($name){
$value=$_SESSION[$name];
return $value;
}

//>>>>>>>Redirect
function redirect($url,$msg){
setSession('notification',$msg);
header("LOCATION:$url");
}

//>>>>>>>Display Notification

function displayNotification(){
if(isset($_SESSION['notification'])){
echo getSession('notification');
setSession('notification','');
}

}
//>>>>>>>>>>>
function run($sql){
$result=mysql_query($sql);
return $result;
}


//>>>>>>>>>>>>>>>>validate 
function protected_area(){
if(!isset($_SESSION['uid'])){
redirect('index.php?option=user&task=login','you must have to login to view this page');
}
}
//>>>>>>>>>>>
function selectData($table,$condition=null){
$rows=array();
if(isset($condition)){
$result=mysql_query("select * from $table where $condition") or die(mysql_error());
}else{
$result=mysql_query("select * from $table") or die(mysql_error());
}
while($row = mysql_fetch_assoc($result)){
$rows[]=$row;
}
return $rows;
}
//>>>>>>>>>>>>>>
function selectSQLData($sql){
$result=mysql_query("$sql") or die(mysql_error());
while($row = mysql_fetch_assoc($result)){
$rows[]=$row;
}
return $rows;
}
//>>>>>>>>>>>>>>>>>>>>>>>insert into
function insert_data($table,$data)
{
foreach($data as $key=>$value)
{
$keys.="`$key`,";
$val.="'$value',";

}
$fields=rtrim($keys,',');
$values=rtrim($val,',');
//print_r($field);
mysql_query("insert into `$table`($fields) values($values)");
return mysql_insert_id();
}