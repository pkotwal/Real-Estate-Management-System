<?php 
require('./connect.inc.php');
session_start();
$loggedin=0;
$name="";
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	$loggedin=1;
	$userid=$_SESSION['user_id'];
	$query="SELECT * FROM `users` WHERE `id`='$userid'";
	$run=mysqli_query($con,"SELECT * FROM `users` WHERE `id`='$userid'");
	if($run)
	{
		while ($row=mysqli_fetch_row($run))
		{
			$name =$row[1];
		}	
	}
	
	$query5="SELECT * FROM  `messages` WHERE  `to` = $userid AND `read` = '0'";
	$run5=mysqli_query($con,$query5);
	$num5=mysqli_num_rows($run5);
}
?>
<div id="nav_bar" class="navbar">
	<nav>
		<div class="nav-wrapper">
			<a href="index.php" class="brand-logo">Popo Realty</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<?php
				if($loggedin==1)
				{?>
				
					<ul id="dropdown1" class="dropdown-content">
					  <li><a href="logout.php">Logout</a></li>
					  <!--<li><a href="#!">two</a></li>
					  <li class="divider"></li>
					  <li><a href="#!">three</a></li>-->
					</ul>
						<li><a class=" sc" href="messages.php">Messages<?php if($num5>0) echo "($num5)" ?></a></li>
						<li><a class=" sc" href="newlisting.php">Create Listing</a></li>
						<!--<li><a class=" sc" href="#part3"></a></li>-->
						<li><a class="sc dropdown-button" href="#!" data-activates="dropdown1"><?php echo $name; ?><i class="material-icons right">arrow_drop_down</i></a></li>
				<?php
				}
				else
				{?>
						<li><a class=" sc" href="signup.php">Sign Up</a></li>
						<li><a class=" sc" href="signin.php">Sign In</a></li><?php
				}
				?>
			</ul>
		</div>
		<ul class="side-nav" id="mobile-demo">
			<?php
			if($loggedin==1)
			{
				echo '<li><a class="waves-effect waves-teal scroll" href="#part3">Post Ad</a></li>';
			}
			else
			{
				echo '<li><a class="waves-effect waves-teal scroll" href="signup.php">Sign Up</a></li>
			<li><a class="waves-effect waves-teal scroll" href="signin.php">Sign In</a></li>';
			}
			?>
		</ul>
	</nav>
</div>