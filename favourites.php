<?php
session_start();
$product_ids = array();


if(filter_input(INPUT_POST, 'checkout')){
    
    if($email = "" || $name = ""){
        exit();
    }else{
        print_r($name);
        //pre_r($_SESSION,$name,$email);
        exit();
    }
}



if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['favourites'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['favourites'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['favourites'] = array_values($_SESSION['favourites']);
}

//pre_r($_SESSION);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    </head>

    
    <div class = "topnav">
            <a href = "index.html"><img src = "images/logo.png" alt = "logo"></a>
            <a class = "page" href = "index.html">Home</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.php">Contact</a>
            <a class = "page" href = "menu.php">Menu</a>
            <a class = "active page" href = "favourites.php">Favourites</a>
        </div>
        

     
       
        <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="tablefave">  
            <tr><th colspan="5"><h3><b>Favourites</b></h3></th></tr>   
        <tr>  
             <th width="40%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="20%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['favourites'])):  
            
             $total = 0;  
        
             foreach($_SESSION['favourites'] as $key => $product): 
        ?>  
        <tr>  
           <td><?php echo $product['dish']; ?></td>  
           <td><?php echo $product['quantity']; ?></td>  
           <td>€ <?php echo $product['price']; ?></td>  
           <td>€ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="favourites.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="right">€ <?php echo number_format($total, 2); ?></td>  
             <td></td>  
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php 
                if (isset($_SESSION['favourites'])):
                if (count($_SESSION['favourites']) > 0):
                    ?>
                <?php include('order_valid.php'); ?>

<div class="container">  
  <form id="contact" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    
    <fieldset>
      <input placeholder="Your Email Address" type="text" name="email" value="<?= $email ?>" tabindex="3">
      <span class="error"><?= $email_error ?></span>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Checkout</button>
    </fieldset>
    <div class="success"><?= $success ?></div>
  </form>
</div>
                
                    
                    <?php endif; endif; ?>
            </td>
        </tr>
        <?php  
        endif;
        ?>  
        </table>  
         </div>
        </div>
  
</html>