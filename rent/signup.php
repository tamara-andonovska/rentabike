<?php // Example 26-5: signup.php

include '../view/header.php';
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');
require('../model/message.php');
echo <<<_END
<div id='main'><h3>Please enter your details to sign up</h3>
_END;

  $error = $ime = $prezime = $email = $user = $pass = "";
  if (isset($_SESSION['user'])){
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  } 

  if (isset($_POST['user']))
  {
    $ime = ($_POST['ime']);
    $prezime = ($_POST['prezime']);
    $email = ($_POST['email']);
    $user = ($_POST['user']);
    $pass = ($_POST['pass']);

    if ($ime == "" || $prezime == "" || $email == "" || $user == "" || $pass == "")
      $error = "Not all fields were entered<br><br>";
    else
    {
      $result = $db->query("SELECT * FROM members WHERE user='$user'");
      $count = $result->rowCount();
      if ($count)
      $error = "That username already exists<br><br>";
      else
      {
        $result = $db->query("INSERT INTO members VALUES('$ime','$prezime','$email','$user', '$pass')");
        $first_name = trim(filter_input(INPUT_POST, 'ime'));
        $last_name = trim(filter_input(INPUT_POST, 'prezime'));
        $email = trim(filter_input(INPUT_POST, 'email'));
      
        // Set up email variables
        $to_address = $email;
        $to_name = $first_name . ' ' . $last_name;
        $from_address = 'webappfeit@feit.com';
        $from_name = 'Web app feit';
        $subject = 'Rent a bike - Registration Complete';
        $body = '<p>Thanks for registering with our site.</p>' .
                '<p>Sincerely,</p>' .
                '<p>Rent a bike</p>';
        $is_body_html = true;
        
        // Send email
        try {
            send_email($to_address, $to_name, 
                    $from_address, $from_name, 
                    $subject, $body, $is_body_html);
        } catch (Exception $ex) {
            $error = $ex->getMessage();
        }
        die("<h4>Account created</h4>Please Log in.<br><br>");
      }
    }
  }

  echo <<<_END
  <form method='post' action='signup.php'>$error
  <span style="margin: 8px 0">Name</span><br>
  <input style="width: 80%; padding: 12px 20px;  margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box" 
  type="text" name="ime"  value="$ime"><br>

  <span style="margin: 8px 0">Surname</span><br>
  <input style="width: 80%; padding: 12px 20px;margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box" 
  type="text" name="prezime"  value="$prezime"><br>

  <span style="margin: 8px 0">E-mail</span><br>
  <input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box" 
  type="text" name="email"  value="$email"><br>

  <span style="margin: 8px 0">Username</span><br>
  <input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box" 
  type='text' maxlength='16' name='user' value='$user'
    onBlur='checkUser(this)'><span id='info'></span><br>

  <span style="margin: 8px 0">Password</span><br>
  <input style="width: 80%; padding: 12px 20px; mmargin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
  type='password' maxlength='16' name='pass' value='$pass'><br>
_END;
?>

    <span class='fieldname'>&nbsp;</span>
    <input style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"
   type='submit' value='Sign up'>
    </form><br></div>
  </body>
</html>
