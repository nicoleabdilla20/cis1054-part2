<!-- Made by Nicole Abdilla @nicoleabdilla20 -->
<?php
	session_start();
    require_once __DIR__.'/bootstrap.php';
	require 'admin/db.php';
    $sql = "SELECT* FROM food"; //food is a table from restaurant database
    $res = mysqli_query($db, $sql);
    $count = mysqli_num_rows($res); //returns number of rows 
        //Retrieval of menu
        if($count>0) //will loop until it has gone through all the rows in the table
        {
            while($row=mysqli_fetch_assoc($res))
            {
                //the below are variables storing content of the current row no. in the table
                $ID = $row['id'];
                $Category = $row['category'];
                $Dish = $row['dish'];
                $Price = $row['price'];
                $bfast = "";
                $main = "";
                $starter = "";
                $dessert = "";
                $get_recent = $db->query("SELECT * FROM food"); // -> is used to obtain a method and the properties of an object
                if($get_recent->num_rows) { //get_recent is a variable to get the current items according to $count 
                    while($row = $get_recent->fetch_assoc()) { 
                        //BreakFast - the below is the outputting process of the data in the table                       
                        if($row['category'] == "breakfast") {  //.= is a concatenation assignment, type of string operator                    
                            $bfast .= "<div class='category'>              
							<a href='detail.php?fid=".$row['id']."'>
                                <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                <div class='menu'>
                                    <h4>".$row['dish']."</h4>                                    
                                    <p class='price'>€".$row['price']."</p>     
                                </div>
                                </a>      
                            </div>";
                        //Main  - the below is the outputting process of the data in the table  
                        }else if($row['category'] == "main") {
                            $main .=	"<div class='category'>
							<a href='detail.php?fid=".$row['id']."'>
                                <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                <div class='menu'>                    
                                    <h4>".$row['dish']."</h4>
                                    <p class='price'>€".$row['price']."</p>            
                                </div>
                            </a>
                            </div>";
                        //Starter - the below is the outputting process of the data in the table  
                        }else if($row['category'] == "starter") {
                            $starter .= "<div class='category'>
							<a href='detail.php?fid=".$row['id']."'>
                                    <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                    <div class='menu'>              
                                        <h4>".$row['dish']."</h4>
                                         <p class='price'>€".$row['price']."</p>oi
                                    </div>
                                </a>
                            </div>";
                        //Dessert - the below is the outputting process of the data in the table        
                        }else if($row['category'] == "dessert") {
                            $dessert .= "<div class='category'>
							<a href='detail.php?fid=".$row['id']."'>
                                <img src='images/menu/".$row['id'].".jpg' width='80px' height='80px' /> 
                                <div class='menu'>
                                    <h4>".$row['dish']."</h4>
                                    <p class='price'>€".$row['price']."</p>
                                </div>
                            </a>
                            </div>";
                        }     
                    }
                }else{
                    //condition: when the if loop meets an error output 404.html
                    echo $twig->render('404.html');
                }
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
        <div class = "title">
                <h2>Food Menu</h2>
                <h3>Press on the food item for more detail</h3>
        </div>
        <div class="sec">
            <div class="menu_content">	
                <h1>Breakfast</h1>	<!--I am aware that in text css is not best practice but did not how I could apply css to php in another way. -->
			    <?php echo ($bfast == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $bfast; ?>		
                <p class="rmv"></p> <!-- the css of this does not allow elements to float on both sides. -->
            </div>
        </div>
        <div class="sec">
            <div class="menu_content">	
                <h1>Starter</h1>		
                <?php echo ($starter == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $starter; ?>			
                <p class="rmv"></p>
            </div>
        </div>
        <div class="sec">
            <div class="menu_content">
                <h1>Main Course</h1>
                <?php echo ($main == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $main; ?>
                <p class="rmv"></p>
            </div>
        </div>
        <div class="sec">
            <div class="menu_content">
                <h1>Dessert</h1>
                <?php echo ($dessert == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your favourite list is empty</h3>" : $dessert; ?>
                <p class="rmv"></p>
            </div>
        </div>
    </body>
</html>