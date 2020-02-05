<?php
//category.php
include 'connect.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = " . mysqli_real_escape_string($conn,$_GET['id']);

$result = mysqli_query($conn,$sql);

if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysqli_error();
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<h2>Topics in &prime;' . $row['cat_name'] . '&prime; category</h2><br />';
		}
			?><div id="cat-box" style="width:80%;padding:4px;margin:5px;border:1px ">
			<?php
		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
					topic_cat = " . mysqli_real_escape_string($conn,$_GET['id']);
		
		$result = mysqli_query($conn,$sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			
			if(mysqli_num_rows($result) == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{	
				//prepare the table
				
				
				while($row = mysqli_fetch_assoc($result))
				{				
					//echo '<tr>';
						//echo '<td class="leftpart">';
						//	echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
						//echo '</td>';
						?>
				<div id="cat" style="background:#a6a5a2;width:90%;padding:5px;border:1px; margin-top:5px;border-radius:5px; overflow:auto;">
				
						<a href="topic.php?id=<?php echo $row['topic_id'];?>">
						<div id="cat-left" style="width:70%;float:left;border:1px;color:black">
						<h3><?php echo $row['topic_subject'];?></h3>
						</div>
						</a>
						<div id="cat-right" style="background:#a6a5a2;width:30%;float:right;padding:12px;border:1px;">
						<div style="font-size:small"> Created at:
						<?php echo date('d-m-Y', strtotime($row['topic_date']));?>
						</div>
						</div>
						</div>
												
					<?php
						//echo '<td class="rightpart">';
						//echo '<h3>nnnnn</h3>';
						//	echo date('d-m-Y', strtotime($row['topic_date']));
						//echo '</td>';
					//echo '</tr>';
				}
				
				
			}
			
		}
	}?></div><?php
}

include 'footer.php';
?>
