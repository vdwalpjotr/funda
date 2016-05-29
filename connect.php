<?php

$serverName = "127.0.0.1";
$username = "root";

try{
  $db = new PDO("mysql:host=$serverName;dbname=funda;", $username);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  echo "Connected to database";
}catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}
