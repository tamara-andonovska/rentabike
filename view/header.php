
<?php // Example 26-2: header.php
	include('../model/database.php');
  session_start();

  echo "<!DOCTYPE html>\n<html><head>";


  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

  echo "<title>Rent a Bike</title>
  <link rel='stylesheet' type='text/css'  href='../izgled.css' /></head>";

  if ($loggedin)
  {
    echo "<div id='page'><div id='header'><ul>" .
         "<li><a href='../product_catalog'>Browse bikes</a></li>"         .
         "<li><a href='../rent'>Rent</a></li>"       .
         "<li><a href='../search'>Search</a></li>"       .
		 "<li><a href='../blog'>Blog</a></li>"       .

         "<li><a href='../rent/logout.php'>Log out</a></li></ul><br>";
  }
  else
  {
    echo ("<div id='page'><div id='header'><h1>Rent a Bike</h1><ul>" .
          "<li><a href='../index.php'>Home</a></li>".
          "<li><a href='../rent/login.php'>Log in</a></li>".
          "<li><a href='../rent/signup.php'>Sign up</a></li></ul>");
  }
?>