<?php
session_start();

include("../connection.php");
include("../functions.php");

$user_data = check_login($con);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php require("nav.php")?>
    <!-- BODY -->
    <div class="container pt-5">
        <a href="Item_list.php">Show Items List</a>
        <form method="post" action="upload.php" class="m-5" enctype="multipart/form-data">
            <h1>Add Item:</h1>
            <div class="mb-3">
                <label for="">Item Name</label>
                <input type="text" class="form-control" name="item_name">
            </div>
            <div class="mb-3">
                <label for="">Item Description</label>
                <textarea type="text" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
                <label for="">Item Price</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Item Search Keywords</label>
                <textarea type="text" name="keyword" cols="30" rows="10"></textarea>
            </div>
            Select image to upload:
            <input type="file" name="image" id="image"/>
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </div>
</body>
</html>