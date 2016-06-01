<?php
require('./connect.inc.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./header.php')?>
    
	<style>
		input::-moz-placeholder{color:#fff} !important
		input:-ms-input-placeholder{color:#fff} !important
	</style>
    <body>        
       	<div id="part1" class="row sections parts"> 
			<?php include('./nav.php')?>
			<div id="center_div">
				<div id="span1" class="col s12 m12 l12">
					<p>Buy, Rent or Sell your house easily to people you can trust.</p>
				</div>
				<div id="search_terms" class="row">
					<form id="search_form" action="search.php" method="get">
						<input id="keywords" class="col offset-m1 m8 s10 offset-s1" name="keywords" type="text" placeholder="Search For ..."></input>
						<input id="submit" type="submit"  class="col m2 s4 offset-s4" value="Search"></input>
					</form>
				</div>
			</div>    
        </div>   
        <div class="container">
			<div id="rent" class="row house-list"> 
					<h4 class="section-title">Houses For Rent <span class="view-all"><a href="search.php?type=rent">(View All)</a></span></h4>
				<?php
					$query1="SELECT * FROM `listing` WHERE `type`='rent' ORDER BY `id` DESC LIMIT 6";
					$run1=mysqli_query($con,$query1);
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
				?>
			</div>
			
			<div id="sale" class="row  house-list"> 
					<h4 class="section-title">Houses For Sale <span class="view-all"><a href="search.php?type=sell">(View All)</a></span></h4>
				<?php
					$query1="SELECT * FROM `listing` WHERE `type`='sell' ORDER BY `id` DESC LIMIT 6";
					$run1=mysqli_query($con,$query1);
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
										<h6 class="prop-attr"> ₹&nbsp;<?php echo $row["price"] ;?></h6>
										<h6 class="prop-attr"> <i class=" tiny material-icons">room</i> <?php echo $row["locality"] ;?>,<?php echo $row["city"] ;?></h6>
										<h6 class="prop-attr"> <i class=" tiny material-icons">verified_user</i> <?php echo $user ;?></h6>
									</div>
									</a>
								</div>
						<?php 
						}
					}
				?>
			</div>
			
			<div id="rent" class="row house-list"> 
					<h4 class="section-title">Rooms For Paying Guests<span class="view-all"><a href="search.php?type=pg">(View All)</a></span></h4>
				<?php
					$query1="SELECT * FROM `listing` WHERE `type`='pg' ORDER BY `id` DESC LIMIT 6";
					$run1=mysqli_query($con,$query1);
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
				?>
			</div>
			<hr>
			<footer id="footer">
		  <h6 class="contxt">&copy; POPO Realty 2016-2017</h6>
		</footer>
</div>
    </body>
    
</html>