<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Heading</th>
      <th scope="col">Short description</th>
      <th scope="col">Image</th>
      <th scope="col">Update</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>
<?php
    $upit =  "select * from vesti v inner join slike_za_vesti s on v.id
    = s.vest_id";
    
    $upit1 = $konekcija->prepare($upit);
    $upit1->execute();
    $rezultat = $upit1->fetchAll();  
    foreach($rezultat as $vest){
       echo "<tr>
       <td>".$vest->vest_id."</td>
       <td>".$vest->naslov."</td>
       <td>".$vest->kratakOpis."</td>
       <td>".$vest->name."</td>
       <td><a class='btn btn-info' href='index.php?admin=setVesti&id=".$vest->vest_id."' role='button'>Update</a></td>
       <td><a class='btn btn-danger' href='admin/brisanjeVesti.php?id=".$vest->vest_id."' role='button'>Remove</a></td>
     </tr>";
    }
?>
  </tbody>
</table>
