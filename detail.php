<?php 
	session_start();
	require 'admin/db.php';
	$dish = "";
	$detail = "";
	$category = "";
	$price = "";
	$id = "";
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
		if(isset($_GET['fid']) && preg_replace("#[^0-9]#", "", $_GET['fid']) != "") {
			$fid = preg_replace("#[^0-9]#", "", $_GET['fid']);
			if($fid != "") {
				$get_detail = $db->query("SELECT * FROM food WHERE id='".$fid."' LIMIT 50");				
                if($get_detail->num_rows) {				
					while($row = $get_detail->fetch_assoc()) {						
						$id = $row['id'];
						$dish = $row['dish'];
						$detail = $row['detail'];
						$category  = $row['category'];
						$price  = $row['price'];            					
					}	
				}else{					
				}
			}			
		}else{
            echo $twig->render('404.html');
		}
	}
    elseif($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if(isset($_POST['submit'])) {			
			$id = preg_replace("#[^0-9]#", "", $_POST['fid']);
			header("location: favourites.php?fid=".$id."");	
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
            <a class = "page" href = "index.html">Home</a>
            <a class = "page" href = "menu.php">Menu</a>
            <a class = "active page" href = "detail.php">Menu</a>
            <a class = "page" href = "favourites.php">Favourites</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.html">Contact</a>
        </div>

    <div class = "food">		
		<h2><span class="food_d">Food Detail</span></h2>		
	    <div class="content">		
				<div class="c_img">
					<img src="images/menu/<?php echo $id;?>.jpg" width="25%" alt="no image found" />				
				</div>			
				<div class="c_det">					
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
