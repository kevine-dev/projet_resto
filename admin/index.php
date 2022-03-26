<?php  

    session_start();
    $date = date('Y-m-d');
                
    $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
    $sel='SELECT * FROM reservation WHERE date_r=?';
    $req=$db->prepare($sel);
    $req->execute([$date]);
    $datas=$req->fetchAll();
   
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./admin.css">
    <title>Document</title>
</head>
<body>

<?php 

            $_SESSION['admin']=0;
            if(!empty($_POST['user']) && !empty($_POST['pass']))
            {
            $user=$_POST['user'];
            $pass=$_POST['pass'];

            if($pass==1234 && $user=='admin')
            {
                $_SESSION['admin']=1;
            }
            }
            if(isset($_SESSION['admin']) && $_SESSION['admin']==1):

            ?>


      
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-2">
                        <nav>
                            <h1><strong><i class="fa fa-user"></i><br/>Admin</strong></h1>
                            <ul>
                                <li><a href="#list" class='active' >Lister</a></li>
                                <li><a href="#add" class=''>Ajouter &nbsp; <i class="fa fa-plus"></i></a></li>
                                <li><a href="#up" style='display:none'>Modifier&nbsp;</a></li>
                                <li><a href="#res">Reservation</a></li>
                                <li>
                                    <a href="./deconnexion.php">
                                         <button class='btn btn-danger'><i class="fa fa-sign-out"></i></button>
                                    </a>
                               </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="container">

                  <div class="content">
                      <i class="fa fa-list rm_section"></i>
                    
                            <section class="liste show " id='list'>
                                        
                                    <h1>
                                        Listes des produits<br/>
                                       <?php  echo $date;?>
                       
                                    </h1><br/>
                                    
                                <form action="#" class='formq'>
                                    <div class="input-group">
                                        <label for="email" class="input-group-text"><i class="fa fa-search"></i></label>
                                        <input type="text"  id="q" class="form-control" placeholder="rechercher">
                                    </div> 
                                </form>
                                    <div class="items">
                                       
                                    </div>

                            </section>
                            <section class="add_pr " id='add'>
                                <form action="./traitement.php?action=add" id='form_ad' method="POST" class='form' enctype='multipart/form-data'>
                                        <h1>Ajouter</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="libelle" class="form-label">Nom du produit :</label>
                                                <input type="text" name="nomp" id="libelle" class='form-control inpt'>
                                                <p class="err lib_err"></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="qt" class="form-label">Quantite du produit :</label>
                                                <input type="number"  name="qte" id="qt" class='form-control inpt'>
                                                <p class="err err_qte"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pr" class="form-label">Prix du produit :</label>
                                                <input type="number" name="prix" id="pr" class='form-control inpt'>
                                                <p class="err err_prix"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-label">Image du produit</label>
                                                <input type="file" name="file" class='form-control'>  
                                                <p class="err err_file"></p>    
                                            </div>
                                        </div>
                                        <div class="row ">
                                                <div class="col-md-12">
                                                    <label class="form-label">Categorie du produit</label>
                                                    <select name="categorie" id="" class='form-control inpt'>
                                                        <option value=""></option>
                                                        <option value="1">Consistant</option>
                                                        <option value="2">Dessert</option>
                                                        <option value="3">Boisson</option>
                                                    </select>
                                                    <p class="err err_cat"></p>
                                                </div>
                                        </div><br/>
                                        <p><button class="btn btn-danger bt">Ajouter <i class="fa fa-plus"></i></button></p>
                                        <p class="success"></p>
                                </form>

                            </section>


                            <section class="" id='up'>

                                <form action="traitement.php?action=modify" method='POST' id="form_up" class='form'>
                                        <h1>Modifier</h1>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="libelle" class="form-label">Nom du produit :</label>
                                                    <input type="text" name="nomp" id="libelle" class='form-control inpt lib_produit'>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="qt" class="form-label">Quantite du produit :</label>
                                                    <input type="number"  name="qte" id="qt" class='form-control inpt qte'>
                                                
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="pr" class="form-label">Prix du produit :</label>
                                                    <input type="number" name="prix" id="pr" class='form-control inpt prix'>
                                                    
                                                </div>
                                            </div>
                                  
                                            <div class="row ">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Categorie du produit</label>
                                                        <select name="categorie" id="" class='form-control inpt categorie'>
                                                            <option value=""></option>
                                                            <option value="1">Consistant</option>
                                                            <option value="2">Dessert</option>
                                                            <option value="3">Boisson</option>
                                                        </select>
                                                    
                                                    </div>
                                            </div><br/>
                                            <input type="hidden" name="id" class='form-control inpt id'>
                                            <p><button class="btn btn-primary bt">Modifier<i class="fa-solid fa-trash-can"></i></button></p>
                                            <p class="success_mod"></p>
                                            
                                </form>
    
                        </section>
                        <section id="res">
                                <h1 style='font-weight:bold;font-size:30px'>reservation du jour </h1>
                                <div class="alert alert-danger" role="alert">
                                        vous ne pourez voir que les reservation du jour ...
                                </div>
                                <table class="table reservation">
                                              
                                                    <tr>
                                                        <th>Nom </th>
                                                        <th>Prenom </th>
                                                        <th>Nombre de table</th>
                                                        <th>date et heure de reservation</th>
                                                        
                                                    </tr>
                                                   <?php if(empty($datas)) :?>
                                                        <tr >
                                                            <td colspan='5' style='color:red;text-align:center;font-weight:bold'>
                                                                Pas reservation pour le moment .<br/>
                                                                Veuillez reactualiser la page pour reverifier Cela
                                                            </td>
                                                        </tr>
                                                    <?php endif?>

                                                    <?if(!empty($datas)): ?>
                                                           <?php foreach($datas as $data) :?>
                                                                <tr>
                                                                    <td><?=$data['nom']?></td>
                                                                    <td><?=$data['prenom']?></td>
                                                                    <td><?=$data['nbre_table']?></td>
                                                                    <td><?=$data['date_r']?> a <br/><?=$data['heure']?></td>
                                                                    
                                                                </tr>
                                                            <?php endforeach?>
                                                    <? endif ?>
                                </table>
                        </section>
                  
                  </div>
            </div>

            <?php endif?>
        <?php if(!isset($_SESSION['admin']) || $_SESSION['admin']!=1): ?>

            <div class="container body">
        
                <div class="">
                    <form action="./index.php" method="post" class='connect'>
                            <h1>Connexion</h1>
                            <div class="input_g">
                                <label for="" class="form-label">Nom utilisteur</label>
                                <input type="text" class="form-control" name='user'>
                            </div>


                            <div class="input_g">
                                <label for="" class="form-label">Votre mot de pass</label>
                                <input type="password" class="form-control" name=pass>
                            </div>

                            <p><button class="btn btn-danger bt">Se connecter</button></p>
                    </form>
                </div>
 
            </div>

        <?php endif?>


            <script src="./admin.js"></script>
    
</body>
</html>