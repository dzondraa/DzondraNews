<?php
    $broj = (int)$_GET['id'];
    $upit = "select * from vesti v inner join slike_za_vesti s on v.id
    = s.vest_id where vest_id = $broj";  
    $upit2 = $konekcija->prepare($upit);
    $upit2->execute(); 
    $rezultat = $upit2->fetchAll();
?>

<h2>Change news</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                 <label for="formGroupExampleInput">Heading</label>
                 <input type="text" value="<?php echo $rezultat[0]->naslov ?>" name="naslov" class="form-control" id="formGroupExampleInput" placeholder="Example input">
             </div>
             <div class="form-group">
                 <label for="formGroupExampleInput2">Short description</label>
                 <input type="text" value='<?php echo $rezultat[0]->kratakOpis ?>' name="kratakOpis" class="form-control" id="formGroupExampleInput2" placeholder="">
             </div>
             <div class="form-group">
                 <label for="formGroupExampleInput2">Long description</label>
                 <textarea name="dugiOpis" id="" cols="100" rows="10" class="form-control"> <?php echo $rezultat[0]->dugiOpis ?> </textarea>
             </div>
             <div class="form-group">
                 <label for="formGroupExampleInput2">Category</label>
                 <select name="kategorijaVesti" class="form-control">
                    <option selected value="1">World news</option>
                 </select>
             </div>
             <div class="form-group">
                 <label for="inputAddress2">Date:</label>
                 <input type="date" value="<?php echo $rezultat[0]->datum ?>" name="datum" class="form-control" id="datum">
             </div>
             <div class="form-group">
                 <label for="inputAddress2">Generate on home page?</label>
                 <input type="checkbox" <?php if($rezultat[0]->nova==1) echo 'checked'  ?> name="generisanje" class="" id="nova">
             </div>
             <div class="form-group">
                 <span>Current:</span>
                 <img class="mala" src="<?php echo $rezultat[0]->path ?>">
                 <label for="inputAddress2">New image:</label>
                 <input type="file" name="slika" id="slika" value="asd.jpg">
             </div>
             <input type="submit" name="upload" class="form-control" value="UPLOAD">
             
            </form>

<?php
if(isset($_POST['upload'])){
    
    $uploadDir = "upload/";
    $naslov = $_POST['naslov'];
    $kratakOpis = $_POST['kratakOpis'];
    $dugiOpis = $_POST['dugiOpis'];
    $kategorijaVesti = $_POST['kategorijaVesti'];
    var_dump($kategorijaVesti);
    $date = $_POST['datum'];
    if(isset($_POST['generisanje'])){
        $generisanje = 1;
    }
    else{
        $generisanje = 0;
    }
    $id = $_GET['id'];
    $upitVest = "update vesti set naslov = :naslov, kratakOpis = :kratakOpis,dugiOpis = :dugiOpis,
    datum = :datum, id_kategorija = :kategorijaVesti,nova = :nova where ID = $id";
    $preUpitVest = $konekcija->prepare($upitVest);
    $preUpitVest->bindParam(":naslov" , $naslov);
    $preUpitVest->bindParam(":kratakOpis" , $kratakOpis);
    $preUpitVest->bindParam(":dugiOpis" , $dugiOpis);
    $preUpitVest->bindParam(":datum" , $date);
    $preUpitVest->bindParam(":kategorijaVesti" , $kategorijaVesti);
    $preUpitVest->bindParam(":nova" , $generisanje);
    $preUpitVest->execute();
    #upload slike za vest
    if($_FILES['slika']['name']!=""){
        $fileName = $_FILES['slika']['name'];
        $tmpName = $_FILES['slika']['tmp_name'];
        $fileSize = $_FILES['slika']['size'];
        $fileType = $_FILES['slika']['type']; 
        $staro = addslashes($fileName);
        $upit = "update slike_za_vesti set staroIme = :fileName ,
        type = :fileType,size = :fileSize where vest_id = $id"; 
        $upit2 = $konekcija->prepare($upit);
        $upit2 -> bindParam(":fileName" , $fileName);
        $upit2 -> bindParam(":fileType" , $fileType);
        $upit2 -> bindParam(":fileSize" , $fileSize);
        $upit2->execute();
        $upitZaIme = "select name as novoIme from slike_za_vesti where vest_id = $id";
        $upitZaIme1 = $konekcija->prepare($upitZaIme);
        $upitZaIme1->execute();
        $re = $upitZaIme1->fetchAll();
        #$imeDelici = explode(".", $fileName);
        #$ekstenzija = end($imeDelici);
        $novoImeFajla = $re[0]->novoIme; 
        $filePath = $uploadDir . $novoImeFajla;
        $result = move_uploaded_file($tmpName, $filePath);
        if (!$result) { echo "Error uploading file"; exit; }

        if($rez){
            echo "File uploaded!";
        }
        
    }
    else{
        
    }
    

}    
?>