<?php 
	
	require "admin/db.php";	
	//reservation
	$msg = "";	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if(isset($_POST['submit'])) {			
			$People = preg_replace("#[^0-9]#", "", $_POST['People']);
			$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
			$phone = preg_replace("#[^0-9]#", "", $_POST['phone']);
			$date = htmlentities($_POST['date'], ENT_QUOTES, 'UTF-8');
			$time = htmlentities($_POST['time'], ENT_QUOTES, 'UTF-8');
			$suggestions = htmlentities($_POST['suggestions'], ENT_QUOTES, 'UTF-8');			
			if($People != "" && $email && $phone != "" && $date != "" && $time != "" && $suggestions != "") {			
				$check = $db->query("SELECT * FROM reservation WHERE num_ppl='".$People."' AND email='".$email."' AND phone='".$phone."' AND date='".$date."' AND time='".$time."' LIMIT 50");			
				if($check-> num_rows) {			
					$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>You have already placed a reservation with the same information</p>";		
				}else{			
					$insert = $db->query("INSERT INTO reservation(num_ppl, email, phone, date, time, suggestions) VALUES('".$People."', '".$email."', '".$phone."', '".$date."', '".$time."', '".$suggestions."')");				
					if($insert) {					
						$ins_id = $db->insert_id;						
						$reserve_code = "AUTO_INCREMENT_$ins_id".substr($phone, 3, 8);					
						$msg = "<p style='padding: 15px; color: green; background: #eeffee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Reservation placed successfully. Your reservation code is $reserve_code. Please Note that reservation expires after one hour</p>";				
					}else{						
						$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Could not place reservation. Please try again</p>";						
					}				
				}				
			}else{				
				$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Incomplete form data or Invalid data type</p>";				
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
			<h2 class="f_b"><span class="icon">Reserve a Table</span></h2>
			<p class="f_m">The Best Place To Eat</p>			
			<?php echo "<br/>".$msg; ?>		
			<div class="box">			
				<div class="input">					 
					 <label>Number of People</label>
					<input type="number" placeholder="How many People" min="1" name="People" id="People" required>				
				</div>			
				<div class="input">					
					<label>Email</label>
					<input type="email" name="email" placeholder="Enter your email" required>					
				</div>				
				<div class="input">				
					<label>Phone Number</label>
					<input type="number" name="phone" placeholder="Enter your phone number" required>					
				</div>				
				<div class="input">					
					<label>Date</label>
					<input type="date" name="date" placeholder="Select date for booking" required>					
				</div>				
				<div class="input">					
					<label>Time</label>
					<input type="time" name="time" placeholder="Select time for booking" required>					
				</div>				
			</div>			
			<div class="left">			
				<div class="input">					
                    <label>Suggestions <small><b>(Need a Cake? or a Children HighChair?)</b></small></label>
					<textarea name="suggestions" placeholder="Enter additional information!" required></textarea>					
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