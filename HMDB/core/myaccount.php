<?php
protected_area();
function index(){
$o=getSession('uid');
$p=selectData('user_info','uid='.$o);
$image=$p[0]['image'];
?>
<br>
<b><center><h3 style="background-color:red;width:800px;">This Particular Project Deals With The Online Human Missing Database.</h3></center></b>
	  <br>
<p style="font-size:25;"><br>
      The aim of the project :- The site is presented for the parents, guardians, 
      law enforcement agencies, free of charge, on a one to one manner as an alternative
      and unconventional method for locating a missing child who is lost or is suspected
      of having been kidnapped or is a runaway. It serves as a complement for the conventional</p>
	  <br>
	  <br>
	  <img src="resource/images/hmphoto/<?php  echo $image; ?>" height="200" width="200">
                                      <p>methods and is not intended to interfere with the system's procedures or to promote false hope
                                         Online Human Missing Database tracks all the information regarding
                                         the missing person across the world, if any person see or find the missed
                                         human then if he/she want to give inform then he/she can login into
                                         our site and give the information.</p>
										 <?php
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>edit post page
function edit_post()
{
if(!isset($_GET['mid'])){
echo "Unauthorized access";
exit();
}
$mid=$_GET['mid'];
if(isset($_POST['post']) && isset($_FILES['file']))
{
$filename=$_FILES["file"]["name"];
$filename=explode('.',$filename);
$newfilename=$filename[0].'-'.time().'.'.$filename[1];
$f=$newfilename;
//>>>>>>>>>>>Check image file or not
$imageType=strtolower($_FILES['file']['type']);
if($imageType=='image/jpeg' || $imageType=='image/jpg' || $imageType=='image/png' || $imageType=='image/gif'){


//>>>>>>>>>>uplod 
move_uploaded_file($_FILES["file"]["tmp_name"],
      "resource/images/missing/".$newfilename);
//>>>>>>>>>>>>>>>>>>>>from data
extract($_POST);
$uid=getSession('uid');
$result=mysql_query("UPDATE `missing_db` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',`missingdate`='$mdate',`address`='$add',`city`='$city',`district`='$dist',`state`='$state',`country`='$country',`zip`='$zip',`height`='$height',`weight`='$weight',`age`='$age',`sex`='$sex',`bodysign`='$bsign',`haircolor`='$hcolor',`eyecolor`='$ecolor',`image`='$f' WHERE `mid`='$mid'") or die(mysql_error());

mysql_query("UPDATE `mcontact`SET `address`='$add',`city`='$city',`district`='$dist',`state`='$state',`country`='$country',`zip`='$zip',`phno`='$phno',`email`='$email' WHERE `id`='$mid'");
//redirect("index.php?option=myaccount","Successfully posted data");
}
}
$uid=getsession('uid');
$e=mysql_query("select * from `missing_db` where `mid`='$mid'");
list($mid,$d,$fname,$mname,$lname,$missingdate,$address,$city,$district,$state,$country,$zip,$height,$weight,$age,$sex,$bodysign,$haircolor,$eyecolor,$i)=mysql_fetch_row($e);
//echo $i;
//echo "<hr>";
$f=mysql_query("select * from `mcontact` where `id`='$mid'");
list($address1,$city1,$district1,$state1,$country1,$zip1,$phno1,$email1 )=mysql_fetch_row($f);
//>>>>>>>>>>>>>>Validate User
if(isset($_SESSION['uid'])){
$loggeduid=getSession('uid');
if($loggeduid!=$d){
redirect('index.php','Unauthorized access');
}
}
//>>>>>>>>>>>>>>
?>
<form action="index.php?option=myaccount&task=edit_post&mid=<?php echo $mid;?>" method="POST" enctype="multipart/form-data">
<div id="register">
<center><br><h3>Edit-Post-Human-Details</h3><br/></center>
<center><fieldset style="width:400px; border:2px solid red;">
<legend><b>Name</b><br/></legend>
First Name:<br/>
<input type="text" name="fname"  value="<?php echo "$fname"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Middle Name:<br/>
<input type="text" name="mname" value="<?php echo "$mname"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Last Name:<br/>
<input type="text" name="lname" value="<?php echo "$lname"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:2px solid red;">
<legend><b>Missing Date</b><br/></legend>
Missing Date:<br/>
<input type="text" name="mdate" value="<?php echo "$missingdate"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:2px solid red;">
<legend><b>Missing Form</b><br/></legend>
Address:<br/>
<input type="text" name="add" value="<?php echo "$address"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
City:<br/>
<input type="text" name="city" value="<?php echo "$city"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
District:<br/>
<input type="text" name="dist" value="<?php echo "$district"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
State:<br/>
<input type="text" name="state" value="<?php echo "$state"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Country:<br/>
<input type="text" name="country"  value="<?php echo "$country"; ?>"size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Zip Code:<br/>
<input type="text" name="zip"  value="<?php echo "$zip"; ?>"size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:2px solid red;">
<legend><b>Missing Human Contact Details</b><br/></legend>
Address:<br/>
<input type="text" name="add" value="<?php echo "$address1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
City:<br/>
<input type="text" name="city" value="<?php echo "$city1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
District:<br/>
<input type="text" name="dist" value="<?php echo "$district1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
State:<br/>
<input type="text" name="state" value="<?php echo "$state1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Country:<br/>
<input type="text" name="country" value="<?php echo "$country1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Zip Code:<br/>
<input type="text" name="zip"  value="<?php echo "$zip1"; ?>"size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Phone No:<br/>
<input type="text" name="phno" value="<?php echo "$phno1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Email:<br/>
<input type="text" name="email" value="<?php echo "$email1"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
</fieldset></center>
<br>
<center><fieldset style="width:400px; border:2px solid red;">
<legend><b>Drescription</b><br/></legend>
Height:<br/>
<input type="text" name="height" value="<?php echo "$height"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Weight:<br/>
<input type="text" name="weight" value="<?php echo "$weight"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Age:<br/>
<input type="text" name="age" value="<?php echo "$age"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Sex:<br/>
<input type="text" name="sex" value="<?php echo "$sex"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Body Sign:<br/>
<input type="text" name="bsign" value="<?php echo "$bodysign"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Hair Color:<br/>
<input type="text" name="hcolor" value="<?php echo "$haircolor"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Eye Color:<br/>
<input type="text" name="ecolor" value="<?php echo "$eyecolor"; ?>" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
Image:<br/>
<input type="file" name="file" value="<?php echo "$i"; ?>" id="file" size="30" style="border:2px solid #0f6581;position:relative;left:30px;"><br/>
<input type="hidden" name="mid" value="<?php echo "$mid";?>">

</fieldset></center>
<br>
<center><input type="submit" name="post" value="post"style="background:#3bbdcd;width:100px;height:30px;align:center;"></center>
</div>
</form>
<?php
}
?>

