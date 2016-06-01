<?php
require('./connect.inc.php');
session_start();
$error=0;
$message="";
$name="";
$email="";

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	header('Location: index.php');
}
else
{
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password']))
	{
		if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['re_password']))
		{
			$name=mysql_real_escape_string($_POST['name']);
			$email=mysql_real_escape_string($_POST['email']);
			$password=md5($_POST['password']);
			$re_password=md5($_POST['re_password']);
			
			if($password==$re_password)
			{
				$query1="SELECT * FROM `users` WHERE `email`='$email'";
				$run1=mysqli_query($con,$query1);
				$num1=mysqli_num_rows($run1);
				
				if($num1==0)
				{
					$query2="INSERT INTO `users` VALUES('','$name','$email','$password')";
					$run2=mysqli_query($con,$query2);
					$last_id=mysqli_insert_id($con);
					$_SESSION['user_id']=$last_id;
					header('Location: index.php');
				}
				else
				{
					//Email Exists
					$error=1;
					$message="E-mail already Exists.";
				}
			}
			else
			{
				//Passwords Dont Match
				$error=1;
				$message="Passwords do not match.";
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
					<h2>Sign Up</h2>
				</div>
				<div class="row">
					<form id="signup_form" method="post" action="signup.php" autocomplete="off">
						<input style="display:none" type="text" ></input>
						<input style="display:none" type="password"></input>
						<input id="name" class="col offset-s1 s10 block-inp" name="name" type="text" value="<?php echo $name;?>" name="firstname" placeholder="Name" required></input>
						<input id="email" class="col offset-s1 s10 block-inp" name="email" value="<?php echo $email;?>" type="text" placeholder="E-mail" required></input>
						<input id="password" class="col offset-s1 s10 block-inp" name="password" type="password" placeholder="Password" required></input>
						<input id="re_password" class="col offset-s1 s10 block-inp" name="re_password" type="password" placeholder="Re-Enter Password" required></input>
						<input type="submit" class="col offset-s1 s10 block-btn" value="Sign Up"></input>
						<a style="margin-top:10px" class="link col offset-s1 s10" href="signin.php">Or Sign In</a>
					</form>
					<span style="color: red; font-weight:700; display:<?php if($error==0)echo 'none'; else echo 'block';?>" class=" col offset-s1 s10"><?php echo $message; ?></span>
				</div>
			</div>    
        </div>   
    </body>
</html>