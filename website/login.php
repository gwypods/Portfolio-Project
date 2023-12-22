<?php
session_start();

    include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";

			$result = mysqli_query($con, $query);

            if($result){
                if($result && mysqli_num_rows($result) > 0)
                {

                    $user_data = mysqli_fetch_assoc($result);
                    
                    switch($user_data['user_type']){
                        case 'A':
                            if($user_data['password'] === $password){
                        
                                $_SESSION['user_id'] = $user_data['user_id'];
                                header("Location: admin/index.php");
                                die;
                            }
                            break;
                        case 'U':
                            if($user_data['password'] === $password){
                        
                                $_SESSION['user_id'] = $user_data['user_id'];
                                header("Location: user/index.php");
                                die;
                            }
                            break;
                        default:
                            echo "Invalid user type";
                            break;

                    }
                
                }
            }
            echo "Wrong username or password";
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/style.css"> -->
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
            width: 300px;
            padding: 20px;
            margin-top: 150px;
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
            <div style="font-size: 50px; margin: 10px; color: black;">Login</div>
            Username <input id="text" type="text" name="user_name"><br><br>
            Password <br><input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>
            
        </form>
            <a href="signup.php">Click to Sign up</a><br><br>
            <a href="index.php">Sign in as Guest</a><br><br>
    </div>
</body>
</html>