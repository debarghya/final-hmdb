<?php
function index()
{
if(isset($_POST['submit']))
{
//print_r($_POST);
$d=$_POST;
unset($d['submit']);
//print_r($d);
insert_data("contactus",$d);
redirect("index.php","contact as soon as posible");
}
else
{
echo'
<center><fieldset style="border:4px solid red; width:400px;">
<legend>Contact us page</legend>
<form action="index.php?option=contact_us" method="POST">
Name:<br><input type="text" name="uname"><br>
Email Id:<br><input type="text" name="email"><br>
Message:<br><input type="text" name="msg" style="width:300px; height:200px; border:3px solid red;"><br>
</fieldset></center>
<center><input type="submit" name="submit" value="submit"></center>
';
}
}