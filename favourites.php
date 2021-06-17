<DOCTYPE html>
    <html>

    <head>
        <title>Korra - Favourites</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <meta name="keyboards" content="Home, Menu, Favourites, About, Contact">

        <!--stylesheet-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>


    <body>
        <div class = "topnav">
            <a href = "index.html"><img src = "images/logo.png" alt = "logo"></a>
            <a class = " page" href = "index.html">Home</a>
            <a class = "page" href = "menu.html">Menu</a>
            <a class = "active page" href = "favourites.html">Favourites</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.html">Contact</a>
        </div>
    </body>
    </html>
<?php

$userId = $_SESSION['userID'];

require_once __DIR__.'/bootstrap.php';
require 'admin/db.php';


if(isset($_POST['favourites'])){
        include 'admin/db.php';
        $itemId = $_GET['item'];
        'deleteFavourite'($itemId,$_SESSION['userID']);
        $_POST['favourites'] = null;
    
}


if (isset($conn)) {

    $sql = "SELECT * FROM favourites WHERE UserId  = '$userId'";
    $result = $conn->query($sql);

    $items = array();
    $counter = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itemId = $row['ItemId'];
            $sqlItems = "SELECT * FROM item WHERE ItemId  = '$itemId'";
            $resultItems = $conn->query($sqlItems);

            if ($resultItems->num_rows > 0) {
                while ($rowItem = $resultItems->fetch_assoc()) {
                    $image = base64_encode($rowItem['ItemImage']);
                    $items[$counter] = array('ItemId' => $rowItem['ItemId'], 'ItemName' => $rowItem['ItemName'],
                        'ItemImage' => $image, 'CategoryId' => $rowItem['CategoryId']);
                }
            }
            $counter++;
        }
    }
    $conn->close();

    echo $twig->render('favourites.html',
        ['items' => $items , 'userId' => $userId]);
       
} else {
        echo 'ERROR';
}
?>


