<?php
$servername = "localhost";
  
  // REPLACE with your Database name
  $dbname = "sultanot_tes_wemos";
  // REPLACE with Database user
  $username = "sultanot";
  // REPLACE with Database user password
  $password = "j3#eBg641SIO:d";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  ?>