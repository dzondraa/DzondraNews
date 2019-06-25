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
    <title>Registration</title>
  </head>
  <body>
      <?php
      
      include "meni.php";
      ?>
              <div class="container">
        <div class="col-lg-12 text-center ha">
            <h1 class="display-2">Registration</h1>
          </div>
          <div class="container">
                <div class="row logi">
                    <div class="col-lg-12">
                      <form onsubmit="" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="fName">First Name</label>
                            <input type="text" name="fname" class="form-control" id="fName" placeholder="First name">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" class="form-control" id="lName" placeholder="Last name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="user">Username</label>
                          <input type="text" name="user" class="form-control" id="user" placeholder="Username">
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="pas1">Password</label>
                            <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="pas2">re-Password</label>
                            <input type="password" name="repass" class="form-control" id="pas2" placeholder="re-Password">
                          </div>
                        </div>
          
                        <div class="form-row">
                          <label for="mail">E-mail</label>
                          <input type="text" name="email" class="form-control" id="mail" placeholder="E-mail">
                          
                        </div>
                        <input name="sub" id="logbut" type="submit" value="Registration" class="btn btn-primary text-center">
                      </form>
                      
                    </div>
          
              

                  
                <?php
                include "konekcija.php";
                    if(isset($_POST['sub'])){                  
                        $user = $_POST['user'];
                        $repass = $_POST['repass'];
                        $email = $_POST['email'];
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $pas = $_POST['pass'];
                        $pass = md5($_POST['pass']);
                        $upit = "SELECT * FROM korisnici WHERE username=:username OR email=:email";
                        $upit2 = $konekcija->prepare($upit);
                        $upit2 -> bindParam(":username", $user);
                        $upit2 -> bindParam(":email" , $email);
                        $upit2 -> execute();
                        $rezultat = $upit2->fetch();
                        if(!$rezultat){
                              $regExPas = "/^[a-z0-9]{5,30}$/";
                              $regExfName = "/^[A-Z]{1}[a-z]{3,15}(\s[A-Z]{1}[a-z]{20})*$/";
                              $regExlName = "/^[A-Z]{1}[a-z]{3,15}(\s[A-Z]{1}[a-z]{20})*$/";
                              $regExUser = "/^[\w][\w\d]{2,14}$/";
                              if(true){
            
                            $insUpit = "INSERT INTO korisnici(ime,prezime,email,password,username)
                             VALUES(:fname , :lname, :email,:pass,:user)";
                            $insUpit2 = $konekcija->prepare($insUpit);
                            $insUpit2 -> bindParam(":user", $user);
                            $insUpit2 -> bindParam(":email" , $email);
                            $insUpit2 -> bindParam(":pass" , $pass);
                            $insUpit2 -> bindParam(":fname" , $fname);
                            $insUpit2 -> bindParam(":lname" , $lname);
                            $insUpit2 -> execute();
                              
                            if($insUpit2){
                                echo "USPESNA REGISTRACIJA!";
                            }
                          }else{
                            echo "Nisu prosledjeni validni podaci!";
                        }                        
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