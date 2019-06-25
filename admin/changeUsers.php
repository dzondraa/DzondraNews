<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ime</th>
      <th scope="col">Prezime</th>
      <th scope="col">Username</th>
      <th scope="col">E-mail</th>
      <th scope="col">Uloga</th>
      <th scope="col">Change</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>
<?php
    $upit = "select k.ID,k.ime,k.prezime,k.username,k.email,u.naziv from korisnici k inner join uloge u on k.id_uloga
    = u.ID";
    $upit1 = $konekcija->prepare($upit);
    $upit1->execute();
    $rezultat = $upit1->fetchAll();  
    foreach($rezultat as $us){
       echo "<tr>
       <td>".$us->ID."</td>
       <td>".$us->ime."</td>
       <td>".$us->prezime."</td>
       <td>".$us->username."</td>
       <td>".$us->email."</td>
       <td>".$us->naziv."</td>
       <td><a class='btn btn-info' href='user.php?user=".$us->ID."' role='button'>Change</a></td>
       <td><a class='btn btn-danger' href='admin/brisanjeUsers.php?id=".$us->ID."' role='button'>Remove</a></td>
     </tr>";
    }
?>
  </tbody>
</table>