<?php	
	require 'admin/db.php';
    $sql = "SELECT* FROM food";
    $res =mysqli_query($db, $sql);
    $count = mysqli_num_rows($res);
        //Retrieval of menu
        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $ID = $row['id'];
                $Category = $row['category'];
                $Dish = $row['dish'];
                $Price = $row['price'];
                $bfast = "";
                $main = "";
                $starter = "";
                $dessert = "";
               
                $get_recent = $db->query("SELECT * FROM food");
                if($get_recent->num_rows) {
                    while($row = $get_recent->fetch_assoc()) { 
                        //breakfast                       
                        if($row['category'] == "breakfast") {                          
                            $bfast .= "<div class='category'>                  
                                <a href='detail.php?fid=".$row['id']."'>
                                <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                <div class='detail'>
                                    <h4>".$row['dish']."</h4>                                    
                                    <p class='price'>€".$row['price']."</p>     
                                </div>
                                </a>      
                            </div>";
                        //main
                        }else if($row['category'] == "main") {
                            $main .=	"<div class='category'>
                                <a href='detail.php?fid=".$row['id']."'>
                                <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                <div class='detail'>                    
                                    <h4>".$row['dish']."</h4>
                                    <p class='price'>€".$row['price']."</p>            
                                </div>
                                </a>
                            </div>";
                        //starter
                        }else if($row['category'] == "starter") {
                            $starter .= "<div class='category'>
                                 <a href='detail.php?fid=".$row['id']."'>
                                    <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                    <div class='detail'>              
                                        <h4>".$row['dish']."</h4>
                                         <p class='price'>€".$row['price']."</p>
                                    </div>
                                    </a>
                            </div>";
                        //dessert        
                        }else if($row['category'] == "dessert") {
                            $dessert .= "<div class='category'>
                                <a href='detail.php?fid=".$row['id']."'>
                                <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                <div class='detail'>
                                    <h4>".$row['dish']."</h4>
                                    <p class='price'>€".$row['price']."</p>
                                </div>
                                </a>
                            </div>";
                        }                       
                    }
                }else{}
            }
        }
?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Korra - Menu</title>
        <meta name = "viewport" content = "width=device-width, initial scale=1">
        <meta name = "keyboards" content = "Home, Reservation, Menu, Details, Favourites, About, Contact">
        <!--stylesheet-->
        <link rel = "stylesheet" type = "text/css" href = "css/style.css">
    </head>
    <body>
        <div class = "topnav">
            <a href = "index.html"><img src = "images/logo.png" alt = "logo"></a>
            <a class = " page" href = "index.html">Home</a>
            <a class = "active page" href = "menu.php">Menu</a>
            <a class = "page" href = "details.php">Details</a>
            <a class = "page" href = "favourites.php">Favourites</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.html">Contact</a>
        </div>
        <div class = "menu">
                <h2>Food Menu</h2>
                <div class="menu_content">	
                    <h1>Breakfast</h1>	
			        <?php echo ($bfast == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $bfast; ?>		
			   
                <br>
                <div class="menu_content">	
                <h1>Starter</h1>		
			        <?php echo ($starter == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $starter; ?>			
			       	
		         </div>
                <br>
                 <div class="menu_content">
                 <h1>Main Course</h1>
			        <?php echo ($main == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $main; ?>
			
                 </div>
                 <br>
                 <div class="menu_content">
                 <h1>Dessert</h1>
			<?php echo ($dessert == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $dessert; ?>
                </div>
        </div>
    </body>
    </html>
