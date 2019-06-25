<?php
include "../konekcija.php";
$id = $_GET['id'];
$upit = "delete from korisnici where ID=$id";
$upit1= $konekcija->prepare($upit);
$rez = $upit1->execute();
if($rez){
    echo "<script>alert('User deleted!')</script>";
    echo "<script>window.location='../index.php?admin=changeUsers'</script>";
}

?>