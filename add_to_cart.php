<?php

    session_start();

 

    include 'bootstrap.php';

 
    $connection = new mysqli("localhost", "root", "", "task3");

    $product_id = $_GET['id'];

    // echo $product_id;

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

 

        $productQuery = "SELECT p.*, v.name AS vendor_name FROM products p
                 JOIN vendors v ON p.vendor_id = v.vendor_id
                 WHERE p.product_id = $product_id";
$productResult = mysqli_query($connection, $productQuery);

// Check for errors in query execution
if (!$productResult) {
    die("Query failed: " . mysqli_error($connection));
}

        if($productResult->num_rows > 0){

            while($row=$productResult->fetch_assoc()) {

                $id = $row['id'];

                $vendor_id = $row['vendor_id'];

                $product_name = $row['product_name'];

                $description = $row['description'];

                $sku = $row['sku'];

                $price = $row['price'];

                $stock_quantity = $row['stock_quantity'];

            }

          }

 

        $check_query = "SELECT COUNT(*) as count FROM cart WHERE vendor_id = '$vendor_id'";

        $check_result = mysqli_query($connection, $check_query);

        $row_count = mysqli_fetch_assoc($check_result)['count'];

        if ($row_count === "0") {

 

        $sql = "INSERT INTO cart (product_name, description, sku, price, stock_quantity, vendor_id) VALUES ('$product_name', '$description', '$sku', '$price', '$stock_quantity', '$vendor_id')";

 

        $result = $connection->query($sql);

        if($result == TRUE){

            //$id = $_SESSION['id'];

            //echo $id;

            echo "Added to cart succesfully.";

            //header('Location: customer.php');

            //echo "New record created successfully";

            //exit();

        }

        } else {

            echo "Already added in the cart.";

        }

        $connection->close();

    }

?>

 

<!DOCTYPE html>

<html>

    <p><a href="customer.php">Back to Dashboard</a></p>

</html>