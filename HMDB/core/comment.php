<?php
function index()
{
if(isset($_GET['mid'])){
$mid=intval($_GET['mid']);
}else{
redirect('index.php','Unauthorized Access');
}
if(isset($_POST['submit']))
{
$a=$_POST;
$a['mid']=$mid;
unset($a['submit']);
// $name=$_POST['name'];
// $phno=$_POST['phno'];
// $email=$_POST['email'];
// $title=$_POST['title'];
// $msg=$_POST['msg'];
print_r($a);
insert_data("view_content",$a);
redirect("index.php?option=user&task=view_details&id=$mid","Comment submited successfully");
}
else
{
?>
<br>
<center><h3>FORM TO GIVE DETAILS FOR COMMENTS<h3></center>
<center><fieldset style="border:2px solid red; width:400px;">
<legend>MISSING DETAIL</legend>
<form action="index.php?option=comment&mid=<?php echo $mid;?>" method="POST">
Name:<br><input type="text" name="name" ><br>
Phone-No:<br><input type="text" name="phno" maxlength=8><br>
Email-Id:<br><input type="text" name="email"><br>
Title:<br><input type="text" name="title"><br>
Message:<br>
<textarea name="msg"style="height:200px; width:200px; border:4px solid green; padding:4px;"></textarea>
<br>
</fieldset>
<br><input type="submit" name="submit" value="submit"><center>
<?php
}
}
?>