            <h2>Upload news</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                 <label for="formGroupExampleInput">Heading</label>
                 <input type="text" name="naslov" class="form-control" id="formGroupExampleInput" placeholder="Example input">
             </div>
             <div class="form-group">
                 <label for="formGroupExampleInput2">Short description</label>
                 <input type="text" name="kratakOpis" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
             </div>
             <div class="form-group">
                 <label for="formGroupExampleInput2">Long description</label>
                 <textarea name="dugiOpis" id="" cols="100" rows="10" class="form-control"></textarea>
             </div>
             <div class="form-group">
                 <label for="formGroupExampleInput2">Category</label>
                 <select name="kategorijaVesti" class="form-control">
                    <option value="1">World news</option>
                 </select>
             </div>
             <div class="form-group">
                 <label for="inputAddress2">Date:</label>
                 <input type="date" name="datum" class="form-control" id="datum">
             </div>
             <div class="form-group">
                 <label for="inputAddress2">Generate on home page?</label>
                 <input type="checkbox" name="generisanje" class="" id="nova">
             </div>
             <div class="form-group">
                 <label for="inputAddress2">Image:</label>
                 <input type="file" name="slika" id="slika">
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
    $date = $_POST['datum'];
    if(isset($_POST['generisanje'])){
        $generisanje = 1;
    }
    else{
        $generisanje = 0;
    }
    $upitVest = "insert into vesti(naslov,kratakOpis,dugiOpis,datum,id_kategorija,nova)
    values(:naslov,:kratakOpis,:dugiOpis,:datum,:kategorijaVesti,:nova)";
    $preUpitVest = $konekcija->prepare($upitVest);
    $preUpitVest->bindParam(":naslov" , $naslov);
    $preUpitVest->bindParam(":kratakOpis" , $kratakOpis);
    $preUpitVest->bindParam(":dugiOpis" , $dugiOpis);
    $preUpitVest->bindParam(":datum" , $date);
    $preUpitVest->bindParam(":kategorijaVesti" , $kategorijaVesti);
    $preUpitVest->bindParam(":nova" , $generisanje);
    $preUpitVest->execute();
    $straniSlika = $konekcija->lastInsertId();

    #upload slike za vest
    $fileName = $_FILES['slika']['name'];
    $tmpName = $_FILES['slika']['tmp_name'];
    $fileSize = $_FILES['slika']['size'];
    $fileType = $_FILES['slika']['type']; 
    $staro = addslashes($fileName);
    $upit = "INSERT INTO slike_za_vesti(staroIme,type,size,vest_id) 
    VALUES(:fileName,:fileType,:fileSize,:straniSlika)";
    $upit2 = $konekcija->prepare($upit);
    $upit2 -> bindParam(":fileName" , $fileName);
    $upit2 -> bindParam(":fileType" , $fileType);
    $upit2 -> bindParam(":fileSize" , $fileSize);
    $upit2 -> bindParam(":straniSlika" , $straniSlika);
    $upit2->execute();
    $poslednjiId = $konekcija->lastInsertId();
    $imeDelici = explode(".", $fileName);
    $ekstenzija = end($imeDelici);
    $novoImeFajla = $poslednjiId . "." . $ekstenzija; 
    $filePath = $uploadDir . $novoImeFajla;
    $result = move_uploaded_file($tmpName, $filePath);
    if (!$result) { echo "Error uploading file"; exit; }
    else{
    $fileName = addslashes($novoImeFajla);
    $query = "UPDATE slike_za_vesti SET name ='$fileName', path = '$filePath' WHERE id = '$poslednjiId'";
    $query2 = $konekcija->prepare($query);
     $konekcija->query($query);
    echo "<br>File uploaded<br>";
    }

}    
?>
            