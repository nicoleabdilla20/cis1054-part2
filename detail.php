<?php
session_start();
$product_ids = array();

if(filter_input(INPUT_POST, 'add_to_favourites')){
    if(isset($_SESSION['favourites'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['favourites']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['favourites'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['favourites'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'dish' => filter_input(INPUT_POST, 'dish'),
                'price' => filter_input(INPUT_POST, 'price'),
                'detail' => filter_input(INPUT_POST, 'detail'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['favourites'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['favourites'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}
?>

<html>
    <title>Products</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->

    <link rel="stylesheet" href = "css/style.css">
    <!-- <link rel="stylesheet" href="cart.css" />
    <link rel="stylesheet" href="product.css" /> -->

    <title>Korra - Menu</title>
        <meta name = "viewport" content = "width=device-width, initial scale=1">
        <meta name = "keyboards" content = "Home, Menu, Favourites, About, Contact">
        <!--stylesheet-->
        <link rel = "stylesheet" type = "text/css" href = "css/style.css">
    </head>
    <body>
	<div class = "topnav">
            <a href = "index.html"><img src = "images/logo.png" alt = "logo"></a>
            <a class = " page" href = "index.html">Home</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.php">Contact</a>
            <a class = "active page" href = "menu.php">Menu</a>
            <a class = "page" href = "favourites.php">Favourites</a>
        </div>

<?php
$connect = mysqli_connect('localhost','root','','restaurant');
if(!isset($_GET['id']) && !empty($_GET['id'])){
    print("Insert 404 here");
}else{
    $id = $_GET['id'];
    $query = "SELECT * FROM `food` WHERE `id` = '$id'";
}
$result = mysqli_query($connect, $query);

if ($result):
    if(mysqli_num_rows($result)>0):
        while($product = mysqli_fetch_assoc($result)):
        //print_r($product);
        ?>
        <div class = "food">		
		<h2><span class="food_d">Food Detail</span></h2>		
	    <div class="content">		

        <div class="c_img" >
         <img src="images/menu/<?php echo $id;?>.jpg" width="25%" alt="no image found" />
                    <h3 class="c_header"><?php echo $product['dish']; ?></h3>
        </div>
        <div class="c_det">	

            <form method="post" id=<?php echo $product['id']; ?>>
                   
                    <h4>€ <?php echo $product['price']; ?></h4>
                    <h4> <?php echo $product['detail']; ?></h4>
                    <input type="text" name="quantity" class="form-control" value="1" />
                    <input type="hidden" name="dish" value="<?php echo $product['dish']; ?>" />
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                    <input type="hidden" name="description" value="<?php echo $product['detail']; ?>" />
           
                    



                    <input type="submit" style="margin-top:10px"; name="add_to_favourites" style="margin-top:;" class="btn btn-info"
                           value="Add to Favourites";
/>
                </div>

            </form>
            </div>
            </div>

        </div>
        <?php
        endwhile;
    endif;
endif;   