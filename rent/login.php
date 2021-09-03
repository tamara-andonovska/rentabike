<?php // Example 26-7: login.php
include '../view/header.php';
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');
  

  echo "<div id='main'><h3>Please enter your details to log in</h3>";
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = ($_POST['user']);
    $pass = ($_POST['pass']);
    
    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else
    {
      $result = $db->query("SELECT user,pass FROM members 
      WHERE user='$user' AND pass='$pass'");
     // $result = $result->fetchAll();
     $count = $result->rowCount();
      if ($count==0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("You are now logged in. Please <a href='../view/header.php'>" .
            "click here</a> to continue.<br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' action='login.php'>$error
    <span style="margin: 8px 0">Username</span><br>
    <input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box" 
    type='text' maxlength='16' name='user' value='$user'><br>

    <span style="margin: 8px 0">Password</span><br>
    <input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box" 
    type='password' maxlength='16' name='pass' value='$pass'>
_END;
?>

    <br>
    <span class='fieldname'>&nbsp;</span>
    <input style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"
   type='submit' value='Login'>
    </form><br></div>
  </body>
</html>
