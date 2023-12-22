<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $notfeat = "notfeat";

    $query = "SELECT * FROM items WHERE item_status = 'A' AND keyword LIKE '%$notfeat%'";
    $notres = mysqli_query($con, $query);

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <title>Ladies' Joish</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .img{
            width: 100%;
            border-radius: 15%;
        }
        .row{
            margin-left: 25px;
            margin-right: 25px;
            margin-top: 25px;
        }
        body{
            background-image: url('images/background.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <?php require("nav.php");?>
    <!-- HOME -->
	<section id="Home">
		<div class="container-fluid">
        <div class="row bg-light justify-content-evenly">
            <center><h1 class="mt-3">Products</h1></center>
            <?php
            while($bruh = mysqli_fetch_assoc($notres)){
                ?>
                <div class="col-3">
                <img class="img" src="images/<?php echo $bruh['item_img'];?>">
                    <h4><?php echo $bruh['item_name'];?></h4> 
                    <button type="button" class="btn btn-outline-info">
                        <a href="signup.php" class="text-decoration-none" style="color:inherit">Order</a></button>
                    <p><?php echo "P" . $bruh['item_price'];?></p> 
                </div>
                <?php
            }
            ?>
        </div>
		</div>
	</section>
</body>
</html>
