
<?php require("../include/header.html")?>

<div class="container  plats">

    <div class="row">
         <h1>Nos Plats du jour</h1>
        
    </div>

    <div class="row produits"></div>

</div><br/><br/>
<!---------------------------------------------------------------------->
<div class="container desserts">
    <div class="row">
        <h1>Nos Desserts du jour</h1>
    </div>
    <div class="row dessert"></div>
</div>
<!------------------------------------------------------->
<br/><br/>
<div class="container boisson">
    <div class="row">
            <h1>Nos Boissons</h1>
        </div>
        <div class="row boissons"></div>
    </div>
</div>

<a href="../panier/panier.php">
    <div class="panier">
            <span class='nb'></span>
            <i class='fa fa-shopping-cart'></i>
    </div> <br/><br/>
</a>




<?php require("../include/footer.html")?>

<script src="../js/bd.js"></script>
</body>
</html>
