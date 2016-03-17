<?php
session_start();
if(isset($_POST['pid'])){
    $pid=$_POST['pid'];
    $wasFound=false;
    $i=0;
}
if(!isset($_SESSION['cart_array']) || cout($SESSION['cart_array']) < 1 ){
    $SESSION['cart_array'] = array(1=> array("item_id"=> $pid,"quantity"=>1));
}
else{
    foreach ($SESSION['cart_array'] as $each_item) {
        $i++;
        while(list($key,$value)=each($each_item)){
            if($key=="item_id" && $value==$pid){
                array_splice($SESSION['cart_array'],$i-1,1,array(array("item_id"=>$pid,"quantity"=>$each_item['quantity']+1)));
                $wasFound = true;
            }
        }
    }//close foreach
    if($wasFound == false){
        array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" =>1));
    }
    
}




if(isset($_GET['cmd']) && $_GET['cmd']=="emptycart"){
    unset($_SESSION['cart_array']);
}



$cartOutput = "";
if(!isset($_SESSION['cart_array']) || cout($SESSION['cart_array']) < 1 ){
    $cartOutput= "<h2>Your Cart is empty</h2>";
}
else{
    $i=0;
    foreach($SESSION['cart_array'] as $each_item) {
        $i++;
        $cartOutput = "<h2>Cart Item.$i.</h2>";
        while(list($key, $value)=each($each_item)) {
        $cartOutput=$key.":".$value."<br>";
        }
    }
    
}

$i=0;
    foreach($SESSION['cart_array'] as $each_item) {
        $i++;
        $cartOutput = "<h2>Cart Item.$i.</h2>";
        while(list($key, $value)=each($each_item)) {
        $cartOutput="key".$key.":".$value."<br>";
        }
    }
    var_dump($_SESSION);
?>
<!DOCTYPE html>
<htmL>
<head>
    <title>My Cart - Ecommerce Store</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style type="text/css">
    body{margin-top: 100px;}
    </style>
</head>
<body>
<?php include_once("header.php"); ?>
<div class="container">
    <div class="row">
    <?php echo $cartOutput; ?>
    <a href="cart.php?cmd=emptycart">empty cart</a>
    </div>
</div>
    <!-- /.container -->
    <?php include_once("footer.php"); ?>
</body>
</html>