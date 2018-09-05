<?php
require('./connect.inc.php');
session_start();
if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])))
{
	header('Location: index.php');
}
else
{
	$user_id=$_SESSION['user_id'];
	$prop_id=$_GET['id'];

	if(isset($_POST["message"]) && !empty($_POST["message"]))
	{
		$message=mysql_real_escape_string($_POST['message']);
		$to=mysql_real_escape_string($_POST['to']);
		$time=time();

		$query2="INSERT INTO `messages` VALUES('','$user_id','$to','$message','$time','0', '0')";
		$run2=mysqli_query($con,$query2);
		$last_id=mysqli_insert_id($con);
	}

	$query1="SELECT * FROM `listing` WHERE `id`='$prop_id'";
	$run1=mysqli_query($con,$query1);
	$num1=mysqli_num_rows($run1);

	if ($num1 > 0) {
		while($row = mysqli_fetch_assoc($run1)) {

			$posted_by=$row['posted_by'];
			$img_url=$row['image'];
			$title=$row['title'];
			$desc=$row['description'];
			$price=$row["price"];
			$address=$row["address"];
			$locality=$row["locality"];
			$city=$row["city"];
			$type=$row["type"];

			if($type=="sell")
				$type="Sale";
			else if($type="rent")
				$type="Rent";
			else if($type="pg")
				$type="Paying Guests";

			$query2="SELECT `name` FROM `users` WHERE `id`='$posted_by'";
			$run2=mysqli_query($con,$query2);
			$num2=mysqli_num_rows($run2);

			if ($num2 > 0) {
				while($row2 = mysqli_fetch_assoc($run2)) {
					$user=$row2["name"];
				}
			}

		}	
	}
	else
	{
		header("Location: index.php");
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<?php include('./header.php')?>
	<body>        
	   	<div id="part4" class="parts row sections"> 
			<?php include('./nav.php')?>
			<div id="center_div" class="other_panes container">
				<div class="heading" class="col s12 m12 l12">
					<h4><?php echo $title; ?></h4>
				</div>
				<div class="row inner-prop">
					<img class="col s12 m6" src="uploads/<?php echo $img_url ?>.png"/>
					<div class="left-align col s12 m6">
						<h5> ₹&nbsp; <?php echo $price ;?></h5>
						<h5> <i class=" material-icons">info_outline</i> For <?php echo $type ;?></h5>
						<h5> <i class=" material-icons">room</i> <?php echo $address ;?>,<?php echo $locality ;?>,<?php echo $city ;?></h5>
						<h5> <i class=" material-icons">verified_user</i> <?php echo $user ;?></h5>
						<h5> <i class=" material-icons">description</i> <?php echo $desc; ?> </h5>
						<form action="property.php?id=<?php echo $prop_id; ?>" method="post">
							<textarea class="block-inp" name="message" style="border:1px solid #0076b6;" placeholder="Send Message"></textarea>
							<input class="block-btn col s12" type="submit" value="Send Message"/>
							<input type="hidden" name="to" value="<?php echo $posted_by ?>"/>
						</form>
					</div>
				</div>
			</div>    
        </div>
    </body>
</html>