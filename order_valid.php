<?php 

// define variables and set to empty values
$name_error = $email_error = "";
$name = $email = $message = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $name_error = "Name is required";
  } else {
    $name = checkinput($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["email"])) {
    $email_error = "Email is required";
  } else {
    $email = checkinput($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format"; 
    }
}
  
  if ($name_error == '' and $email_error == '' ){
      
      unset($_POST['submit']);
      
      $to = 'partytimeweb2018@gmail.com';
      $subject = 'Contact Form Submit';
      $order = 'Name: ' . $name."\n"."Email: ". $email."\n". print_r($_SESSION,true);
      if (mail($to, $subject, $order ,'FROM: $email')){
          
          session_destroy();
            
            header('Location: home.php'); 
            
          
      }
  }
  
}

function checkinput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}