<?php
$serverBaze = "localhost";
$username = "Dzondra";
$password = "kakotikazes";
$bazaPodataka = "baza_sajt";
try {
 $konekcija = new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka",
 $username, $password);
 // set the PDO error mode to exception
 $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
 
 }
catch(PDOException $e)
 {
 echo "Greska sa konekcijom: " . $e->getMessage();
 }
?>