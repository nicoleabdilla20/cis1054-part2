<?php	
    require "admin/db.php";	
?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Korra - Menu</title>
        <meta name = "viewport" content = "width=device-width, initial scale=1">
        <meta name = "keyboards" content = "Home, Menu, Favourites, About, Contact">
        <script src="button.js"></script>

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
        <div class = "contact">
                <h2>Contact Forms</h2>           
                <button id="reservation" class = "bt" onclick ="reservation()">Book a Reservation<p>Press Here</p></button>
                <button id="query" class="bt" onclick = "query()">Complaints & Queries <p>Press Here</p></button>              
        </div>
    </body>
    </html>
