
<?php

session_start();
include 'bootstrap.php';
$connection = new mysqli("localhost", "root", "", "task3");

?>


<!DOCTYPE html>
<html>
<head>
    <title>View Cart</title>
    
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
            <a type="submit" style="margin-left: 1050px;" href="customer.php">Back to Product Details</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cart Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th>serial No</th>
                                    <th>Vendor ID</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                $sql = "SELECT * FROM cart";

                $result = mysqli_query($connection, $sql);

                    if($result->num_rows > 0){

                        while($productRow = $result->fetch_assoc()){
?>

                                <tr>
                                    <td><?php echo $productRow['id']; ?></td>
                                    <td><?php echo $productRow['vendor_id']; ?></td>
                                    <td><?php echo $productRow['product_name']; ?></td>
                                    <td><?php echo $productRow['description']; ?></td>
                                    <td><?php echo $productRow['sku']; ?></td>
                                    <td><?php echo $productRow['price']; ?></td>
                                    <td><?php echo $productRow['stock_quantity']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <a href="edit_product.php?id=<?php echo $productRow['product_id']; ?>" class="btn btn-action edit btn-sm">Edit</a> -->
                                            <!-- <a href="?delete=<?php echo $productRow['product_id']; ?>&confirm=yes" class="btn btn-danger btn-sm" onclick="return confirmDelete('<?php echo $productRow['product_name']; ?>')">Delete</a> -->

                                            <!-- <a href="delete_product.php?id=<?php echo $productRow['product_id']; ?>" class="btn btn-danger edit btn-sm">Delete</a> -->
                                            <a class="btn btn-danger" type="submit" name="submit" value="submit" href="delete_cart.php?id=<?php echo $productRow['id']; ?>">Delete from Cart</a>
                                            <!-- <a href="?delete=<?php echo $productRow['product_id']; ?>&confirm=yes" class="btn btn-danger btn-sm" onclick="return confirmDelete('<?php echo $productRow['product_name']; ?>')">Delete</a> -->
                                        </div>
                                    </td>
                                </tr>

                            <?php

                    }

                }

                ?>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</body>
</html>