<?php 
session_start();

	include("../connection.php");
	include("../functions.php");

	$user_data = check_login($con);

    $featured = "featured";
    $notfeat = "notfeat";

    $query_feat = "SELECT * FROM items WHERE item_status = 'A' AND keyword LIKE '%$featured%'";
    $result = mysqli_query($con, $query_feat);

    

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            background-image: url('../images/background.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <?php require("nav.php")?>
    <!-- HOME -->
    <section id="Home">
        <div class="header">
            <center><h1 class="mt-5">LADIES JOISH</h1></center>
        </div>
		<div class="container-fluid bg-warning">
            <center><h1 class="mt-5 pt-3">Featured Products</h1></center>
            <div class="row">
                <?php
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-4 shadow p-3 mb-5 rounded">
                    <img class="img" src="../images/<?php echo $row['item_img'];?>">
                    <h4><?php echo $row['item_name'];?></h4>
                    <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i> 
                    <form action="order.php" method="post">
                    <button type="button" class="btn btn-outline-info">
                        <a href="order.php?id=<?php echo $row['items_id']?>" value="1" name="item_id" class="text-decoration-none" style="color:inherit">Order</a></button>
                    </div>
                    </form>
                    <p><?php echo "P" . $row['item_price'];?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
		</div>
        <div class="row bg-light justify-content-evenly">
            <center><h1 class="mt-3">Products</h1></center>
            <?php
            while($bruh = mysqli_fetch_assoc($notres)){
                ?>
                <div class="col-3">
                <img class="img" src="../images/<?php echo $bruh['item_img'];?>">
                    <h4><?php echo $bruh['item_name'];?></h4> 
                    <button type="button" class="btn btn-outline-info">
                        <a href="order.php?id=<?php echo $bruh['items_id'];?>" class="text-decoration-none" style="color:inherit">Order</a></button>
                    <p><?php echo "P" . $bruh['item_price'];?></p> 
                </div>
                <?php
            }
            ?>
        </div>
	</section>
</body>
</html>
