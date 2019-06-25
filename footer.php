<div class="container-fluid fotRow">
      <div class="row futer1" id="futer">
        <div class="col-lg-4">
            <div class="list-group fut" id="foot1">
                <?php
                    $upit = "select * from meni";
                    $upit1 = $konekcija->prepare($upit);
                    $upit1->execute();
                    $rez = $upit1->fetchAll();
                    foreach($rez as $r){
                        echo "<a href='".$r->putanja."' class='list-group-item list-group-item-action'>".$r->naziv."</a>";
                    }
                ?>
              </div>
        </div>
        <div class="col-lg-4">
            <div class="list-group fut">
                <a href="https://facebook.com" target="_blank" class="list-group-item list-group-item-action">Facebook</a>
                <a href="https://youtube.com" target="_blank" class="list-group-item list-group-item-action">Youtube</a>
                <a href="https://twitter.com" target="_blank" class="list-group-item list-group-item-action">Twitter</a>
                <a href="sitemap.xml" target="_blank" class="list-group-item list-group-item-action ">Sitemap</a>
              </div>
        </div>
        <div class="col-lg-4" id="cont">
          <form action="<?php $_SERVER['PHP_SELF']?>" class="fut" method="POST" id="formaKontakt" onsubmit="return contact()">
              <div class="form-group">
                  <input class="form-control" type="text" name="email" id="mailcont" placeholder="E-mail">
                  <label for="textarea">Your message:</label>
                  <textarea name="text" class="form-control" id="text" rows="3" placeholder="Contact us!"></textarea>
                  <input name="sub" class="form-control btn btn-primary" type="submit" value="SEND">
                </div>
          </form>
         </div>
      </div>

    </div>
    <script src="js/contact.js"></script>
    <?php
    if(isset($_POST['sub'])){
        $mail = $_POST['email'];
        $message = $_POST['text'];
        $text = str_replace("\n.", "\n..", $message);
        $to = "djordje.nikolic.135.17@ict.edu.rs";
        $subject = "Contact";
        $headers = "From: ".$mail.".\r\n";
        @$bol = mail($to , $subject , $text, $mail);
        if($bol){
            echo "<script> alert('Message sent successful!') </script>";
        }else{
            echo "<script> alert('Error!') </script>";
        }
    }
    ?>