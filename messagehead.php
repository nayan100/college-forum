<?php
//create_topic.php
include 'connect.php';
include 'header.php';

if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a>.';
}
else
{?>
	<div id="new-mes" style="box-shadow:2px 10px 30px #000000;background-filter: blur(10px);width:40%;position:fixed;top:20%;left:50%;transform:translate(-50%,0);background:white;border-radius:5px;overflow:auto;display:none">
	<p class="m-head" style="background:black;padding:3px;color:white;text-align:center">Create message</p>
	<p class="m-body" style="padding-left:3px">
	<form  method="post" style="padding:5px">
	<div class="input-group">
	<div class="input-group-prepend">
	<span class="input-group-text" >Username</span>
	</div>
	<input type="text" list="avuser"  onkeyup="checkuser()" class="from-control" id="user_nam" name="user_nam"/>
	<datalist id="avuser"></datalist>
	</div><br>
	<div class="input-group">
	<div class="input-group-prepend">
	<span class="input-group-text" >Message</span>
	</div>
	<textarea class="form-control" name="message" aria-label="Message"></textarea>
	</div><br>
	<div style="text-align:center">
	<input type="submit" class="btn" id="send" style="background:#00728B;color:white" value="Send" name="send" />
	<button onclick="document.getElementById('new-mes').style.display='none'" style="background:#00728B;color:white" class="btn">Cancel</button>
	</div>
	</form>
	</p>
	</div>
	
	<?php
	require_once("pdo.php");
	if(isset($_POST['send']))
	{
		$sender=$_SESSION['user_name'];
		$reciever=$_POST['user_nam'];
		$message=$_POST['message'];
		//$sender='nayan';
		//$reciever='mmm';
		//$message='success';
		 date_default_timezone_set('Asia/Kolkata');
		$date=date("Y-m-d h:i:s");
		//$conn = mysqli_connect('localhost', 'root', '','evertsmitnet_main');
		$sql = 'INSERT INTO messages(sender, reciever, message, date_time) VALUES("'.$sender.'","'.$reciever.'","'.$message.'","'.$date.'")';
		//$r = mysqli_query($conn, $sql);
		//if($sql)
		//{
			//echo 'Message sent successfully';
		//}
		//else{
			//echo'not sent';
		//	echo 'not';
		
if ($conn->query($sql) === TRUE) {
    header("location:messagehead.php?to=".$reciever);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

	}
	
	
	?>
	
	
	<h2>Messages</h2>
	<div  id="mcontainer">
	<div id="mcontainer-left" style=" height:380px;float:left;width:30%; overflow:auto">
	<button class="btn" id="new-message" onclick="document.getElementById('new-mes').style.display='block'" style="border-radius:2px;padding:5px; width:99%;margin:2px 2px 0 0;background:#00728B;color:white;text-align:center">
	New Message
	</button>
	 
	<?php
	$q='select distinct reciever,sender from messages where sender="'.$_SESSION['user_name'].'" or reciever="'.$_SESSION['user_name'].'" order by date_time desc';
	$r=mysqli_query($conn,$q);
	if($r)
	{
		if(mysqli_num_rows($r)>0)
		{
			$counter=0;
			$added_user=array();
			while($row=mysqli_fetch_assoc($r))
			{
				$sender=$row['sender'];
				$reciever=$row['reciever'];
				if($_SESSION['user_name']==$sender)
				{
					if(in_array($reciever,$added_user))
					{
						
					}
					else
					{ 
						$sql='select profiledp from users where user_name="'.$reciever.'"';
						$p=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($p))
						{	
						echo '<a href="?to='.$reciever.'">';
						?>
						<div id="con-left" style="text-decoration:none;border:1px solid black;padding:5px; margin:2px 2px 0 0">
						<img style="height:50px; width:50px; border-radius:50%" src="uploads/profile/<?php echo $row['profiledp'];?>">
						<?php echo $reciever;  ?>
						</div></a>
						<?php
						$added_user=array($counter=>$reciever);
						$counter++;
						}
					}
				} 
				elseif($_SESSION['user_name']==$reciever)
				{
					if(in_array($sender,$added_user))
					{
						
					}
					else
					{
						$sql='select profiledp from users where user_name="'.$sender.'"';
						$p=mysqli_query($conn,$sql);
						while($row=mysqli_fetch_assoc($p))
						{
						echo '<a href="?to='.$sender.'">';
						?>
						<div id="con-left" style="text-decoration:none;border:1px solid black;padding:5px; margin:2px 2px 0 0">
						<img style="height:50px; width:50px; border-radius:50%" src="uploads/profile/<?php echo $row['profiledp'];?>">
						<?php echo $sender;  ?>
						</div></a>
						<?php
						$added_user=array($counter=>$sender);
						$counter++;
						}
					}
				} 
			}
		}
		else
			echo 'No user.';
	}
	else
		echo $mysqli->error;
	?>
	
	
	
	
	
	
	</div>
	
	<div id="mcontainer-right" style="height:380px;float:left;width:60%;border:1px; ">
	<div id="con-right" style="background:#8e918f;height:300px;float:left;width:100%;overflow:auto;border:1px solid black;border-radius:5px">
	
	<?php
	$no_message=false;
	if(isset($_GET['to']))
	{
		$_GET['to']=$_GET['to']; 
	}
	else
	{
		$q='select sender, reciever from messages where sender="'.$_SESSION['user_name'].'"
		or reciever="'.$_SESSION['user_name'].'" order by date_time desc limit 1';
		$r=mysqli_query($conn, $q);
		if($r)
		{
			if(mysqli_num_rows($r)>0)
			{
				while($row=mysqli_fetch_assoc($r))
				{
					$sender=$row['sender'];
					$reciever=$row['reciever'];
					if($_SESSION['user_name']==$sender)
					{
						 $_GET['to']=$reciever;
					}
					else
					{
						$_GET['to']=$sender;
					}
						
				}
			}
			else
				echo "No messages";
				$no_message=true;
		}
		else
			$q;
	}
	?>
	
	
	<?php
	if($no_message==false){	
	$q= 'SELECT * FROM messages WHERE sender="'.$_SESSION['user_name'].'" AND reciever="'.$_GET['to'].'" OR sender="'.$_GET['to'].'" AND reciever="'.$_SESSION['user_name'].'" ';
	$r=mysqli_query($conn, $q);
	if($r)
	{
		while($row=mysqli_fetch_assoc($r))
		{
			$sender=$row['sender'];
			$reciever=$row['reciever'];
			$message=$row['message'];
			$date=date('dM h:ia', strtotime($row['date_time']));
			//$date=$row['date_time'];
			if($sender==$_SESSION['user_name']) 
			{
				?>
				<div id="send-right" style="background:white;padding:3px;border:1px;width:70%;border-radius:10px;text-align:right;float:right;margin-top:3px;margin-right:3px">
				<strong style="color:blue;font-size:small">me   </strong><br>
				<?PHP echo $message; ?><br>
				<div style="font-size:10px;text-align:left">
				<?php echo $date; ?></div>
				</div>
				
				<?php
			}
			else
			{
				?>
				<div id="recev-right" style="background:white;padding:3px;border:1px;border-radius:10px;width:70%;text-align:left;float:left;margin-top:3px;margin-left:3px">
				<strong style="color:red;font-size:small"><?php echo '  '.$sender; ?></strong><br>
				<?PHP echo $message; ?><br>
				<div style="font-size:10px;text-align:right">
				<?php echo $date; ?></div>
				</div>
				<?php
			}
		}
	}
	else
	{
		echo $q;
	}
	}
	?>
	
	
	
	
	</div>
	<div id="send-right" style="height:80px;float:left;width:100%;border:2px; ">
	<form method="post" id="message-form">
	<div class="input-group" style="padding:4px;border-radius:10px">
	<textarea class="form-control" style="background:#c5c9c7" id="message_text" name="send-message" aria-label="Message"></textarea>
	<div class="input-group-append">
	<input type="submit" class="input-group-text" value="Send" style="background:#00728B;background:#00728B;color:white"/>
	</div>
	</div>
	</form>
	</div>
	
	</div>
	
	</div>
	
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  
  <script>
  $("document").ready(function(event)
  {
	 $("#message-form").on('submit',function(){
		 var message_text=$("#message_text").val();
		 $.post("send-message.php?to=<?php echo $_GET['to'];?>",{text:message_text,},function(data,status){
			 //alert(data);
			$("#message_text").val("");
			 document.getElementById("con-right").innerHTML+=data;
		 });
	 });
	 $("send-right").keypress(function(e){
		 if(e.keycode==13 && !e.shiftKey)
		 {
			 $("#message-form").submit();
		 }
	 }); 
  }
  );
  
  
  
  function checkuser(){
	  var user_name=document.getElementById("user_nam").value;
	  $.POST("check_user.php",
	  {
		  user:user_name
		  },
	  function(data,status)
	  {
		  alert(data);
		  //if(data=='<option value="no user">')
			//  document.getElementById("send").disabled=true;
		  //else
			//  document.getElementById("send").disabled=false;
	  }
	  );
  }
  </script>

	<?php
}

include 'footer.php';
?>
