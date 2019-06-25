<div class="container">
    <div class="row">
        <div class="jumbotron text-center" id="jumbo">
             <h1 class="display-4">Welcome to Dzondra INFO</h1>
              <p class="lead">Be informed about all happenings, or if you want, register for better expirience!</p>
                <hr class="my-4">
                 <p>Click on the link below for registration!</p>
                 <p class="lead">
                 <a class="btn btn-primary btn-lg" href="registration.php" role="button">registration</a>
            </p>
        </div>
    </div>
    <div class="row text-center">
    <h2>Newest</h2>
    <div id="mixedSlider">
    <div class="MS-content">
        <?php
        include "konekcija.php";
        $upit =  "select * from vesti v inner join slike_za_vesti s on v.id
        = s.vest_id where nova=1";
        $upit1 = $konekcija->prepare($upit);
        $upit1->execute();
        $rezultat = $upit1->fetchAll();
        
        foreach($rezultat as $vest){
            echo "<div class='item'>
            <div class='imgTitle'>
                <h2 class='blogTitle'>".$vest->naslov."</h2>
                <img src='".$vest->path."' alt='".$vest->naslov."'/>
            </div>
            <p>".$vest->kratakOpis."</p>
        </div>";
        }             
                        
         ?>
                            
    </div>
    <div class="MS-controls">
            <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
            <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
         </div>     
    </div>
    <?php
    $upitID = "select max(ID) as max from vesti where id_kategorija = 3";
    $upitID2 = $konekcija->prepare($upitID);
    $upitID2->execute();
    $rez = $upitID2->fetchAll();
    $broj = (int)$rez[0]->max;
    $upitPrva = "select * from vesti v inner join slike_za_vesti s on v.id
    = s.vest_id where vest_id = $broj";
    $upitPrva2 = $konekcija->prepare($upitPrva);
    $upitPrva2->execute();
    $rezi = $upitPrva2->fetchAll();
    $timestamp = strtotime(''.$rezi[0]->datum.'');
    $dat = date($timestamp);
    $format = date('m/d/Y', $timestamp);
    echo"
    <h2>Latest</h2>
    <div class='card'>
            <div class='card-body'>
              <h5 class='card-title'>".$rezi[0]->naslov."</h5>
             <p class='card-text'>".$rezi[0]->dugiOpis."</p>
             <p class='card-text'><small class='text-muted'>".$format."</small></p>
             </div>
            <img class='card-img-bottom' src='".$rezi[0]->path."' alt='".$rezi[0]->naslov."'>
        </div>"   
    ?>
         
        
        
    </div>
    
</div>
<?php 
    include "footer.php";
?>