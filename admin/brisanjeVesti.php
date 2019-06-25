<?php
    session_start();
    include "../konekcija.php";
    $upit1 = "delete from slike_za_vesti where vest_id=:idBrisanje1";
    $preUpit2 = $konekcija->prepare($upit1);
    $preUpit2->bindParam(":idBrisanje1" , $idBrisanje);
    $rez = $preUpit2->execute();
    if($rez){
          $idBrisanje = $_GET['id'];
          $upit = "delete from vesti where ID=:idBrisanje";
          $preUpit = $konekcija->prepare($upit);
          $preUpit->bindParam(":idBrisanje" , $idBrisanje);
          $final = $preUpit->execute();
          if($final){
            echo "<script>alert('Deleted successful!')</script>";
          }
           else echo "<script>alert(`Couldn't delete news!`)</script>";
           header('Location:http://localhost/PHP_SAJT/index.php?admin=uploadVest');
    }
   
?>