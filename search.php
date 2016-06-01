<?php
require('./connect.inc.php');
if(isset($_GET['keywords']) && !empty($_GET['keywords']))
	{
	$keywords=$_GET['keywords'];

	$arr=explode(" ",$keywords);

	$search_query="";
	foreach ($arr as $i)
	{
		$search_query.="SELECT * FROM `listing` WHERE `title` LIKE '%$i%' UNION
					SELECT * FROM `listing` WHERE `locality` LIKE '%$i%' UNION
					SELECT * FROM `listing` WHERE `address` LIKE '%$i%' UNION
					SELECT * FROM `listing` WHERE `city` LIKE '%$i%' UNION
					SELECT * FROM `listing` WHERE `description` LIKE '%$i%' UNION ";
	}
	$search_query.="SELECT * FROM `listing` WHERE 2=1";

	$message="Search Result For <span class='view-all'>\" $keywords \"</span>";
}
	
	if(isset($_GET['type']) && !empty($_GET['type']))
	{
		$type=$_GET['type'];
		$message="Search Results";
		$search_query="SELECT * FROM `listing` WHERE type='$type'";
	}
	

/*echo $search_query;*/
//die();
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./header.php')?>
	<style>
		input::-moz-placeholder{color:#fff} !important
		input:-ms-input-placeholder{color:#fff} !important
	</style>
    <body>        
       	<div id="part6" class="row sections parts"> 
			<?php include('./nav.php')?>
           <div class="container">
			<div id="popo" class="row house-list"> 
					<h4 class="section-title"><?php echo $message; ?></h4>
				<?php
					$run1=mysqli_query($con,$search_query);
					$num1=mysqli_num_rows($run1);
	
					if ($num1 > 0) {
						while($row = mysqli_fetch_assoc($run1)) {
				
							$posted_by=$row['posted_by'];
							
							$query2="SELECT `name` FROM `users` WHERE `id`='$posted_by'";
							$run2=mysqli_query($con,$query2);
							$num2=mysqli_num_rows($run2);
							$user;
							
							if ($num2 > 0) {
								while($row2 = mysqli_fetch_assoc($run2)) {
									$user=$row2["name"];
								}
							}
				?>
								<div class='listing col s6 m4 l2'>
									<a href="property.php?id=<?php echo $row["id"] ;?>" class="prop-link">
									<div>
										<div class='listing-img' style="background-image: url(uploads/<?php echo $row["image"] ?>.png);"></div>
										<h5 class="prop-title"><?php echo $row["title"] ;?></h5>
										<h6 class="prop-attr"> ₹&nbsp;<?php echo $row["price"] ;?>/month</h6>
										<h6 class="prop-attr"> <i class=" tiny material-icons">room</i> <?php echo $row["locality"] ;?>,<?php echo $row["city"] ;?></h6>
										<h6 class="prop-attr"> <i class=" tiny material-icons">verified_user</i> <?php echo $user ;?></h6>
									</div>
									</a>
								</div>
						<?php 
						}
					}
				else
				{
					echo "<h2> No Results Match your Query </h2>";
				}
				?>
			</div>
			</div>
        </div>   

		
    </body>
    
</html>