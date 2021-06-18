<!-- Made by Nicole Abdilla @nicoleabdilla20 -->
<?php 
	session_start();
	//require_once __DIR__.'/bootstrap.php';
	require "admin/db.php";	
	//For Reservation
	$m = "";	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {		
		if(isset($_POST['submit'])) {
			// htmlentities function converts all applicable characters to HTML entities			
			$Person = htmlentities($_POST['Person'], ENT_QUOTES, 'UTF-8'); // ENT_QUOTES is a paramater which converts double and single quotes.
			$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // FILTER_VALIDATE_EMAIL is a validation check to check the input is in an email format.
			$phone = preg_replace("#[^0-9]#", "", $_POST['phone']);
			$complaint = htmlentities($_POST['complaint'], ENT_QUOTES, 'UTF-8');			
			if($Person != "" && $email && $phone != "" && $complaint != "") {	//checks if the user input null values		
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
			}else{ //if a field is empty output the following		
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
			<a class = "page" href = "about.html">About</a>
            <a class = "active page" href = "contact.php">Contact</a>
            <a class = "page" href = "menu.php">Menu</a>
            <a class = "page" href = "favourites.php">Favourites</a>
        </div>
<div class="content">
	<div class="res_content">		
	<!-- form for the query or complaint-->	
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