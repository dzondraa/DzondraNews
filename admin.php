<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="index.php?admin=dodajVest" role="button">Add news</a>
            <a class="btn btn-primary" href="index.php?admin=uploadVest" role="button">Upload news</a>
            <a class="btn btn-primary" href="index.php?admin=changeUsers" role="button">Change users</a>
            
    </div>
    <div class="row">
     <div class="col-lg-12">
     <?php
    if(isset($_GET['admin'])){
    switch($_GET['admin']){
        case "uploadVest" : require "admin/uploadVesti.php"; break;
        case "dodajVest": require "admin/dodavanjeVesti.php"; break;
        case "setVesti": require "admin/setVesti.php"; break;
        case "changeUsers": require "admin/changeUsers.php"; break;
        
        
    }
} 
        
     ?>
     </div>
    
    </div>
</div>
</div>
