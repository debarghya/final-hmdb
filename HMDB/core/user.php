<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
?>

<?php
function login()
{
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$result=run("select * from user where username='$username' and password='$password'and blocked=0");
$totalRecord=mysql_num_rows($result);
if($totalRecord==1)
{
list($uid)=mysql_fetch_row($result);
setSession('uid',$uid);
run("update user set lastlogin=NOW() where uid='$uid'");
redirect('index.php?option=myaccount','login successfully');


}else{
redirect('index.php?option=user&task=login','you have entered wrong username & password');
}

}
else
{
echo '<fieldset>
<legend>Login From</legend>
<form action="index.php?option=user&task=login" method="POST">
USERNAME:<br><input type="text" name="username"  /><br>
PASSWORD:<br/><input type="password" name="password" /><br>
<br><input type="submit" name="login" value="LOGIN" />
</form>
</fieldset>';

}
//>>>>>>end function
}

//>>>>>>>>>>>Logout
function logout(){
session_destroy();
session_start();
redirect('index.php?option=user&task=login','You have logout sucessfully');
}
//>>>>>>>>>>>Register
function register(){
//$images=scandir('resource/images/hmphoto/');
if(isset($_POST['register']) && isset($_FILES['file']))
{
$filename=$_FILES["file"]["name"];
$filename=explode('.',$filename);
$newfilename=$filename[0].'-'.time().'.'.$filename[1];
//>>>>>>>>>>>Check image file or not
$imageType=strtolower($_FILES['file']['type']);
if($imageType=='image/jpeg' || $imageType=='image/jpg' || $imageType=='image/png' || $imageType=='image/gif'){


//>>>>>>>>>>
move_uploaded_file($_FILES["file"]["tmp_name"],
      "resource/images/hmphoto/".$newfilename);
extract($_POST);
$data=$_POST;
//echo $data;
unset($data['register']);
$actkey=md5(time());
$data['actkey']=$actkey;
$result=mysql_query("insert into `user`(`username`,`password`,`email`,`usertype`,`blocked`,`activationkey`) values('$uname','$pword','$email',1,0,'$actkey')") or die(mysql_error());
$uid=mysql_insert_id();
mysql_query("insert into `user_info`(`uid`,`fname`,`mname`,`lname`,`address`,`state`,`age`,`sex`,`country`,`pin`,`phno`,`image`) values('$uid','$fname','$mname','$lname','$add','$state','$age','$sex','$country','$pin','$phno','$newfilename')") or die(mysql_error());;
redirect('index.php?option=user&task=login','Suceess : Register Sucessfully');
}else{
redirect('index.php?option=user&task=register','Error : Invalid image format');
}
}
else
{
echo'
<form action="index.php?option=user&task=register" method="POST" enctype="multipart/form-data">
<div id="register">
<center><fieldset style="border: 2px solid red; width:500px; align:center;">
<legend style="align:center;">Members Registration Area</legend>
<p>Username:</p>
<input type="text" name="uname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Password:</p>
<input type="text" name="pword" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Email:</p>
<input type="text" name="email" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>First Name:</p>
<input type="text" name="fname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Middle Name:</p>
<input type="text" name="mname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Last Name:</p>
<input type="text" name="lname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Address:</p>
<input type="text" name="add" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>State:</p>
<input type="text" name="state" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Age:</p>
<input type="text" name="age" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Sex:</p>
<input type="text" name="sex" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Country:</p>
<input type="text" name="country" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Pin:</p>
<input type="text" name="pin" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Phone No:</p>
<input type="text" name="phno" size="30" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Image:</p>
<input type="file" name="file" id="file" size="30"style="border:2px solid #0f6581;position:relative;left:30px;"></fieldset></center>
<p style="position:relative;left:110px;"><center><input type="submit" name="register" value="Register"style="background:#3bbdcd;width:80px;align:center;"></p></center>
</div>
</form>';
}
}

?>
<?php
//>>>>>>>>>>>>>>>Edit Profile
function edit_profile(){
protected_area();
$userId=getSession('uid');
if(isset($_POST['register']) && isset($_FILES['file'])){
$filename=$_FILES["file"]["name"];
$filename=explode('.',$filename);
$newfilename=$filename[0].'-'.time().'.'.$filename[1];
//>>>>>>>>>>>Check image file or not
$imageType=strtolower($_FILES['file']['type']);
if($imageType=='image/jpeg' || $imageType=='image/jpg' || $imageType=='image/png' || $imageType=='image/gif'){


//>>>>>>>>>>
move_uploaded_file($_FILES["file"]["tmp_name"],
      "resource/images/hmphoto/".$newfilename);
$fname=$_REQUEST['fname'];
$mname=$_REQUEST['mname'];
$lname=$_REQUEST['lname'];
$add=$_REQUEST['add'];
$state=$_REQUEST['state'];
$age=$_REQUEST['age'];
$sex=$_REQUEST['sex'];
$country=$_REQUEST['country'];
$pin=$_REQUEST['pin'];
$phno=$_REQUEST['phno'];
$image=$newfilename;
mysql_query("update `user_info` set `fname`='$fname',`mname`='$mname',`lname`='$lname',`address`='$add',`state`='$state',`age`='$age',`sex`='$sex',`country`='$country',`pin`='$pin',`phno`='$phno',`image`='$image' where `uid`='$userId'")
or die(mysql_error());
redirect("index.php?option=myaccount","Updated successfully");
}
}
$e=mysql_query("select * from `user_info` where `uid`='$userId'");
list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l)=mysql_fetch_row($e);

?>
<form action="index.php?option=user&task=edit_profile" method="POST"  enctype="multipart/form-data">
<div id="register">
Edit Profile
<p>First Name:</p>
<input type="text" name="fname" size="30" value="<?php echo "$b"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Middle Name:</p>
<input type="text" name="mname" size="30" value="<?php echo "$c"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Last Name:</p>
<input type="text" name="lname" size="30" value="<?php echo "$d"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Address:</p>
<input type="text" name="add" size="30" value="<?php echo "$e"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>State:</p>
<input type="text" name="state" size="30" value="<?php echo "$f"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Age:</p>
<input type="text" name="age" size="30" value="<?php echo "$g"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Sex:</p>
<input type="text" name="sex" size="30" value="<?php echo "$h"; ?>"style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Country:</p>
<input type="text" name="country" size="30" value="<?php echo "$i"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Pin:</p>
<input type="text" name="pin" size="30" value="<?php echo "$j"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Phone No:</p>
<input type="text" name="phno" size="30" value="<?php echo "$k"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p>Image:</p>
<input type="file" name="file" id="file" size="30" value="<?php echo "$l"; ?>" style="border:2px solid #0f6581;position:relative;left:30px;">
<p style="position:relative;left:110px;"><input type="submit" name="register" value="Register"style="background:#3bbdcd;width:80px;align:center;"></p>
</div>
</form>
<?php
}
?>

<?php
//>>>>>>>>>>>>>>>post profile
function post(){ 
protected_area();
if(isset($_POST['post']) && isset($_FILES['file']))
{
$filename=$_FILES['file']['name'];
$filename=explode('.',$filename);
$newfilename=$filename[0].'-'.time().'.'.$filename[1];
$f=$newfilename;
//>>>>>>>>>>>Check image file or not
$imageType=strtolower($_FILES['file']['type']);
if($imageType=='image/jpeg' || $imageType=='image/jpg' || $imageType=='image/png' || $imageType=='image/gif'){


//>>>>>>>>>>
move_uploaded_file($_FILES["file"]["tmp_name"],
      "resource/images/missing/".$newfilename);
extract($_POST);
$uid=getSession('uid');
$result=mysql_query("insert into `missing_db`(`uid`,`fname`,`mname`,`lname`,`missingdate`,`address`,`city`,`district`,`state`,`country`,`zip`,`height`,`weight`,`age`,`sex`,`bodysign`,`haircolor`,`eyecolor`,`image`) values('$uid','$fname','$mname','$lname','$mdate','$add','$city','$dist','$state','$country','$zip','$height','$weight','$age','$sex','$bsign','$hcolor','$ecolor','$f')") or die(mysql_error());
$id=mysql_insert_id();
mysql_query("insert into `mcontact`(`id`,`address`,`city`,`district`,`state`,`country`,`zip`,`phno`,`email`) values('$id','$add','$city','$dist','$state','$country','$zip','$phno','$email')") or die(mysql_error());
redirect("index.php?option=user&task=view");
}
}
else
{
?>
<form action="index.php?option=user&task=post" method="POST" enctype="multipart/form-data">
<div id="register">

<center><br><h3>Post  Missing Human Details</h3><br/></center>
<center><fieldset style="width:400px; border:1px solid red;">
<legend><b>Name</b><br/></legend>
First Name:<br/>
<input type="text" name="fname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Middle Name:<br/>
<input type="text" name="mname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Last Name:<br/>
<input type="text" name="lname" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:1px solid red;">
<legend><b>Missing Date</b><br/></legend>
Missing Date:<br/>
<input type="text" name="mdate" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:1px solid red;">
<legend><b>Missing Form</b><br/></legend>
Address:<br/>
<input type="text" name="add" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
City:<br/>
<input type="text" name="city" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
District:<br/>
<input type="text" name="dist" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
State:<br/>
<input type="text" name="state" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Country:<br/>
<input type="text" name="country" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Zip Code:<br/>
<input type="text" name="zip" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:1px solid red;">
<legend><b>Missing Human Contact Details</b><br/></legend>
Address:<br/>
<input type="text" name="add" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
City:<br/>
<input type="text" name="city" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
District:<br/>
<input type="text" name="dist" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
State:<br/>
<input type="text" name="state" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Country:<br/>
<input type="text" name="country" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Zip Code:<br/>
<input type="text" name="zip" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Phone No:<br/>
<input type="text" name="phno" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Email:<br/>
<input type="text" name="email" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:1px solid red;">
<legend><b>Drescription</b><br/></legend>
Height:<br/>
<input type="text" name="height" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Weight:<br/>
<input type="text" name="weight" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Age:<br/>
<input type="text" name="age" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Sex:<br/>
<input type="text" name="sex" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Body Sign:<br/>
<input type="text" name="bsign" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Hair Color:<br/>
<input type="text" name="hcolor" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Eye Color:<br/>
<input type="text" name="ecolor" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Image:<br/>
<input type="file" name="file" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><input type="submit" name="post" value="Post"style="background:#3bbdcd;width:80px;"></center>
</div>
</form>

<?php
}

}
?>

<?php
//>>>>>>>>>>>>>>>view profile
function view(){
$rows=selectData('missing_db');
foreach($rows as $row){
echo "
<div id=\"view\">
<div id=\"details\">
Name Is: $row[fname] $row[mname] $row[lname],<br/>Age Is: $row[age]<br/>
Height Is: $row[height],<br/>Weight Is: $row[weight]<br/>
Sex: $row[sex],<br/>Hair Color: $row[haircolor],<br/>Eye Color:$row[eyecolor]<br/>
Body Sign: $row[bodysign]<br/><br/>
<a href=\"index.php?option=user&task=view_details&id=$row[mid]\">VIEW DETAILS</a>
";
if(isset($_SESSION['uid'])){
$loggeduid=getSession('uid');
$msuid=$row['uid'];
$mid=$row['mid'];
if($loggeduid==$msuid){
echo "<a href=\"index.php?option=myaccount&task=edit_post&mid=$mid\">Edit Details</a>";
}
}
echo "
</div>
<div id=\"image\">
<img src=\"resource/images/missing/$row[image]\" width=\"200\" height=\"200\"><br/>
</div>
</div>
";



}




}
?>


<?php
//>>>>>>>>>>>>>>>>>> view individually
function view_details(){
$vid=intval($_GET['id']);
$rows=selectSQLData("select * from missing_db,mcontact where missing_db.mid=mcontact.id and missing_db.mid=$vid");
$row=$rows[0];
echo "
<div id=\"viewdetails\">
<div id=\"missingimage\">
<img src=\"resource/images/missing/$row[image]\" width=\"340\" height=\"380\">
</div>
<div id=\"missingdetails\">

<b>Name:</b><br> 
".ucwords($row['fname']." ".$row['mname']." ".$row['lname']).".<br>
<b>Missing Date:</b><br>
$row[missingdate]<br>
<b>Missing Form</b><br>
Address:".ucwords($row['address'])." City:".ucwords($row['city'])."<br>
District:".ucwords($row['district']).",State:".ucwords($row['state']).",<br>
Country:".ucwords($row['country']).",Zip Code:$row[zip].<br>
<b>Permanent Address</b><br>
Address:".ucwords($row['address']).",City:".ucwords($row['city']).",<br>
District:".ucwords($row['district'])."State:".ucwords($row['state']).",<br>
Country:".ucwords($row['country']).",Zip Code:$row[zip],<br>
Phone No:$row[phno],Email:$row[email].<br>
<b>Description</b><br>
Age: $row[age],Height: $row[height],Weight: $row[weight],<br>
Sex: ".ucwords($row['sex']).",Hair Color: ".ucwords($row['haircolor']).",<br>
Eye Color:".ucwords($row['eyecolor']).",Body Sign: ".ucwords($row['bodysign']).".
<a href=\"index.php?option=comment&mid=$vid\">Add Comments</a>
</div>
</div><div id=\"comments\">
<fieldset>
<legend>User Comments</legend>
";
$rows=selectData('view_content','`mid`='.$vid);
if(count($rows)>0){
echo '<table>';
foreach($rows as $row){
$name=$row['name'];
$msg=$row['msg'];
$email=$row['email'];
$phone=$row['phno'];
echo "
<tr>
<td valign=\"top\">$name : </td>
<td valign=\"top\">$msg <br>E-Mail : $email <br /> Phone : $phone</td>
</tr>";
}
echo '</table>';
}else{
echo "<h3>no comments found</h3>";
}
echo "
</fiedset>
</div>
";
}
?>