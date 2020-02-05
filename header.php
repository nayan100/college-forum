<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>PHP-MySQL forum</title>
	
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	 
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css?version=1" type="text/css">
</head>
<body>
<h1><img src="logo.jpg" style="width:70px;height:70px;">&emsp;&emsp;College Forum</h1>
	<?php
      if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
	  echo 'No session available, </a href="signin.php">Sign in</a> first';}
	else
	{
		?>
	<div id="wrapper">
	<!--<div id="menu">-->
	
	
      <nav role="navigation" class="navbar">
      
        <ul class="nav navbar-tabs">
          <li class="active"><a class="item btn" href="/forum/index.php">Home</a> </li> 
          <li ><a class="item btn" href="/forum/create_topic.php">Create a topic</a> </li>
		  <?php
		  if(isset($_SESSION['user_level'])) {
		  if(htmlentities($_SESSION['user_level']==1))
		  {    echo'<li><a class="item btn" href="/forum/create_cat.php">Create a category</a></li>';}}
			?>
		  <li ><a class="item btn" href="/forum/messagehead.php">Messages</a> </li>
		  <li ><a class="item btn" href="#">About Us</a> </li>
		</ul>
		
		<?php

		if(isset($_SESSION['signed_in']))
		{
			echo '<div style="float:right" id="userbar" ><img style="height:50px;  width:50px; border-radius:50%"src="uploads/profile/'. $_SESSION['profiledp'].'" onclick="myfunc()"> not you? <a class="item btn" href="signout.php">Sign out</a></div>';
			?>
			<div class="accountpopup" id="accountpopup" style="visibility:hidden;width:200px; border-radius: 6px;left: 50%;position:absolute"> 
			    <img style="height:50px; width:50px; border-radius:50%" src="uploads/profile/<?php $_SESSION['profiledp']?>"/>
				welcome <strong><?php echo $_SESSION['name'];?></strong><br>
				
				<a href="#">Edit Profile</a><br>
				not you? <a class="item btn" href="signout.php">Sign out</a><br>
				
			</div>
			<?php
		}
		else
		{
			echo '<div style="float:right" id="userbar"><a class="item btn" href="signin.php">Sign in</a> or <a class="item btn" href="signup.php">create an account</a></div>';
		}
		?>
		
		
		
		</nav>
	
	
	</div>
	</div>
	
	<?php } ?>
	<script>
// When the user clicks on <div>, open the popup
function myfunc() {
  var popup = document.getElementById("accountpopup");
  popup.classList.toggle("show");
}
</script>
		<div id="content">
		