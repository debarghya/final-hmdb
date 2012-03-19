<html>
<head>
<link rel='stylesheet' type='text/css' href='template/css/default.css'>
	<link rel="stylesheet" href="template/css/menu_style.css" type="text/css" />
	<title>Human Missing DataBase</title>
</head>

<body>
<div id="main">
			<div id="header">
			
			<h1>Human Missing Database</h1>
			</div>
			
			<div class="menu">
		<ul>
			<li><a href="index.php" id="current">Home</a></li>
			<li><a href="index.php?option=user&task=view">List Missing data</a>
		  </li>
			<li><a href="#">MyAccount</a>
                <ul>
				<?php
				if(isset($_SESSION['uid'])){
				echo '<li><a href="index.php?option=user&task=post">Post Missing Data</a></li>
				 <li><a href="index.php?option=user&task=logout">Logout</a></li>';
				}else{
				echo '<li><a href="index.php?option=user&task=login">Login</a></li>
                <li><a href="index.php?option=user&task=register">Register</a></li>';	
				}            
                 ?>             
                </ul>
          </li>
			<li><a href="index.php?option=about_us">About Us</a></li>
			<li><a href="index.php?option=contact_us">Contact Us</a></li>
		</ul>
	
          
            </div>
			<div id="content">