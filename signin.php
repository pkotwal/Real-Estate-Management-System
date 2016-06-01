<?php
require('./connect.inc.php');
session_start();
$error=0;
$message="";

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	header('Location: index.php');
}
else
{
	if(isset($_POST['email']) && isset($_POST['password']))
	{
		if(!empty($_POST['email']) && !empty($_POST['password']))
		{
			$email=mysql_real_escape_string($_POST['email']);
			$password=md5($_POST['password']);
				
			$query1="SELECT * FROM `users` WHERE `email`='$email' AND  `password`='$password'";
			$run1=mysqli_query($con,$query1);
			$num1=mysqli_num_rows($run1);
				
			if($num1==1)
			{
				while ($row=mysqli_fetch_row($run1))
				{
					$_SESSION['user_id']= $row[0];
				}
				//=$last_id;
				//echo($last_id);
				header('Location: index.php');
			}
			else
			{
				//Incorrect 
				$error=1;
				$message="Incorrect E-mail or password.";
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./header.php')?>
 
    <body>        
    
        
       	<div id="part2" class="parts row sections"> 
			<?php include('./nav.php')?>
			<div id="center_div" class="other_panes col l4 offset-l4 s10 offset-s1">
				<div class="heading" class="col s12 m12 l12">
					<h2>Sign In</h2>
				</div>
				<div class="row">
					<form method="post" id="signup_form" action="signin.php" autocomplete="off">
						<input style="display:none" type="text"></input>
						<input style="display:none" type="password"></input>
						<input id="email" class="col offset-s1 s10 block-inp" value="" name="email" type="text" placeholder="E-mail" required></input>
						<input id="password" class="col offset-s1 s10 block-inp" value="" name="password" type="password" placeholder="Password" required></input>
						<input type="submit" class="col offset-s1 s10 block-btn" value="Sign In"></input>
						<a style="margin-top:10px" class="link col offset-s1 s10" href="signup.php">Or Sign Up</a>
						<span style="color: red; font-weight:700; display:<?php if($error==0)echo 'none'; else echo 'block';?>" class=" col offset-s1 s10"><?php echo $message; ?></span>
					</form>
				</div>
			</div>    
        </div>   
    </body>
</html>