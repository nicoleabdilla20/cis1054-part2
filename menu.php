<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "restaurant";

    $link = mysqli_connect("127.0.0.1", "root", "", "restaurant");
 
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?> 

<DOCTYPE html>
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
            <a class = "active page" href = "menu.php">Menu</a>
            <a class = "page" href = "favourites.html">Favourites</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.html">Contact</a>
            <a class = "page" href = "details.php"> Details</a>
            <a class = "page" href = "favourites.php"> Details</a>
        </div>
        <section class = "menu">
            <div class = "foodmenu">
                <h2>Food Menu</h2>
                <?php 
                    $sql = "SELECT* FROM food";
                    $res =mysqli_query($link, $sql);
                    $count = mysqli_num_rows($res);
                        //Display Foods  
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $ID = $row['ID'];
                                $Category = $row['Category'];
                                $Subcategory = $row['Subcategory'];
                                $Dish = $row['Dish'];
                                //$Details = $row['Details'];
                                $Price = $row['Price'];
        
                ?>
                        <div class="box">
                            <div class="displaymenu">
                                <h4></h4>
                                <p class="Category"><?php echo $Category; echo $Subcategory; ?></p>
                                <h3 class="Dish"><?php echo $Dish; ?></h3>
                                <!-- <p class="Details"><?php echo $Details; ?></p> -->
                                <p class="Price">€<?php echo $Price; ?></p>
                                <br>
                                <a href="<?php echo ""; ?>favourites.php?ID=<?php echo $ID; ?>" class="btn btn-primary">Add to Favourite</a>
                            </div>
                        </div>    
                <?php
                            }
                        }
                        else
                        {
                        //Food not Available
                        echo "<div class='Error'>Menu not found.</div>";
                    }
                ?>
            </div>
        </section>
    </body>
    </html>
</DOCTYPE>