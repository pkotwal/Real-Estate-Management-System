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
	if(isset($_POST['message']) && !empty($_POST['message']))
	{
		$message=mysql_real_escape_string($_POST['message']);
		$to=mysql_real_escape_string($_POST['sid']);
		$reply=mysql_real_escape_string($_POST['mid']);
		$time=time();
		
		$query2="INSERT INTO `messages` VALUES('','$user_id','$to','$message','$time','0','$reply')";
		$run2=mysqli_query($con,$query2);
		$last_id=mysqli_insert_id($con);
		
		
		$sql = "UPDATE `messages` SET `read`= 1 WHERE `id`='$reply'";
		mysqli_query($con, $sql);
	}

}

?>
<!DOCTYPE html>
<html lang="en">
	<?php include('./header.php')?>
	<body>        
	   	<div id="part5" class="parts row sections"> 
			<?php include('./nav.php')?>
			<div id="center_div" class="other_panes container message_div">
				<div class="heading" class="col s12 m12 l12">
					<h4>Messages</h4>
				</div>
				<div class="">
					<div class="row">
						<?php
							$query="SELECT * FROM `messages` WHERE `to` = '$user_id' ";
							$run=mysqli_query($con,$query);
							$num=mysqli_num_rows($run);

							if ($num > 0) {
								echo "<table class='col s10 offset-s1'>";
								while($row = mysqli_fetch_assoc($run)) {
									$sender_id=$row['from'];
									$message=$row['message'];
									$mid=$row['id'];
									$read=$row['read'];
									
									$actual_time=date('M Y  H:i:s',$row['time']);

									$query6="SELECT * FROM `users` WHERE `id` = '$sender_id'";
									$run6=mysqli_query($con,$query6);
									$num6=mysqli_num_rows($run6);

									if ($num6 > 0) {
										while($row2 = mysqli_fetch_assoc($run6)) {
											$name = $row2['name'];
										}
									}

									?>
							<tr>
								<td><h5 style="color:#0076b6;"><?php echo $name;?>:</h5></td>
								<td><h6 style="font-size:20px;"><?php echo $message; ?></h6></td>
								<td  style="font-size:20px;"><?php echo $actual_time; ?></td>
								<td  style="font-size:15px; color:red;"><?php if($read==0) echo "[Not Replied]"; ?></td>
							</tr>
						
						<?php
							$query7="SELECT * FROM `messages` WHERE `reply` = '$mid'";
							$run7=mysqli_query($con,$query7);
							$num7=mysqli_num_rows($run7);	
									
							if ($num7 > 0) {
								while($row7 = mysqli_fetch_assoc($run7)) {
									$sender_id7=$row7['from'];
									$message7=$row7['message'];
									$mid7=$row7['id'];
									
									$actual_time7=date('M Y  H:i:s',$row7['time']);

									$query8="SELECT * FROM `users` WHERE `id` = '$sender_id7'";
									$run8=mysqli_query($con,$query8);
									$num8=mysqli_num_rows($run8);

									if ($num8 > 0) {
										while($row8 = mysqli_fetch_assoc($run8)) {
											$name7 = $row8['name'];
										}
									}
									?>
							<tr style="margin-left:15px;">
								<td><h5 style="color:#0076b6;"><?php echo $name7;?>:</h5></td>
								<td><h6 style="font-size:20px;"><?php echo $message7; ?></h6></td>
								<td  style="font-size:20px;"><?php echo $actual_time7; ?></td>
							</tr>
						<?php
								}
							}

						?>
						
						<tr>
							<form action="messages.php" method="post">
								<td colspan="2"><textarea name="message" placeholder="Send Reply" class="message block-inp"></textarea></td>
								<td><input class="block-btn" value="Reply" type="submit"/></td>
								<input type="hidden" name="mid" value="<?php echo $mid  ?>"/>
								<input type="hidden" name="sid" value="<?php echo $sender_id  ?>"/>
							</form>
						</tr>

						<?php
							}
							echo "</table>";
						}
						else
						{
							echo "<h2>No Messages To Show</h2>";
						}
						?>
					</div>
				</div>
			</div>    
        </div>
    </body>
</html>