<?php 
session_start();

	include("../connection.php");
	include("../functions.php");

	$user_data = check_login($con);

    function get_total_sales_multi_order($con){
        $del = 'D';
        $sql_get_sales = "SELECT sum(i.item_price * mo.quantity) sales
                             FROM `orders` mo 
                             JOIN `items` i 
                               ON mo.item_ordered = i.items_id
                            WHERE mo.order_status = '$del';
                            ";
       $sales_result = mysqli_query($con, $sql_get_sales);
       $row = mysqli_fetch_array($sales_result);
    
        return "Php ".number_format($row['sales'],2);
    }
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
    <link rel="stylesheet" href="LadiesJoish.css">
</head>
<body>
    <!-- NAVBAR -->
    <?php require("nav.php") ?>
    <!-- Sales -->
    <div class="container">
        <div class="row">
            <div class="col-6 pt-5">
                <h1>Sales: </h1><br>
                Multi Order : <?php echo get_total_sales_multi_order($con); ?> <br>
            </div>
        </div>
    </div>
</body>
</html>
