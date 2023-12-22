<?php 
session_start();

	include("../connection.php");
	include("../functions.php");

	$user_data = check_login($con);

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
    <!-- MANAGE ORDERS -->
    <section id="Home">
		<div class="container-fluid">

            <!-- PENDING ORDER -->
            
            <div class="col-4 mt-5"><h1>Pending Orders:</h1><br>
                <?php
                    $user_id = $_SESSION['user_id'];
                    $stat = "P";
                    $sql_get_reference = "SELECT DISTINCT mo.ref_id
                                                        , u.user_name
                                                        , mo.address
                                                     from `orders` mo
                                                     join `users` u
                                                       on mo.user_id = u.user_id
                                                    where mo.order_status = '$stat'
                                                      and mo.user_id = $user_id";
                    $reference_result = mysqli_query($con, $sql_get_reference);

                    while($row = mysqli_fetch_assoc($reference_result)){ 
                                         
                        $ord_ref_num = $row['ref_id'];
                        $user = $row['user_name'];
                        $address = $row['address'];
                        
                        echo "<em>".$ord_ref_num."</em> - <a>".$user."</a> <br>" ;
                        echo "<small>".$address."</small>" ;
                        $sql_get_ingredient = "SELECT i.item_name
                                                    , i.item_price
                                                    , i.item_desc
                                                 from `orders` mo
                                                 JOIN `items` i
                                                   ON mo.item_ordered = i.items_id
                                                where mo.ref_id = '$ord_ref_num'";
                        $ingredient_result = mysqli_query($con,$sql_get_ingredient);

                        echo "<ul>";
                        while($ing = mysqli_fetch_assoc($ingredient_result)){
                            echo "<li>" . $ing['item_name'] . "(". $ing['item_price'] .")" . "</li>";
                        }
                        echo "</ul>";  ?>
                    <a href="update_order.php?update_order_status=X&ref_id=<?php echo $ord_ref_num;?>" class="btn btn-danger btn-sm">Cancel</a> <hr>
                    <?php } 
                ?>
            </div>
            
           
            
            <!-- CANCELLED ORDERS -->

            <div class="col-4 mt-5"><h1>Cancelled Orders:</h1>
                <?php
                    $sql_get_reference = "SELECT DISTINCT `ref_id` from `orders` where order_status = 'X' and user_id = $user_id";
                    $reference_result = mysqli_query($con, $sql_get_reference);
                                     
                    while($row = mysqli_fetch_assoc($reference_result)){ 
                                         
                        $ord_ref_num = $row['ref_id'];
                        echo "<em>".$ord_ref_num."</em>" . "<br>";
                        $sql_get_ingredient = "SELECT i.item_name
                                                    , i.item_price
                                                    , i.item_desc
                                                 from `orders` mo
                                                 JOIN `items` i
                                                   ON mo.item_ordered = i.items_id
                                                where mo.ref_id = '$ord_ref_num'";
                        $ingredient_result = mysqli_query($con,$sql_get_ingredient);
                                         
                        echo "<ul>";
                        while($ing = mysqli_fetch_assoc($ingredient_result)){
                            echo "<li>" . $ing['item_name'] . "(". $ing['item_price'] .")" . "</li>";
                        }
                        echo "</ul>";
                                         
                    } 
                ?>
            </div>
		</div>
    </section>
</body>
</html>

