

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
        <p>Category:</p>
            <div class="list-group">
            <a href="index.php?idKat=0" class="list-group-item list-group-item-action">All news</a>
            <?php
            
                $upit = "select * from kategorije_vesti";
                $upit2 = $konekcija->prepare($upit);
                $upit2->execute();
                $rezultat = $upit2->fetchAll();
                foreach($rezultat as $li){
                    echo "<a href='index.php?idKat=".$li->ID."' class='list-group-item list-group-item-action'>". $li->nazivKategorije ."</a>";
                }
            ?>
            
        </div>
        <p>Sort by date:</p>
          <div class="list-group">
            <a href="index.?php?sort=true" class="list-group-item list-group-item-action">Newest</a>
          </div>
        </div>
        <div class="col-lg-10 d-flex flex-wrap ">
        <?php
        if(isset($_GET['vestId'])){
          $bri = $_GET['vestId'];
          $quer = "select * from vesti v inner join slike_za_vesti s on v.id
          = s.vest_id where vest_id = $bri";
          $quer2 = $konekcija->prepare($quer);
          $quer2->execute();
          $reza = $quer2->fetchAll();
          $timestamp = strtotime(''.$reza[0]->datum.'');
          $dat = date($timestamp);
          $format = date('m/d/Y', $timestamp);
          echo "<div class='card carda'>
          <div class='card-body'>
            <h5 class='card-title'>".$reza[0]->naslov."</h5>
           <p class='card-text'>".$reza[0]->dugiOpis."</p>
           <p class='card-text'><small class='text-muted'>".$format."</small></p>
           </div>
          <img class='card-img-bottom' src='".$reza[0]->path."' alt='".$reza[0]->naslov."'>
      </div>";
          }else{
          
        function upit($id , $order , $as){
        include "konekcija.php";
          if($id==0){
            $upitID = "select max(ID) as max from vesti";
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
        <div class='card cardd'>
                <div class='card-body'>
                  <h5 class='card-title'>".$rezi[0]->naslov."</h5>
                 <p class='card-text'>".$rezi[0]->dugiOpis."</p>
                 <p class='card-text'><small class='text-muted'>".$format."</small></p>
                 </div>
                <img class='card-img-bottom' src='".$rezi[0]->path."' alt='".$rezi[0]->naslov."'>
            </div>"; 
            $upit = "select * from vesti inner join slike_za_vesti on vesti.ID = slike_za_vesti.vest_id";
          }else{ 
          if($order!=0 && $as!=0){
             $str = 'order by '.$order .''. $as.'';
         }
         else{
          $str = "";
         }
         $upit =  "select * from vesti inner join slike_za_vesti on vesti.ID = slike_za_vesti.vest_id where id_kategorija = $id". $str."";
          }
         $upit2 = $konekcija->prepare($upit);
         $upit2->execute();
         $rez=$upit2->fetchAll();
         return $rez;
         var_dump($rez);
        }
        if(!isset($_GET['idKat'])){
            
            $_SESSION['idKat']=0;
            $poseban = "select * from vesti inner join slike_za_vesti on vesti.ID = slike_za_vesti.vest_id";
            $poseban2 = $konekcija->prepare($poseban);
            $poseban2->execute();
            $zaGen = $poseban2->fetchAll();
        }else if(isset($_GET['idKat'])){
        $idKat = $_GET['idKat'];
        $_SESSION['idKat']=$idKat;
        }
        if(isset($_GET['order']) &&  isset($_GET['as'])){
            $zaGen = upit($_SESSION['idKat'] , $_GET['order'] , $_GET['as']);
        }
        else{
            $zaGen = upit($_SESSION['idKat'],0,0);
        }
         
        foreach($zaGen as $a){
        $tmp = strtotime(''.$a->datum.'');
        $dati = date($tmp);
        $formi = date('m/d/Y', $dati);
            echo "<div class='card mojCard' style='width: 18rem;'>
            <img class='card-img-top' src='". $a->path ."' alt='".$a->naslov."'>
            <div class='card-body'>
              <h5 class='card-title'>".$a->naslov."</h5>
              <p class='card-text'>".$a->kratakOpis."</p>
              <p class='gray'>". $formi ."</p>
              <a href='index.php?vestId=".$a->vest_id."' class='btn btn-primary'>Read more</a>
            </div>
          </div>";
        }
      }
        
        ?>
        </div>
    </div>
</div>
<?php
  if(isset($_GET['sort'])){
    if($_GET['sort'] = "true"){
      $upitO = "select * from vesti inner join slike_za_vesti on vesti.ID = slike_za_vesti.vest_id where
       id_kategorija = :idKat order by datum desc";
       $upitO1 = $konekcija->prepare($upitO);
       $upitO1->bindParam("idKat" , $_SESSION['idKat']);
       $upitO1->execute();
       $rezar = $upitO1->fetchAll();
    
    }
  }
?>