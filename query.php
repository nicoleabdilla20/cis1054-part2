<?php 
	
	require "admin/db.php";	
	//For Reservation
	$m = "";	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if(isset($_POST['submit'])) {			
			$Person = htmlentities($_POST['Person'], ENT_QUOTES, 'UTF-8');
			$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
			$phone = preg_replace("#[^0-9]#", "", $_POST['phone']);
			$complaint = htmlentities($_POST['complaint'], ENT_QUOTES, 'UTF-8');			
			if($Person != "" && $email && $phone != "" && $complaint != "") {			
				$check = $db->query("SELECT * FROM query WHERE c_name='".$Person."' AND c_email='".$email."' AND c_phone='".$phone."' LIMIT 50");			
				if($check-> num_rows) {			
					$m = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>You have already placed a reservation with the same information</p>";		
				}else{			
					$insert = $db->query("INSERT INTO query(c_name, c_email, c_phone, complaint) VALUES('".$Person."', '".$email."', '".$phone."', '".$complaint."')");				
					if($insert) {					
						$ins_q_id = $db->insert_id;						
						$reserve_code = "AUTO_INCREMENT_$ins_q_id".substr($phone, 3, 8);					
						$m = "<p style='padding: 15px; color: green; background: #eeffee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Reservation placed successfully. Your reservation code is $reserve_code. Please Note that reservation expires after one hour</p>";				
					}else{						
						$m = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Could not place reservation. Please try again</p>";						
					}				
				}				
			}else{				
				$m = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Incomplete form data or Invalid data type</p>";				
				print_r($_POST);				
			}			
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
            <a class = "active page" href = "reservation.php">Reservation</a>
            <a class = " page" href = "menu.php">Menu</a>
            <a class = "page" href = "details.php">Details</a>
            <a class = "page" href = "favourites.php">Favourites</a>
            <a class = "page" href = "about.html">About</a>
            <a class = "page" href = "contact.html">Contact</a>
        </div>

<div class="content">
	<div class="res_content">		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="booking">			
			<h2 class="f_b"><span class="icon">Query and Complaints</span></h2>
			<p class="f_m">Send us a query to improve our service</p>			
			<?php echo "<br/>".$m; ?>		
			<div class="box">			
				<div class="input">					 
					 <label>Name</label>
					<input type="text" placeholder="Name" name="Person" id="Person" required>				
				</div>			
				<div class="input">					
					<label>Email</label>
					<input type="email" name="email" placeholder="Enter your email" required>					
				</div>				
				<div class="input">				
					<label>Phone Number</label>
					<input type="number" name="phone" placeholder="Enter your phone number" required>					
				</div>							
			</div>			
			<div class="box">			
				<div class="input">					
                    <label>Complaint </label>
					<textarea name="complaint" placeholder="Enter additional information!" required></textarea>					
				</div>			
				<div class="input">				
					<input type="submit" class="submit" name="submit" value="Book Now" />					
				</div>				
			</div>	
		</form>		
	</div>	
</div>	
</div>	
</body>
</html>