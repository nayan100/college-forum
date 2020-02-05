<?php
include 'pdo.php';
require_once("pdo.php");
if(isset($_POST['user']))
{
	
	$q='select * from users where user_name="'.$_POST['user'].'"';
	$result = $conn->query($q);
	if($result)
	{
		if ($result->num_rows > 0)
		{
			while($row=$result->fetch_assoc())
			{
				$user_name=$row['user_name'];
				echo '<option value="'.$user_name.'">';
			}
		}
		else
		{
			echo '<option value="no user">';
		}
	}
	else
		echo $q;
}	

?>