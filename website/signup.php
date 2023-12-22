<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$fullname = $_POST['full_name'];
		$username = $_POST['user_name'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$monum = $_POST['mobile_number'];
		$password = $_POST['password'];
		$confpass = $_POST['confpass'];
		$gender = $_POST['radio'];

		if($password == $confpass){
			if(!empty($fullname) && !empty($password) && !empty($confpass) && !empty($gender) && !is_numeric($user_name))
			{

				//save to database
				$user_id = random_num();
				$query = "INSERT INTO users
						  (`user_id`, `full_name`, `user_name`, `address`, `email`, `mobile_number`, `password`, `gender`)
						  VALUES
						  ('$user_id', '$fullname', '$username', '$address', '$email', '$monum', '$password', '$gender')";

				mysqli_query($con, $query);

				header("Location: login.php");
				die;
			}else
			{
				echo "Please enter some valid information!";
			}
		}else{
			echo "Password does not match";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

	<style type="text/css">
	
	#text{
		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{
		padding: 10px;
		width: 100px;
		color: white;
		background-color: #008080;
		border: none;
	}

	#box{
		background-color: rgba(500, 500, 500, 0.4);
		margin: auto;
		width: 500px;
		padding: 20px;
		margin-top: 5px;
		border-radius: 30px;
	}
	body{
		background-image: url('images/grop.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
	}

	</style>

	<div id="box">
		<form method="post">
			<div style="font-size: 50px;margin: 10px;color: black;">Signup</div>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="user_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="mobile_number">
            </div>
			<div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
			<div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confpass">
            </div>
            <label>Gender:</label>
            <input type="radio" name="radio" value="male" class="radio" /> Male
			<input type="radio" name="radio" value="female" class="radio" /> Female
			<input type="radio" name="radio" value="other" class="radio" /> Other
            <button type="submit" class="btn btn-primary">Submit</button><br>
			<a href="login.php">Click to Login</a>
        </form>
	</div>
</body>
</html>