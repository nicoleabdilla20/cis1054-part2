<!-- Made by Nicole Abdilla @nicoleabdilla20 -->
<?php 
	session_start();
	require_once __DIR__.'/bootstrap.php';
	require 'admin/db.php';
	//initializing the variables
	$dish = "";
	$detail = "";
	$category = "";
	$price = "";
	$id = "";
	//In the below fid will sotre the chosen item from the menu
    if($_SERVER['REQUEST_METHOD'] == 'GET') { // preg_replace - is a regular expression to search and replace
		if(isset($_GET['fid']) && preg_replace("#[^0-9]#", "", $_GET['fid']) != "") { // the [^0-9] is to find a character that is not a digit
			$fid = preg_replace("#[^0-9]#", "", $_GET['fid']); 
			if($fid != "") {
				$get_detail = $db->query("SELECT * FROM food WHERE id='".$fid."' LIMIT 1");		//limit one means only one item 		
                if($get_detail->num_rows) {				
					while($row = $get_detail->fetch_assoc()) {
						//getting the data of the chosen item into the vairbales to be further outputted at a later stage in the html						
						$id = $row['id'];
						$dish = $row['dish'];
						$detail = $row['detail'];
						$category  = $row['category'];
						$price  = $row['price'];            					
					}	
				}else{	
					echo $twig->render('404.html');
				}
			}			
		}else{
            echo $twig->render('404.html');
		}
	}
    elseif($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if(isset($_POST['submit'])) {		
			$id = preg_replace("#[^0-9]#", "", $_POST['fid']);
			header("location: favourites.php?fid=".$id."");	 //function header() is used to send a raw HTTP header. 
		}	
	}
?>
<!DOCTYPE html>
    <html>
    <head>
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
    <div class = "food">		
		<h2><span class="food_d">Food Detail</span></h2>		
	    <div class="content">		
				<div class="c_img">
					<!-- The image are named with numbers so the program finds the image that matches the id of item-->
					<img src="images/menu/<?php echo $id;?>.jpg" width="25%" alt="no image found" />				
				</div>			
				<div class="c_det">	
					<!-- The below is the outputting of the item details-->				
					<form class="" method="post" action="d.php">	
						<h3 class="c_header"><?php echo $dish; ?></h3>
						<p class="c_det"><?php echo $detail; ?> </p>
						<p><span class="c_cat">Category:</span> <?php echo $category; ?></p>
						<p><span class="c_price">Price:</span> €<span id="price"><?php echo $price; ?></span></p>								
						<div class="btn">
							<input type="hidden" name="fid" value="<?php echo $id; ?>">
							<input type="submit" name="submit" class="submit add_fav" value="Add to Favourites" />							
						</div>
					</form>					
				</div>
        </div>
    </div>
</body>
</html>