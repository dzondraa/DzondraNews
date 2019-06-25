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
    <title>Log in</title>
  </head>
  <body>
      <?php
      
      include "meni.php";
      ?>
          <div class="container">
        <div class="col-lg-12 text-center ha">
            <h1 class="display-2">Log in</h1>
          </div>
          <div class="container">
            <div class="row logi">
              <div class="col-lg-12">
                <form class="text-center" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username:</label>
                    <input type="text" name="user" class="form-control" id="user" aria-describedby="emailHelp" placeholder="Username">

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password:</label>
                    <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
    
                  </div>
                  
                  <input name="sub" id="logbut" type="submit" value="Log In" class="btn btn-primary text-center">
                </form>
                <?php
                include "konekcija.php";
                    if(isset($_POST['sub'])){                  
                        $user = $_POST['user'];
                        $pass = md5($_POST['pass']);
                        $upit = "SELECT * FROM korisnici WHERE username=:username AND password=:password";
                        $upit1 = $konekcija->prepare($upit);
                        $upit1 -> bindParam(":username" , $user);
                        $upit1 -> bindParam(":password" , $pass);
                        $upit1->execute();
                        $rezultat = $upit1->fetch();
                        
                        if($rezultat){
                            $_SESSION['uloga'] = $rezultat->id_uloga;
                            $_SESSION['korisnik'] = $user;
                            $_SESSION['id_korisnika'] = $rezultat->ID;
                            header('Location:index.php');
                        }
                        else{
                            
                            echo "Pogresni podaci su prosledjeni!";
                        }
                    }
                    
                ?>
                
              </div>
    
            </div>
          </div>
    
          </div>
       
        
    </div>

        
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>