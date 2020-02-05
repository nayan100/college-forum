<?php
//create_cat.php
include 'connect.php';
include 'header.php';
?>
<h2>Category</h2>


			
<?php
$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysqli_query($conn,$sql);
?>
<div id="cat-box" style="width:80%;padding:4px;margin:5px;border:1px ">
<?php
if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{

		while($row = mysqli_fetch_assoc($result))
		{				
				$cid=$row['cat_id']
				?>
				
				<div id="cat" style="background:#a6a5a2;width:90%;padding:5px;border:1px ; margin-top:5px;border-radius:5px; overflow:auto;">
				<a href="category.php?id=<?php echo $row['cat_id'];?>">
				<div id="cat-left" style="width:70%;float:left;border:1px ;color:black">
				<h3><?php echo $row['cat_name'];?></h3>
				<?php echo $row['cat_description'];?>
				</div>
				</a>
				<div id="cat-right" style="background:#a6a5a2;width:30%;float:right;padding;10px;border:1px;">
				<?php
				//fetch last topic for each cat
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $cid . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
									
								
					$topicsresult = mysqli_query($conn,$topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysqli_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							
							while($topicrow = mysqli_fetch_assoc($topicsresult))
							{
								//echo $topicrow['topic_subject'];
							// date('d-m-Y', strtotime($topicrow['topic_date'])
						?>
						
						<a style="text-decoration:none;color:black" href="topic.php?id=<?php echo $topicrow['topic_id'];?>">
						<?php echo $topicrow['topic_subject'];?></a> 
						
						<div style="font-size:small"> posted at:
						<?php echo date('d M  h:ia', strtotime($topicrow['topic_date']));?>
						</div>
						</div>
						</div>
						<?php
						}
						}
					}
				//echo '</td>';
				
		}
	}
}
?>
		</div>	<?php
include 'footer.php';
?>
