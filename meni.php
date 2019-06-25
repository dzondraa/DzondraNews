<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
    <?php
    @session_start();
    include "konekcija.php";
    $nivo = 0;
    function struktura($roditelj , $nivo , $konekcija){
        $upit = "SELECT * FROM meni WHERE roditelj=:roditelj";
        $upit1 = $konekcija -> prepare($upit);
        $upit1->bindParam(":roditelj" , $roditelj);
        $upit1->execute();
        $rezultat = $upit1->fetchAll();
        if($upit1->rowCount() > 0){
            echo '<ul class="navbar-nav sf-menu">';
        }
        foreach($rezultat as $red){
            echo "<li><a href='".$red->putanja."' class='nav-link'>".$red->naziv."</a></li>";
            struktura( $red->ID, $nivo+1, $konekcija);
            
        }
        if($upit1->rowCount() > 0){
        echo "</ul>"; }
    }
   
    $upit = "SELECT * FROM meni WHERE roditelj=0";
    $rez = $konekcija -> query($upit);
    $rezultat = $rez->fetchAll();
    foreach($rezultat as $vrednost){
      if($vrednost->naziv == "Log in" || $vrednost->naziv == "Registration"){
        if(isset($_SESSION['korisnik'])) continue;
      }
        echo "<li>
        <a class='nav-link' href='$vrednost->putanja'> $vrednost->naziv
        </a>";
        struktura($vrednost->ID , $nivo+1, $konekcija);

       echo "</li>";
    }
    
    if(isset($_SESSION['korisnik'])){
      $id2 = $_SESSION['id_korisnika'];
      echo "
      <a class='nav-link' href='user.php?user=".$id2."'>".$_SESSION['korisnik']."
      </a></li>";
      echo "<li>
      <a class='nav-link' href='logout.php'> Log out
      </a></li>";
    }
    
    echo "<ul>";
     ?>
    </ul>
  </div>
</nav>