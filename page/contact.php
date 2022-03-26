<?php require("../include/header.html")?>

<div class="search">
    <div class="form">
         <form action="#" method="post">
              <input type="text"class='form-control' name="" id="" autofocus>
              <p><button class="btn btn-danger">Rechercher</button></p>
         </form>
    </div>
</div>   


<div class="formulaire">
    <form action="./list.php" method="post">

        <h1>Reservation</h1><br/>
        <div class="input row">

            <div class="col-md-6">
                <label class="form-label">Nom <span>*</span></label>
                <input type="text" class="form-control" name='nom'>
            </div>
            <div class="col-md-6">
                <label class="form-label">Prenom<span>*</span></label>
                <input type="text" class="form-control" name='prenom'>
            </div>
        </div>

        <div class="input row">

            <div class="col-md-12">
                <label class="form-label">Date<span>*</span></label>
                <input type="date" class="form-control" name='date'>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-6">
                <label class="form-label">Heure de reservation<span>*</span></label>
                <input type="time" class="form-control" min="1" name='heure'>
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Nombre de table<span>*</span></label>
                <input type="tel" class="form-control" name='nb'>
            </div>
            <div class="col-md-12">
                <label class="form-label">Telephone<span>*</span></label>
                <input type="tel" class="form-control" name='tel'>
            </div>
        </div><br/>
        <p class="err"></p>
        <p><button class="btn btn-danger">Reserver</button></p>
        <a href="#" class='recu'>Imprimez votre recu</a>
       
</form>
</div>



<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../js/contact.js"></script>
</body>
</html>