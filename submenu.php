
<html>
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="cart.css" />
    <link rel="stylesheet" href="submenu.css" />


<div class="topnav">
    <img class="logo" src="logo.png">
    <a href="home.php">Home</a>
    <a href="submenu.php?category=Costumes">Costumes</a>
    <a href="submenu.php?category=Partyware">Partyware</a>
    <a href="submenu.php?category=Balloons">Balloons</a>
    <a href="submenu.php?category=Cards">Cards</a>
    <div class="cart">
        <a href="Cart.php">
        <img class="shoppingcart" src="cart3.png" >
      </a>
        
    </div>

    
</div>

<form action="submenu.php" method="GET",style="display:inline;" >

    <input type="text" placeholder="Search products..." name="prodname"/>
    <input type="submit" value="Search",style="  background-color:rgb(138, 9, 9);
"/>
</form>
<?php
$connect = mysqli_connect('localhost','root','','cart');
if(!isset($_GET['category']) && empty($_GET['prodname'])){
    $query = "SELECT * FROM products ORDER by id ASC";
}else if(isset($_GET['category'])){
    $category = $_GET['category'];
    $query = "SELECT * FROM `products` WHERE `category` =  '$category'";
}else{
    $prodname = $_GET['prodname'];
    $query = "SELECT * FROM `products` WHERE `name` LIKE '%$prodname%' OR `description` LIKE '%$prodname%'";
}
$result = mysqli_query($connect, $query);

if ($result):
    if(mysqli_num_rows($result)>0):
        while($product = mysqli_fetch_assoc($result)):
        //print_r($product);
        ?>
        <div class="col-sm-4 col-md-3" >
            <form method="GET" action="product.php">
                <div class="products">
                    <img src="<?php echo $product['image']; ?>"style="height:40% !important;
    width:50% !important;" class="img-responsive" />
                    <h4 class="text-info"><?php echo $product['name']; ?></h4>
                    <h4>€ <?php echo $product['price']; ?></h4>

                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
                    <input type="submit" style="margin-top:5px;" class="btn btn-info" value="View Details" />
                </div>
            </form>
        </div>
        <?php
        endwhile;
    endif;
endif;   
?>