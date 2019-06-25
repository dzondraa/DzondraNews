<?php
    session_start();
    if(!isset($_SESSION['uloga'])){
        echo "
        <script>alert('You must be logged in!')</script>
        <script>window.location='log.php'</script>
        ";
    }
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
      $kor = $_SESSION['id_korisnika'];
      $upit = "select * from odgovori where id_korisnik = :korisnik";
      $upit1=$konekcija->prepare($upit);
      $upit1->bindParam(":korisnik" , $kor);
      $upit1->execute();
      $rezultat=$upit1->fetchAll();
      if(!$rezultat){
      ?>
      <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="at">
        <label>Rank author</label>
        1 <input type="radio" name="radio" value="1">
        2 <input type="radio" name="radio" value="2">
        3 <input type="radio" name="radio" value="3">
        4 <input type="radio" name="radio" value="4">
        5 <input type="radio" name="radio" value="5">
        <input type="submit" name="rank" class="btn btn-primary" value="RANK">
      </form>
      <?php
        if(isset($_POST['rank'])){
            if(isset($_POST['radio'])){
                $upit2 = "insert into odgovori(odgovori,id_korisnik) values(:radio,:kor)";
                $upit3=$konekcija->prepare($upit2);
                $upit3->bindParam(":kor" , $kor);
                $upit3->bindParam(":radio" , $_POST['radio']);
                $upit3->execute();
            }}
            
        }
            else{
                $upitbr = "select odgovori ,  count(*) as con from odgovori group by odgovori order by odgovori";
                $upitbr1 = $konekcija->prepare($upitbr);
                $upitbr1->execute();
                $rezbr = $upitbr1->fetchAll();
                $upit = "select count(*) as br from odgovori";
                $upit1=$konekcija->prepare($upit);
                $upit1->bindParam(":korisnik" , $kor);
                $upit1->execute();
                $rezultat=$upit1->fetchAll();
                $ceoBr = (int)$rezultat[0]->br;
                echo "<div id='ati'><h1>Author</h1>";
                foreach($rezbr as $r){
                    $posto = (int)$r->con/$ceoBr*100;
                    echo "Mark ".$r->odgovori."<div class='progress'>
                    <div class='progress-bar' role='progressbar' style='width: ".$posto."%;' aria-valuenow='".$posto."' aria-valuemin='0' aria-valuemax='100'>".$posto."%</div>
                </div>";
                }
               echo "</div>";
               echo "<a class='btn btn-primary' href='author.php' role='button' style='margin:10px'>See results</a>'";
                
            }
            ?>         
            <div>
          <div class="span3 well"  id="acc">
            <center>
            <a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="images/author.jpg" name="aboutme" width="140" height="140" class="rounded-circle"></a>
            <p>Click face for short bio!</p>
        </center>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" id="myModalLabel">More About Dzondra</h4>
                        </div>
                    <div class="modal-body">
                        <center>
                        <img src="images/author.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                        <h3 class="media-heading">Djordje Nikolić <small>Serbia</small></h3>
                        <span><strong>Skills: </strong></span>
                        <span class="badge badge-primary">HTML5/CSS3</span>
                        <span class="badge badge-secondary">JavaScript</span>
                        <span class="badge badge-success">PHP</span>
                        <span class="badge badge-danger">MySql</span>
                        </center>
                        <hr>
                        <center>
                        <p class="text-left"><strong>Bio: </strong><br>
                          Hello evrybody, i'm Đorđe Nikolić, I study ICT college in Belgrade.I went to high school for natural mathematical science. This is my first interactive website!</p>
                        <br>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <center>
                        <button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about Dzondra</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
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