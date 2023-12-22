<?php
    
session_start();
include("../connection.php");
include("../functions.php");

$user_data = check_login($con);

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * from `items` where items_id = $id";
    $sql_result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_assoc($sql_result);

    $item_ord = $row['items_id'];
    $ref = random_num();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $address = $_POST['address'];
        $quantity = $_POST['qty'];
        $user = $user_data['user_id'];

        $query = "INSERT INTO orders
                (`ref_id`,`item_ordered`,`quantity`,`user_id`,`address`)
                VALUES
                ('$ref','$item_ord','$quantity','$user','$address')";
        
        $result = mysqli_query($con, $query);

        if(!empty($result)){
            echo "Order has been placed";
        }else{
            echo "Order error";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Payout</title>
</head>
<body>
    <?php
        require("nav.php")
    ?>
    <!-- BODY -->
    <div class="container col-6 pt-5 mt-5">
        <form method="post">
            <div class="mb-3">
                <label>Address</label>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label>Quantity</label>
                <input type="text" class="form-control" name="qty">
            </div>
            <label>Mode of Payment</label>
            <input type="radio" name="radio" value="COD" class="radio" /> Cash on Delivery
			<input type="radio" name="radio" value="gcash" class="radio" /> Gcash

            <button type="submit" class="btn btn-primary">Submit</button><br>
        </form>
    </div>
</body>
</html>