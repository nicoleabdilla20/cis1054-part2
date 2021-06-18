<DOCTYPE html>
    <html>

    <head>
        <title>Korra - Home</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <meta name="keyboards" content="Home, Menu, Favourites, About, Contact">

        <!--stylesheet-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>


    <body>
        <div class = "topnav">
            <a href = "index.html"><img src = "images/logo.png" alt = "logo"></a>
            <a class = "active page" href = "index.html">Home</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.php">Contact</a>
            <a class = "page" href = "menu.php">Menu</a>
            <a class = "page" href = "favourites.php">Favourites</a>
        </div>

      
        <div class = "slider">
           <img class = "mySlides" img src = "images/interior.jpg" alt = "Interior">
           <img class = "mySlides" img src = "images/friends.jpg" alt = "Friends">
           <img class = "mySlides" img src = "images/pizza.jpg" alt = "Pizza"> 
           <img class = "mySlides" img src = "images/pasta.jpg" alt = "Pasta">
        </div>

        <script>
            var slideIndex = 0;
            carousel();

            function carousel(){
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i=0; i<x.length; i++){
                    x[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > x.length) {slideIndex = 1}
                x[slideIndex-1].style.display = "block";
                // time set for each slide
                setTimeout (carousel, 5000)
            }
        </script>
        </body>

        <footer>
        <div class="foot">         
            <p> 
                <table class="texttable">
                    <tr>
                        <th>
                            <img src="images/openinghours.png" alt="picture of clock" height=100px>
                        </th>
                        <th>
                            <img src="images/email.png" alt="picture of mail" height="100px">   
                        </th>
                        <th>
                            <img src="images/phone.png" alt="picture of phone" height="100px">  
                        </th>
                    </tr>
                <tr>
                        <td>
                         Opening Hours:
                        <br>
                        Monday - Thursday    2:00&ndash;23:00
                         <br>
                         Friday - Sunday      12:00&ndash;00:00
                        </td>    

                    <td>
                        Email:
                        <br>
                        korra.restaurant@gmail.com
                    </td>

                    <td>
                        Phone:
                        <br>
                        +35621630673
                    </td>
                </tr>
                </table>
            </p>
              </div>
        </footer>
    </html>
</DOCTYPE>