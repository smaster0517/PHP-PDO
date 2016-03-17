<?php
if(isset($_GET['id'])){
    $id = preg_replace('#[^0-9]#i', '',$_GET['id']);
}
else{
    echo "no such product exist";
    exit();
    $dbh = null;
}
include "connect_to_mysql_pdo.php";
$dynamic_list = "";
    $res = $dbh->prepare("SELECT * FROM products LIMIT 10");
    $res->execute();
    $productCount = $res->rowCount();
    if ($productCount > 0) {
        while ($row = $res->fetch()) {
            $product_id = $row['id'];
            $product_name = $row['product_name'];
            $product_price = $row['price'];
            $product_cat = $row['category'];
            $product_subcat = $row['subcategory'];
            $product_details = $row['details'];
            $check = $product_details;
            if (strlen(trim($check)) == 0){
                $product_details = "<u>No Details</u>";
            }
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
            $dynamic_list .= '
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="inventory_images/'.$product_id.'.jpg" alt="">
                    <div class="caption">
                        <h4 class="pull-right">Rs.'.$product_price.'</h4>
                        <h4><a href="product.php?id='.$product_id.'">'.$product_name.'</a>
                        </h4>
                        <p>'.$product_details.'</p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">'.$date_added.'</p>
                         <p>'.$product_cat.' > '.$product_subcat.'</p>
                    </div>
                </div>
            </div>';
        }
    }
    else {
        $dynamic_list = "We have no products listed here.";
    }
    $dbh = null;
?>
<!DOCTYPE html>
<htmL>
<head>
    <title>PHP Pagination</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style type="text/css">
    .thumbnail img{
        width: 100%;
    }
    .ratings {
    padding-right: 10px;
    padding-left: 10px;
    color: #d17581;
    }
    </style>
</head>
<body>
<?php include_once("header.php"); ?>
<div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="thumbnail">
                    <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="#">Product Name</a>
                        </h4>
                        <p>See more snippets like these online store reviews at <a target="_blank" href="http://bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                        <p>Want to make these reviews work? Check out
                            <strong><a href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this building a review system tutorial</a>
                            </strong>over at maxoffsky.com!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">3 reviews</p>
                        <p>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            4.0 stars
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container -->
    <?php include_once("footer.php"); ?>
</body>
</html>