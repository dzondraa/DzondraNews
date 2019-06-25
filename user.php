<?php
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Find perfect skateboard for you!">
    <meta name="keywords" content="skate, skateboarding, skateboards "/>
    <meta name="author" content="Đorđe Nikolić 135/17">
    <meta property="og:title" content="Dzondra skateboards" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="index.html" />
    <meta property="og:image" content="images/icon.jpg" />
    <meta property="og:description" content="Find perfect skateboard for you!" />
    <meta property="og:site_name" content="Dzondra skateboards" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Pocetna</title>
  </head>
  <body>
      <?php
      include "meni.php";
      $idKorisnik = $_GET['user'];
      $upit = "select * from korisnici where ID = $idKorisnik";
      $upitPre = $konekcija->prepare($upit);
      $upitPre->execute();
      $rezultat = $upitPre->fetchAll();
      ?>
       <div class="container">
        <div class="col-lg-12 text-center ha">
            <h1 class="display-2">Change options</h1>
            <h2><?php echo $rezultat[0]->username ?></h2>
          </div>
          <div class="container">
                <div class="row logi">
                    <div class="col-lg-12">
                      <form onsubmit="" method="POST" action="user.php?user=<?=$idKorisnik?>">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="fName">First Name</label>
                            <input type="text" value="<?php echo $rezultat[0]->ime ?>" name="fname" class="form-control" id="fName" placeholder="First name">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" value="<?php echo $rezultat[0]->prezime ?>" name="lname" class="form-control" id="lName" placeholder="Last name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="user">Username</label>
                          <input type="text" value="<?php echo $rezultat[0]->username ?>" name="user" class="form-control" id="user" placeholder="Username">
                        </div>
                        <div class="form-row">
                          <label for="mail">E-mail</label>
                          <input type="text" value="<?php echo $rezultat[0]->email ?>" name="email" class="form-control" id="mail" placeholder="E-mail">
                          
                        </div>
                        <input name="sub" id="logbut" type="submit" value="Save changes" class="btn btn-primary text-center">
                      </form>
                      
                    </div>
        
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
    <?php
    if(!isset($_SESSION['uloga'])){
      echo '<script src="js/multislider.js"></script>
            <script src="js/main.js"></script>
      ';
    }
    ?>   
</body>
</html>
<?php
    if(isset($_POST['sub'])){
        $user = $_POST['user'];
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $upitU = "update korisnici set ime = :fname, prezime = :lname, username=:user,email = :email
        where ID = $idKorisnik";
        $upitU1 = $konekcija->prepare($upitU);
        $upitU1->bindParam(":lname" , $lname);
        $upitU1->bindParam(":fname" , $fname);
        $upitU1->bindParam(":user" , $user);
        $upitU1->bindParam(":email" , $email);
        $upitU1->execute();
        echo "<script> alert('Changes saved!')</script>";
        echo "<script> window.location = 'user.php?user=".$idKorisnik."' </script>";
    }

?>