<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
session_start();
ob_start();
require('config.php');
require('core/common.php');
if(isset($_GET['option'])){
$option=$_GET['option'];
}else{
$option='default';
}
if(isset($_GET['task'])){
$task=$_GET['task'];
}else{
$task='index';
}

//>>>>>>>Include page as per Option Require
if(file_exists('core/'.$option.'.php')){
require('core/'.$option.'.php');
}else{
echo "Invalid Page Request";
exit();
}
//>>>>>>>>>>>>
require('template/header.php');
//>>>>>>>>>>>>>>>>>Display Notification
displayNotification();
//>>>>>>>>>>>>>>Call function as per task required
$task();

ob_end_flush();

require('template/footer.php');